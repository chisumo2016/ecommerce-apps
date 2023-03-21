<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private string $routeResourceName = 'categories';

    public function __construct()
    {
        $this->middleware('can:view categories list')->only('index');
        $this->middleware('can:create category')->only(['create', 'store']);
        $this->middleware('can:edit category')->only(['edit', 'update']);
        $this->middleware('can:delete category')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::query()
            ->select([
                'id',
                'parent_id',
                'name',
                'created_at',
                'active',
            ])
            ->withCount([
                'children'
            ])
            ->when($request->name, fn (Builder $builder, $name) => $builder->where('name', 'like', "%{$name}%"))
            ->when(
                $request->parentId,
                fn (Builder $builder) => $builder->where('parent_id', $request->parentId),
                fn (Builder $builder) => $builder->root()
            )
            ->when(
                $request->active !== null, // 0
                fn (Builder $builder) => $builder->when(
                    $request->active, //1
                    fn (Builder $builder) => $builder->active(),
                    fn (Builder $builder) => $builder->inActive()
                )
            )
            ->latest('id')
            ->paginate(100);

        return Inertia::render('Admin/Categories/Index', [
            'title' => 'Categories',
            'items' => CategoryResource::collection($categories),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Children',
                    'name' => 'children_count',
                ],
                [
                    'label' => 'Active',
                    'name' => 'active',
                ],
                [
                    'label' => 'Created At',
                    'name' => 'created_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'rootCategories' => CategoryResource::collection(Category::root()->get(['id', 'name'])), //filters
            'can' => [
                'create' => $request->user()->can('create category'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Categories/Create', [
            'edit' => false,
            'title' => 'Add Categories',
            'routeResourceName' => $this->routeResourceName,
            'rootCategories' => CategoryResource::collection(Category::root()->get(['id', 'name'])),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        $data = $request->safe()->only(['name', 'slug', 'active']);
        $data['parent_id'] = $request->parentId;

        $category = Category::create($data);

        return redirect()->route("{$this->routeResourceName}.index")->with('message', 'Categories created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Create', [
            'edit' => true,
            'title' => 'Edit Categories',
            'item' => new CategoryResource($category),
            'routeResourceName' => $this->routeResourceName,
            'rootCategories' => CategoryResource::collection(Category::root()->where('id', '!=', $category->id)->get(['id', 'name'])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesRequest $request, Category $category)
    {
        $data = $request->safe()->only(['name', 'slug', 'active']);
        $data['parent_id'] = $request->parentId;

        $category->update($data);

        return redirect()->route("{$this->routeResourceName}.index")->with('message', 'Categories updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('message', 'Categories deleted successfully.');
    }
}
