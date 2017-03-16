<?php

namespace App\Gateways;

use App\Models\Company;
use App\Transformers\PayGroupTransformer;

class CompanyGateway
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    // public function getGroups()
    // {
    //     $groups = $this->group->where('company_id', auth()->user()->company_id)->get();
    //     return ['data' => fractal($groups, new PayGroupTransformer())->toArray()];
    // }

    public function updateCompany($request, $id)
    {
        $company = $this->company->find($id);
        $company->fill($request->all());
        $company->save();
        return response(['status' => 'success'], 200);
    }

    // public function getGroup($id)
    // {
    //     if ($data = $this->group->find($id)) {
    //         return response(['data' => $data], 200);
    //     }

    //     return response(['data' => null], 404);
        
    // }
}
