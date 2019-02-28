<?php

namespace App\Http\Controllers\Admin\Shop\Attribute;

use App\Entity\Category;
use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function PHPSTORM_META\elementType;

class AttributeGroupController extends Controller
{

    public function index(Request $request)
    {
        $attributeGroups = AttributeGroup::with('attributes')->get();
        $types = Attribute::typesList();
        $categories = Category::defaultOrder()->withDepth()->get();

        $attributes = Attribute::with('group');

        $query = $attributes;

        if (!empty($value = $request->get('search_attribute'))) {
            $query->where('name', $value)
                ->orWhere('name', 'like', '%' . $value . '%')->orderBy('name');
        } else {
            $query->orderByDesc('id');
        }

        $attributes = $query->paginate(15);


        return view('admin.attributes.index', compact('attributeGroups', 'types', 'categories', 'attributes'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attribute_groups'
        ]);

        $attributeGroup = AttributeGroup::create([
            'name' => $request['name'],
            'slug' => $request['slug']
        ]);
        return redirect()->back()->with('success', 'Добавлена группа '. $attributeGroup->name);
    }


    public function show(AttributeGroup $attributeGroup)
    {
        $attributeGroups = $attributeGroup->all();
        $attributes = $attributeGroup->attributes()->paginate(15);

        $types = Attribute::typesList();
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('admin.attributes.groups.show', compact('attributeGroup', 'attributeGroups', 'types', 'categories', 'attributes'));
    }


    public function edit(AttributeGroup $attributeGroup)
    {
        //
    }


    public function update(Request $request, AttributeGroup $attributeGroup)
    {
        //
    }


    public function destroy(AttributeGroup $attributeGroup)
    {
        $attributeGroup->attributes()->delete();
        $attributeGroup->delete();
        return redirect()->back()->with('success', 'Группа Атрибутов Удалена');
    }
}
