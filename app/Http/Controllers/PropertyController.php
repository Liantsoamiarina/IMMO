<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
public function index()
    {
        $properties = Property::latest()->get();
        return view('home', compact('properties'));
    }

    public function Cproperty()
    {
        return view('admin.createproperty');
    }
    public function AgenceProperty()
    {
        return view('agence.agenceproperty');
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'transaction_type' => 'required|in:vente,location',
            'surface' => 'nullable|integer',
            'rooms' => 'nullable|integer',
            'floors' => 'nullable|integer',
            'parking' => 'boolean',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();

        Property::create($data);

        return redirect()->route('properties.index')->with('success', 'Bien ajouté avec succès');
    }

    public function show(Property $property)
    {
    return view('home', compact('property'));
    }


    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'transaction_type' => 'required|in:vente,location',
            'surface' => 'nullable|integer',
            'rooms' => 'nullable|integer',
            'floors' => 'nullable|integer',
            'parking' => 'boolean',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
        ]);

        $property->update($data);

        return redirect()->route('properties.index')->with('success', 'Bien mis à jour');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Bien supprimé');
    }



    }


