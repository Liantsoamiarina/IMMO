<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the properties.
     */
    public function index()
    {
        // Logic to retrieve and display properties
    }

    /**
     * Show the form for creating a new property.
     */
    public function Cproperty()
    {
        return view('admin.createproperty');
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        Property::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'type' => $request->input('type'),
            'transaction_type' => $request->input('transaction_type'),
            'surface' => $request->input('surface'),
            'rooms' => $request->input('rooms'),
            'floors' => $request->input('floors'),
            'parking' => $request->has('parking') ? true : false,
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country')
        ]);
    }
}
