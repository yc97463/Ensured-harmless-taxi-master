<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api');
        $this->userService = $userService;
    }

    public function getUser()
    {
        $mResult = $this->userService->get();
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getUserById(Request $request, $user_id)
    {
        $mResult = $this->userService->getByUserId($user_id);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function newUser(Request $request)
    {
        $mResult = $this->userService->create($request);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function editUser(Request $request, $user_id)
    {
        $mResult = $this->userService->editDish($request, $user_id);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function removeUser(Request $request, $user_id)
    {
        $mResult = $this->userService->removeDish($request, $user_id);
        return response()->json($mResult[0], $mResult[1]);
    }
}
