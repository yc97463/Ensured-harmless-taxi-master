<?php

namespace App\Service;

use App\Repositories\CarRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarService
{

    /**
     * @var CarRepository
     */
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function get()
    {
        return [$this->carRepository->all(), Response::HTTP_OK];
    }

    public function getCarById($car_id)
    {

    }

    public function getCarByLicensePlate($license_plate)
    {

    }

    public function getCarByCompanyId($company_id)
    {

    }

    public function getCarByStatus($status)
    {

    }

    public function create(Request $request)
    {

    }

    public function edit(Request $request, $car_id)
    {
        $edit = $this->carRepository->update($car_id, $request->only(['name']));
        if ($edit != 0)
            return [$this->carRepository->findById($car_id), Response::HTTP_OK];
        else
            return [['error' => 'The Manufacturer Not Found'], Response::HTTP_NOT_FOUND];
    }

    public function remove(Request $request, $car_id)
    {
        $remove = $this->carRepository->delete($car_id);
        if ($remove != 0)
            return [[], Response::HTTP_NO_CONTENT];
        else
            return [['error' => 'The Manufacturer Not Found'], Response::HTTP_NOT_FOUND];
    }
}
