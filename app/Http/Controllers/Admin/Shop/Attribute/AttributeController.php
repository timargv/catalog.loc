<?php

namespace App\Http\Controllers\Admin\Shop\Attribute;

use App\Entity\Category;
use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeGroup;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request, AttributeGroup $attributeGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
            'slug' => 'required|string|max:255|unique:attributes'
        ]);

        $attributeGroup = $attributeGroup->findOrFail($request['attributeGroup']);

        /** @var Attribute $attribute */
        $attribute = Attribute::make([
            'name' => $request['name'],
            'type' => $request['type'],
//            'group_id' => $request['attributeGroup'],
            'required' => (bool)$request['required'],
            'variants' => $request['variants'] == null ? [] : array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'] == null ? 1 : $request['sort'],
            'slug' => $request['slug'],
        ]);


        $attribute->group()->associate($attributeGroup);
        $attribute->saveOrFail();

        $attribute->setCategories($request['categories']);

        return redirect()->route('admin.attribute-groups.show', $attributeGroup);
    }


    public function show(Attribute $attribute)
    {
        //
    }


    public function edit(Attribute $attribute)
    {
        $attributeGroups = AttributeGroup::all();
        $types = Attribute::typesList();
        $categories = Category::defaultOrder()->withDepth()->get();

        $attr_categories = $attribute->categories->pluck('id')->toArray();

//        dd($attribute->categories);
        return view('admin.attributes.edit', compact('attribute', 'attributeGroups', 'types', 'categories', 'attr_categories'));
    }


    public function update(Request $request, Attribute $attribute, AttributeGroup $attributeGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
            'slug' => 'required|string|max:255|unique:attributes,slug,'.  $attribute->id,
        ]);

        $attributeGroup = $attributeGroup->findOrFail($request['attributeGroup']);

        /** @var Attribute $attribute */
        $attribute->update([
            'name' => $request['name'],
            'type' => $request['type'],
//            'group_id' => $request['attributeGroup'],
            'required' => (bool)$request['required'],
            'variants' => $request['variants'] == null ? [] : array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'],
            'slug' => $request['slug'],
        ]);



        $attribute->group()->associate($attributeGroup);
        $attribute->setCategories($request['categories']);
//        $attribute->categories()->sync($request['categories']);

        $attribute->update();


        return redirect()->route('admin.attribute-groups.show', $attributeGroup);
    }


    public function destroy(Attribute $attribute)
    {
        $attribute->values()->delete();
        $attribute->delete();
        return redirect()->back()->with('success', 'Атрибут удален!');
    }
}
