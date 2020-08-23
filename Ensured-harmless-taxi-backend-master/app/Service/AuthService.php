<?php

namespace App\Service;

use App\Mail\Verify;
use App\Repositories\Login_failRepository;
use App\Repositories\UserRepository;
use App\Repositories\VerifyRepository;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Passport;
use Illuminate\Http\Response;

class AuthService
{

    private $userRepository;
    private $login_failRepository;
    private $verifyRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createToken(Request $request)
    {
        $req = $request->all();

        if ($req['grant_type'] == "password") {
            $user = $this->userRepository->findByAccount($req['username']);
            if ($user != null) {
                $user_id = $user->id;
            } else {
                return [['error' => 'Username or Password Error'], Response::HTTP_UNAUTHORIZED];
            }
        }

        $mRequest = app('request')->create('/oauth/token', 'POST', $req);
        $mResponse = app('router')->prepareResponse($mRequest, app()->handle($mRequest));
        $mResultContent = json_decode($mResponse->getContent(), true);
        $mResultStatusCode = $mResponse->getStatusCode();

        if ($req['grant_type'] == "password") {
            $access_token = $mResultContent['access_token'] ?? null;

            if (!empty($access_token)) {
                $user_id = $this->userRepository->findByAccount($req['username'])->id;
                if ($mResultStatusCode == 200) {
                    $mResultContent['access_token'] = $this->payload($mResultContent['access_token']);
                    return [$mResultContent, Response::HTTP_OK];
                }
            } else {
                $user_id = $this->userRepository->findByAccount($req['username'])->id;
                if ($mResultContent['error'] == "invalid_client") {
                    return [$mResultContent, Response::HTTP_UNAUTHORIZED];
                } elseif ($mResultContent['error'] == "invalid_grant") {
                    return [['error' => 'Username or Password Error'], Response::HTTP_UNAUTHORIZED];
                }
            }
        }

        if ($req['grant_type'] == "refresh_token") {
            if (!empty($mResultContent['access_token'] ?? null) && $mResultStatusCode == 200) {
                $getPayload = $this->payload($mResultContent['access_token'], true);
                $mResultContent['access_token'] = $getPayload['token'];
                //Log::channel('login')->info('Success (Refresh)', ['ip' => $ip, 'user_id' => $getPayload['user_id']]);
                return [$mResultContent, Response::HTTP_OK];
            }
        }

        return [$mResultContent, $mResultStatusCode];
    }

    public function getUser(Request $request)
    {
        //$user = $request->user();
        $user = Auth::user();
        $mResult[0] = array_merge($user->toArray(), array('roles' => $this->userRepository->getRoleNamesById(auth()->user()->id)));
        $mResult[1] = Response::HTTP_OK;
        return $mResult;
    }

    public function revokeToken(Request $request, $tokenId)
    {
        $token = Passport::token()->where('id', $tokenId)->where('user_id', $request->user()->getKey())->first();
        if (is_null($token)) {
            return [[], Response::HTTP_NOT_FOUND];
        }
        $token->revoke();
        if (!$request->has('rememberme') || $request->input('rememberme') != true)
            Passport::refreshToken()->where('access_token_id', $tokenId)->update(['revoked' => true]);
        return [[], Response::HTTP_NO_CONTENT];
    }

    private function payload($access_token, $returnUserId = false)
    {
        $jwt = explode('.', $access_token);
        $payload = json_decode(base64_decode($jwt[1]), true);
        $user = $this->userRepository->findById($payload['sub']);
        $user_info = $user->toArray();
        $payload = array_merge($payload, ['user' => $user_info]);
        $path = storage_path('oauth-private.key');
        $file = fopen($path, "r");
        $privateKey = fread($file, filesize($path));
        fclose($file);
        $token = JWT::encode($payload, $privateKey, 'RS256');
        if ($returnUserId)
            return ['token' => $token, 'user_id' => $payload['sub']];
        return $token;
    }
}
