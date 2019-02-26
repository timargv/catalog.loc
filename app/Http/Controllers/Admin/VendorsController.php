<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Category;
use App\Entity\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorsController extends Controller
{

    public function index(Request $request)
    {
        $vendors = Vendor::orderBy('id', 'desc');

        $query = $vendors;

        if (!empty($value = $request->get('code_product'))) {
            $query->where('code_product', $value);
        }

        if (!empty($value = $request->get('title'))) {
            $query->where('title', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        $vendors = $query->paginate(15);


        return view('admin.vendors.index', compact('vendors'));
    }


    public function create()
    {
        //
        return view('admin.vendors.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
//            'code_product' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:vendors',
        ]);

        $vendor = Vendor::create([
            'title' => $request['title'],
            'number' => $request['number'],

            'email' => $request['email'],
            'code_product' => $request['code_product'],
            'address' => $request['address'],

            'url' => $request['url'],
            'slug' => $request['slug'],
        ]);

        return redirect()->route('admin.vendors.show', $vendor);
    }


    public function show(Vendor $vendor)
    {
        $products = $vendor->products()->with('category')->paginate(10);
        return view('admin.vendors.show', compact('vendor', 'products'));
    }


    public function edit(Vendor $vendor)
    {

        return view('admin.vendors.edit', compact('vendor'));
    }


    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'title' => 'required|string|max:255',
//            'code_product' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:vendors,id,' . $vendor->id,
        ]);

        $vendor->update([
            'title' => $request['title'],
            'number' => $request['number'],

            'email' => $request['email'],
            'code_product' => $request['code_product'],
            'address' => $request['address'],

            'url' => $request['url'],
            'slug' => $request['slug'],
        ]);

        return redirect()->route('admin.vendors.show', $vendor);
    }


    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->back();
    }
}
