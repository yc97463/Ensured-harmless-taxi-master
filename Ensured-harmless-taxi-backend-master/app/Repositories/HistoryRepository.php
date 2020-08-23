<?php

namespace App\Repositories;

use App\Entity\History;

class HistoryRepository
{

    protected $company;

    public function __construct(History $history)
    {
        $this->company = $history;
    }

    public function all()
    {
        return $this->company->all();
    }

    public function findById($id)
    {
        return $this->company->find($id);
    }

    public function findByCompanyId($company_id)
    {
        return $this->company->where('company_id', $company_id)->get();
    }

    public function findByAction($action)
    {
        return $this->company->where('action', $action)->get();
    }


    public function caeate($data)
    {
        return $this->company->create($data);
    }

    public function update($id, $data)
    {
        return $this->company->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->company->find($id)->delete();
    }

}
