<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function publicHome()
    {
        $vehicles = Vehicle::with('category')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('home', compact('vehicles', 'categories'));
    }

    public function publicIndex(Request $request)
    {
        $query = Vehicle::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price_per_day', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price_per_day', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $vehicles = $query->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('category');

        return view('vehicles.show', compact('vehicle'));
    }

    public function index()
    {
        $vehicles = Vehicle::with('category')->latest()->paginate(10);
        $categories = Category::orderBy('name')->get();

        return view('admin.vehicles.index', compact('vehicles', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.vehicles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number',
            'category_id' => 'required|exists:categories,id',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Véhicule créé avec succès.');
    }

    public function edit(Vehicle $vehicle)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'registration_number' => 'required|string|max:255|unique:vehicles,registration_number,' . $vehicle->id,
            'category_id' => 'required|exists:categories,id',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($vehicle->image) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $validated['image'] = $request->file('image')->store('vehicles', 'public');
        }

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Véhicule supprimé avec succès.');
    }
}