<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
use App\Services\LogActivityService;

class AuthController extends Controller
{
    protected $logService;

    public function __construct(LogActivityService $service)
    {
        // Dependency Injection otomatis
        $this->logService = $service;
    }

    /**
     * Login Admin (Sanctum Token)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cari admin berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {

            $this->logService->log(
                'Login Failed', 
                "Admin gagal login: {$request->email}", 
                'Warning'
            );

            throw ValidationException::withMessages([
                'message' => ['Email atau password salah.'],
            ]);
        }

        // Hapus token sebelumnya
        $admin->tokens()->delete();

        // Generate token baru
        $token = $admin->createToken('admin-auth-token')->plainTextToken;

        $this->logService->log(
            'Login Successful',
            "Admin {$admin->email} berhasil login",
            'Success'
        );

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
            ]
        ], 200);
    }

    /**
     * Logout Admin
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $this->logService->log(
            'Logout Successful',
            "Admin {$request->user()->email} logout",
            'Success'
        );

        return response()->json(['message' => 'Logout berhasil.']);
    }

    /**
     * Get Admin Profile
     */
    public function getProfile(Request $request)
    {
        $admin = $request->user();

        return response()->json([
            'admin' => [
                'id' => $admin->admin_id,
                'name' => $admin->name,
                'email' => $admin->email,
                'nickname' => $admin->nickname ?? '',
                'phone_number' => $admin->phone_number ?? '',
            ]
        ]);
    }

    /**
     * Update Profile
     */
    public function updateProfile(Request $request)
    {
        $admin = $request->user();

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => "sometimes|email|max:255|unique:admin,email,{$admin->admin_id},admin_id",
            'phone_number' => 'sometimes|nullable|string|max:20',
        ]);

        $admin->update($request->only(['name', 'email']));

        $this->logService->log(
            'Profile Updated',
            "Admin {$admin->email} update profil",
            'Success'
        );

        return response()->json(['message' => 'Profil berhasil diperbarui.']);
    }

    /**
     * Change Password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = $request->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password lama salah.'],
            ]);
        }

        $admin->update(['password' => Hash::make($request->new_password)]);

        $admin->tokens()->delete();

        return response()->json([
            'message' => 'Password berhasil diubah, silakan login ulang.'
        ]);
    }
}
