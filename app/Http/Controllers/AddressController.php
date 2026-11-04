<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $Addresses = Address::all();

        return response()->json(['message' => null, 'data' => $Addresses], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'country' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $address = Address::create($request->only('user_id', 'country', 'zipcode'));

        return response()->json(['message' => 'Address Created', 'data' => $address], 201);
    }

    public function show(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address], 200);
    }

    public function show_user(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address->user], 200);
    }

}

