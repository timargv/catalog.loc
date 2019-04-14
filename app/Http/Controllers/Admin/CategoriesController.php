<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CreateRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\UseCases\Category\CategoryService;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{

    private $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
        $this->middleware('can:manage-users');
    }

    public function index(Request $request)
    {
        $categories = Category::defaultOrder();

        $query = $categories;

        if (!empty($value = $request->get('name_original'))) {
            $query->where('name_original', 'like', '%' . $value . '%')
                ->orWhere('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('category_id'))) {
            $query->where('id', $value);
        }

        $categories = $query->withDepth()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::defaultOrder()->withDepth()->get();
        return view('admin.categories.create', compact('parents'));
    }


    public function store(CreateRequest $request)
    {
        try {
             $category = $this->service->create($request);
        } catch (\DomainException $e) {
             return back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.categories.show', $category);
    }


    public function show(Category $category)
    {

        // Получить подкатегории данной категории
        // $categories = Category::descendantsAndSelf($category);

        // Получить Потомков  данной категории
//        $categories = Category::defaultOrder()->descendantsOf($category);
        $categories = $category->children()->defaultOrder('ASC')->get();
        return view('admin.categories.show', compact('category', 'categories'));
    }

    public function edit(Category $category)
    {
        $parents = Category::defaultOrder()->withDepth()->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }


    public function update(Category $category, UpdateRequest $request)
    {
        try {
            $this->service->edit($category, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.categories.show', $category);
    }


    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }

        return redirect()->route('admin.categories.index');
    }

    public function up(Category $category)
    {
        $category->up();

        return redirect()->route('admin.categories.index');
    }

    public function down(Category $category)
    {
        $category->down();

        return redirect()->route('admin.categories.index');
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }

        return redirect()->route('admin.categories.index');
    }

    public function toggleStatus(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::findOrFail($request->category);
            $category->update([
                'status' =>  $category->status == 'active' ? $category::STATUS_CLOSED : $category::STATUS_ACTIVE,
            ]);
            return response()->json(['success'=>'Статус изменен']);
        }
    }

    public function fixCategory(CategoryService $service) {
        return $service->fix();
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

}
