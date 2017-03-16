<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gateways\CompanyGateway;

class CompanyController extends Controller
{
    protected $companyGateway;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CompanyGateway $companyGateway)
    {
        $this->middleware('api_auth');
        $this->companyGateway = $companyGateway;
    }

    // public function index(Request $request)
    // {
    //     return $this->payGroupGateway->getGroups();
    // }

    // public function store(Request $request)
    // {
    //     return $this->companyGateway->createGroup($request);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:64',
            'trade_name' => 'required|max:64',
        ]);
         
        return $this->companyGateway->updateCompany($request, $id);
    }

    public function show(Request $request, $id)
    {
        return $this->payGroupGateway->getGroup($id);
    }
}
