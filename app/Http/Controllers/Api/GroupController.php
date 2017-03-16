<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gateways\PayGroupGateway;

class GroupController extends Controller
{
    protected $payGroupGateway;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PayGroupGateway $payGroupGateway)
    {
        $this->middleware('api_auth');
        $this->payGroupGateway = $payGroupGateway;
    }

    public function index(Request $request)
    {
        return $this->payGroupGateway->getGroups();
    }

    public function store(Request $request)
    {
        return $this->payGroupGateway->createGroup($request);
    }

    public function show(Request $request, $id)
    {
        return $this->payGroupGateway->getGroup($id);
    }
}
