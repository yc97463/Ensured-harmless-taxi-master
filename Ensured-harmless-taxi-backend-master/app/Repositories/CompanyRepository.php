<?php

namespace App\Repositories;


use App\Entity\Company;

class CompanyRepository
{

    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function all()
    {
        return $this->company->all();
    }

    public function findById($id)
    {
        return $this->company->find($id);
    }

    public function findByName($name)
    {
        return $this->company->where('name', $name)->first();
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
