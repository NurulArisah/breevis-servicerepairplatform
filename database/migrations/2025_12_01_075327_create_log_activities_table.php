<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('log_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->string('actor_role')->nullable(); // e.g., 'Admin', 'Technician', 'System'
            $table->string('action'); // e.g., 'Login', 'Create Order'
            $table->text('description')->nullable();
            $table->string('status')->nullable(); // 'Success', 'Failed', 'Warning'
            $table->string('ip_address')->nullable();
            $table->text('device_info')->nullable();
            $table->unsignedBigInteger('related_id')->nullable(); // ID objek terkait (order_id, etc)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_activities');
    }
}