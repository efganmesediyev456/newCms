<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{

    public function login(array $data): array
    {
        $authAttempt = Auth::attempt($data);
        if (!$authAttempt) return ['status' => 'error', 'message' => 'Yanlış giriş məlumatları', 'redirect' => redirect()->back()];

        return [
            'status' => 'success',
            'message' => 'Uğurla daxil oldunuz',
            'redirect' => redirect()->route('dashboard')
        ];
    }

    public function logout()
    {
        Auth::logout();
        Session::regenerateToken();
    }
}
