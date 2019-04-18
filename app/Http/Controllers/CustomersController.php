<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Auth;
use App\Customer;

use App\Http\Requests\CreateCustomerRequest;

class CustomersController extends Controller
{
    public function all()
    {
        $customers = Customer::all();

        return response()->json([
            "customers" => $customers
        ], 200);
    }

    public function get($id)
    {
        $customer = Customer::whereId($id)->first();

        return response()->json([
            "customer" => $customer
        ], 200);
    }

    public function new(CreateCustomerRequest $request)
    {
        $id = Auth::user()->id;
        //$customer = Customer::create($request->only(["name", "email", "phone"]));
        $customer = new Customer;
        $customer->room = $request->room;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->parent_id = $id;
        //$customer->password = bcrypt($request->password);
        $customer->save();

        return response()->json([
            "customer" => $customer
        ], 200);
    }
}
