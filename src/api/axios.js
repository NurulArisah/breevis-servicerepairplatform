// src/api/index.js
import axios from 'axios';

const Api = axios.create({
    // Ini alamat backend Laravel Anda
    baseURL: 'http://127.0.0.1:8000/api', 
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
});

export default Api;