<?php

namespace App\Http\Controllers;

use App\Service\StatusService;
use App\Service\UserService;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    /**
     * @var StatusService
     */
    private $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->middleware('auth:api');
        $this->statusService = $statusService;
    }

    public function getStatusByLicensePlate(Request $request, $license_plate)
    {
        $mResult = $this->statusService->getStatusByLicensePlate($license_plate);
        return response()->json($mResult[0], $mResult[1]);
    }

    public function newStatus(Request $request)
    {
        $mResult = $this->statusService->create($request);
        return response()->json($mResult[0], $mResult[1]);
    }

}
