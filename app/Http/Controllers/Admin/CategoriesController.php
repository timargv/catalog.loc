<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index(Request $request, Category $category)
    {
        $categories = Category::defaultOrder();

        $query = $categories;

        if (!empty($value = $request->get('name_original'))) {
            $query->where('name_original', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('name'))) {
            $query = $category->orderByDesc('name');
        }

        if (!empty($value = $request->get('category_id'))) {
            $query->where('id', $value);
        }

        $categories = $query->withDepth()->paginate(50);

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        $parents = Category::defaultOrder()->withDepth()->get();
        return view('admin.categories.create', compact('parents'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'parent' => 'nullable|integer|exists:categories,id',
        ]);

        $category = Category::create([
            'name' => $request['name'],
            'name_original' => $request['name_original'],
            'status' => $request['status'] == Category::STATUS_ACTIVE ? Category::STATUS_ACTIVE : Category::STATUS_CLOSED,
            'slug' => $request['slug'],
            'parent_id' => $request['parent'],
        ]);

        return redirect()->route('admin.categories.show', $category);
    }


    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }


    public function edit(Category $category)
    {
        $parents = Category::defaultOrder()->withDepth()->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }


    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'parent' => 'nullable|integer|exists:categories,id',
        ]);

        $category->update([
            'name' => $request['name'],
            'name_original' => $request['name_original'],
            'status' => $request['status'] == Category::STATUS_ACTIVE ? Category::STATUS_ACTIVE : Category::STATUS_CLOSED,
            'slug' => $request['slug'],
            'parent_id' => $request['parent'],
        ]);

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


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index');
    }

}
