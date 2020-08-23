<?php

namespace App\Service;

use App\Repositories\HistoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HistoryService
{

    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function get()
    {
        return [$this->historyRepository->all(), Response::HTTP_OK];
    }

    public function create(Request $request)
    {

    }

    public function edit(Request $request, $manufacturer_id)
    {
        $edit = $this->historyRepository->update($manufacturer_id, $request->only(['name']));
        if ($edit != 0)
            return [$this->historyRepository->findById($manufacturer_id), Response::HTTP_OK];
        else
            return [['error' => 'The Manufacturer Not Found'], Response::HTTP_NOT_FOUND];
    }

    public function remove(Request $request, $manufacturer_id)
    {
        $remove = $this->historyRepository->delete($manufacturer_id);
        if ($remove != 0)
            return [[], Response::HTTP_NO_CONTENT];
        else
            return [['error' => 'The Manufacturer Not Found'], Response::HTTP_NOT_FOUND];
    }
}
