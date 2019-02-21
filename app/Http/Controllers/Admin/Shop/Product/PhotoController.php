<?php

namespace App\Http\Controllers\Admin\Shop\Product;

use App\Entity\Product;
use App\Entity\Shop\Product\Photo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\PhotosRequest;
use App\UseCases\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Shop\Product\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity\Shop\Product\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity\Shop\Product\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity\Shop\Product\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }


    public function image(Request $request): string
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $file = $request->file('file');
        $path = $file->store('images', 'public');

        return Storage::disk('public')->url($path);
    }


    public function photosForm(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    public function photos(PhotosRequest $request, Product $product)
    {
        try {
            $this->service->addPhotos($product->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.products.edit', $product);
    }
}
