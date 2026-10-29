<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
USE Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required | exists:users,id',
            'country'=> 'required | string|max:255',
            'zipcode'=> 'required | string | max:20',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $address = new Address();
        $address->user_id=$request->user_id;
        $address->country=$request->country;
        $address->zipcode=$request->zipcode;
        $address->save();

        return response()->json([
            'message'=> 'Address added successfully',
            'data'=> $address
        ], 200);
    }
    public function show(Address $address){
        return response()->json($address, 200);
    }
    public function show_user(Address $address){
        return response()->json($address->user, 200);
    }
}
