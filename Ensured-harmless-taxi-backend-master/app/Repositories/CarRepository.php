<?php

namespace App\Repositories;

use App\Entity\Car;

class CarRepository
{

    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function all()
    {
        return $this->car->all();
    }

    public function findById($id)
    {
        return $this->car->find($id);
    }

    public function findByLicensePlate($account)
    {
        return $this->car->where('license_plate', $account)->first();
    }

    public function findByStatus($status)
    {
        return $this->car->where('status', $status)->get();
    }

    public function findByCompanyId($company_id)
    {
        return $this->car->where('company_id', $company_id)->get();
    }

    public function caeate($data)
    {
        return $this->car->create($data);
    }

    public function update($id, $data)
    {
        return $this->car->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->car->find($id)->delete();
    }

}
