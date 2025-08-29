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
    }


