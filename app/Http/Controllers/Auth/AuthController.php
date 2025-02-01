<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $response = $this->authService->login($data);
        toastr($response['message'], $response['status']);
        return $response['redirect'];
    }

    public function logout(){
        $this->authService->logout();
        toastr('Hesabdan çıxış uğurludur!');
        return redirect()->route('login');
    }
}
