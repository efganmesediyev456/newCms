<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\MainService;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $service;

    public function __construct(){
        $this->service = new MainService();
    }

    protected function responseMessage($status, $message, $data = null, $statusCode = 200, $route = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'route' => $route
        ], $statusCode);
    }
}
