<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\SearchRequest;
use App\UseCases\Product\SearchService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index (SearchRequest $request) {

        $products = $this->searchService->search($request);
        if (!count($products)) {
            return view('search.nothing');
        }
        return view('search.index', compact('products'));

    }
}
