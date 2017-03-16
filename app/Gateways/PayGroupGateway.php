<?php

namespace App\Gateways;

use App\Models\PayGroup;
use App\Transformers\PayGroupTransformer;

class PayGroupGateway
{
    protected $group;

    public function __construct(PayGroup $group)
    {
        $this->group = $group;
    }

    public function getGroups()
    {
        $groups = $this->group->where('company_id', auth()->user()->company_id)->get();
        return ['data' => fractal($groups, new PayGroupTransformer())->toArray()];
    }

    public function createGroup($request)
    {
        $this->group->fill($request->all());
        $this->group->save();
        return response(['status' => 'success'], 201);
    }

    public function getGroup($id)
    {
        if ($data = $this->group->find($id)) {
            return response(['data' => $data], 200);
        }

        return response(['data' => null], 404);
        
    }
}
