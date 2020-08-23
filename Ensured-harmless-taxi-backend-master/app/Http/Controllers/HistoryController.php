<?php

namespace App\Http\Controllers;

use App\Service\HistoryService;
use App\Service\StatusService;
use App\Service\UserService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    /**
     * @var HistoryService
     */
    private $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->middleware('auth:api');
        $this->historyService = $historyService;
    }

    public function getHistory()
    {
        $mResult = $this->historyService->get();
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getHistoryByCarId(Request $request, $car_id)
    {
        $mResult = $this->historyService->getHistoryByCarId($car_id);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getHistoryByLicensePlate(Request $request, $license_plate)
    {
        $mResult = $this->historyService->getHistoryByLicensePlate($license_plate);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function getHistoryByCompanyId(Request $request, $company_id)
    {
        $mResult = $this->historyService->getHistoryByCompanyId($company_id);
        return response()->json($mResult[0], $mResult[1]);
    }

}
