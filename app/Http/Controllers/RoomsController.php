<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Auth;
use App\Room;

use App\Http\Requests\CreateCustomerRequest;

class RoomsController extends Controller
{
    public function all()
    {
        $customers = Room::where('creator_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return response()->json([
            "rooms" => $customers,
            "user_id" => Auth::user()->id
        ], 200);
    }

    public function get($id)
    {
        $customer = Room::whereId($id)->first();

        return response()->json([
            "room" => $customer
        ], 200);
    }

    public function new(Request $request)
    {
         $v = Validator::make($request->all(), [
            'room_name' => 'required'
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
        $customer = new Room;
        //$customer->room = $request->room;
        $customer->room = $request->room_name;
        $customer->creator_id = $id;
        $customer->save();

        return response()->json([
            "room" => $customer
        ], 200);
    }
}
