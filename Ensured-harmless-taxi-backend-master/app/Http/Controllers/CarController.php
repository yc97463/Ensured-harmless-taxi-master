<?php

namespace App\Http\Controllers;

use App\Service\CarService;
use App\Service\UserService;
use Illuminate\Http\Request;

class CarController extends Controller
{

    /**
     * @var CarService
     */
    private $carService;

    public function __construct(CarService $carService)
    {
        $this->middleware('auth:api');
        $this->carService = $carService;
    }

    public function getCar()
    {
        $mResult = $this->carService->get();
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getCarById(Request $request, $car_id)
    {
        $mResult = $this->carService->getCarById($car_id);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getCarByLicensePlate(Request $request, $license_plate)
    {
        $mResult = $this->carService->getCarByLicensePlate($license_plate);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getCarByCompanyId(Request $request, $company_id)
    {
        $mResult = $this->carService->getCarByCompanyId($company_id);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getCarByStatus(Request $request, $status)
    {
        $mResult = $this->carService->getCarByStatus($status);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function newCar(Request $request)
    {
        $mResult = $this->newCar->create($request);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function editCar(Request $request, $car_id)
    {
        $mResult = $this->carService->edit($request, $car_id);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function removeCar(Request $request, $car_id)
    {
        $mResult = $this->carService->remove($request, $car_id);
        return response()->json($mResult[0], $mResult[1]);
    }
}
