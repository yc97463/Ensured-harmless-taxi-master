<?php

namespace App\Repositories;

use App\Entity\User;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function findById($id)
    {
        return $this->user->find($id);
    }

    public function findByAccount($account)
    {
        return $this->user->where('account', $account)->first();
    }

    public function findByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function caeate($data)
    {
        return $this->user->create($data);
    }

    public function update($id, $data)
    {
        return $this->user->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }

    public function getAllPermissiosNamesById($id)
    {
        $permissions = array();
        $uu = $this->findById($id);
        foreach ($uu->getAllPermissions() as $item) {
            $permissions[] = $item['name'];
        }
        return $permissions;
    }

    public function getRoleNamesById($id)
    {
        $roles = array();
        $uu = $this->findById($id);
        foreach ($uu->roles as $item) {
            $roles[] = $item['name'];
        }
        return $roles;
    }
}
