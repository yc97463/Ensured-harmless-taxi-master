<?php

namespace App\Service;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get()
    {
        return [$this->userRepository->all(), Response::HTTP_OK];
    }

    public function getByUserId($user_id)
    {
        return [$this->userRepository->all(), Response::HTTP_OK];
    }

    public function create(Request $request)
    {

    }

    public function edit(Request $request, $manufacturer_id)
    {
        $edit = $this->userRepository->update($manufacturer_id, $request->only(['name']));
        if ($edit != 0)
            return [$this->userRepository->findById($manufacturer_id), Response::HTTP_OK];
        else
            return [['error' => 'The Manufacturer Not Found'], Response::HTTP_NOT_FOUND];
    }

    public function remove(Request $request, $manufacturer_id)
    {
        $remove = $this->userRepository->delete($manufacturer_id);
        if ($remove != 0)
            return [[], Response::HTTP_NO_CONTENT];
        else
            return [['error' => 'The Manufacturer Not Found'], Response::HTTP_NOT_FOUND];
    }
}
