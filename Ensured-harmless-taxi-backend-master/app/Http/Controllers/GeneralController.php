<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function isOk()
    {
        return response()->json(['success' => true]);
    }

    public function ip(Request $request)
    {
        return response()->json([
            'HTTP_CLIENT_IP' => $_SERVER['HTTP_CLIENT_IP'] ?? '',
            'HTTP_X_FORWARDED_FOR' => $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '',
            'HTTP_X_FORWARDED' => $_SERVER['HTTP_X_FORWARDED'] ?? '',
            'HTTP_X_CLUSTER_CLIENT_IP' => $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] ?? '',
            'HTTP_FORWARDED_FOR' => $_SERVER['HTTP_FORWARDED_FOR'] ?? '',
            'HTTP_FORWARDED' => $_SERVER['HTTP_FORWARDED'] ?? '',
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'] ?? '',
            'HTTP_VIA' => $_SERVER['HTTP_VIA'] ?? '',
            'Request::ip()' => $request->ip()]);
    }
}
