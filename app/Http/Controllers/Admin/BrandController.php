<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::paginate(15);
        return view('admin.brands.index', compact('brands'));
    }


    public function create()
    {
        return view('admin.brands.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:brands',
        ]);

        $brand = Brand::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
        ]);

        return redirect()->route('admin.brands.show', $brand);
    }


    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }


    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }


    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|exists:brands,slug',
        ]);

        $brand->update([
            'title' => $request['title'],
            'slug' => $request['slug'],
        ]);
        return redirect()->route('admin.brands.show', $brand);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
