<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Contracts\View\View;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Category::query();
            return DataTables::of($model)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('admin.categories.edit', $row->id) . '"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></a>';
                    $actionbtn .= '<a href="' . route('admin.categories.destroy', $row->id) . '" class="btn btn-sm btn-danger ml-2" id="delete"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })
                ->setRowId(function ($user) {
                    return $user->id;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation Category Fields
        dd($request->all());
        $request->validate([
            'category_name' => 'required|unique:categories|max:32',
            'image'         => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        // Image Fields Upload folder files/category
        if ($request->hasFile('image')) {
            $categoryImage = $request->image;
            $categoryIcon = time() . '.' . $categoryImage->getClientOriginalExtension();
            Image::make($categoryImage)->resize(100, 100)->save(public_path('files/category/') . $categoryIcon);
        }

        // data is saved
        $data = [
            'name'    => $request->category_name,
            'icon'    => $categoryIcon
        ];

        try {
            if ($data) {
                Category::create($data);
                $notification = $this->notification('Category insert successfully.', 'success');
                return response()->json($notification);
            }
        } catch (Exception $e) {
            $notification = $this->notification($e->getMessage(), 'error');
            return response()->json($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        // dd($request->all());
        // Validation Category Fields
        $request->validate([
            'category_name' => 'required|max:32|unique:categories,name,' . $category->id,
            'image'         => 'image|mimes:png,jpg,jpeg|max:1024',
        ]);


        $category = Category::findOrFail($category->id);
        $category->name = $request->category_name;
        if ($request->hasFile('image')) {
            $categoryImage = $request->image;
            $categoryIcon = time() . '.' . $categoryImage->getClientOriginalExtension();

            $image_path = public_path('files/category/' . $request->old_image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            Image::make($categoryImage)->resize(100, 100)->save(public_path('files/category/') . $categoryIcon);
            $category->icon = $categoryIcon;
        } else {
            $category->icon = $category->icon;
        }

        $category->save();
        $notification = $this->notification('Category update successfully.', 'success');
        // return response()->json($notification);
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
