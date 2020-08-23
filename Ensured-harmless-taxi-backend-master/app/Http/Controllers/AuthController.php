<?php

namespace App\Http\Controllers;

use App\Service\AuthService;
use Firebase\JWT\JWT;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Passport;

class AuthController extends Controller
{

    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['createToken', 'verifyCommit']]);
        $this->authService = $authService;
    }

    public function createToken(Request $request)
    {
        $mResult = $this->authService->createToken($request);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function verifyCommit(Request $request)
    {
        $mResult = $this->authService->verifyCommit($request);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function user(Request $request)
    {
        $mResult = $this->authService->getUser($request);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function revokeToken(Request $request, $tokenId)
    {
        $mResult = $this->authService->revokeToken($request, $tokenId);
        return response()->json($mResult[0], $mResult[1]);
    }
}
