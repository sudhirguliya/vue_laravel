<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Auth;
use App\Customer;
use App\User;

use App\Http\Requests\CreateCustomerRequest;

class CustomersController extends Controller
{
    public function all()
    {
        $customers = User::where('parent_id', Auth::user()->id)->get();

        return response()->json([
            "customers" => $customers,
            "user_id" => Auth::user()->id
        ], 200);
    }

    public function get($id)
    {
        $customer = User::whereId($id)->first();

        return response()->json([
            "customer" => $customer
        ], 200);
    }

    public function new(Request $request)
    {
         $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:9|max:15',
            'password'  => 'required|min:3|confirmed',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'error' => 'registration_validation_error',
                'errors' => $v->errors()
            ], 422);
        }

        $id = Auth::user()->id;
        //$customer = Customer::create($request->only(["name", "email", "phone"]));
        $customer = new User;
        //$customer->room = $request->room;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->parent_id = $id;
        $customer->role = 1;
        $customer->password = bcrypt($request->password);
        $customer->save();

        return response()->json([
            "customer" => $customer
        ], 200);
    }
}
