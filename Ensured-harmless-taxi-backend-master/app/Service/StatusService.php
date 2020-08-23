<?php

namespace App\Service;

use App\Repositories\CarRepository;
use App\Repositories\HistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusService
{

    /**
     * @var CarRepository
     */
    private $carRepository;
    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    public function __construct(CarRepository $carRepository, HistoryRepository $historyRepository)
    {
        $this->carRepository = $carRepository;
        $this->historyRepository = $historyRepository;
    }

    public function getStatusByLicensePlate($license_plate)
    {

    }

    public function create(Request $request)
    {

    }
}
