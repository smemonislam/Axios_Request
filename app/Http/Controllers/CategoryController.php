<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
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
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('files/category/' . $row->image) . '" class="img-fluid" alt="Not Found!"/>';
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-toggle="modal" data-target="#editCategoryModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></a>';
                    $actionbtn .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger ml-2" data-id="' . $row->id . '" id="delete"><i class="fas fa-trash"></i></a>';
                    return $actionbtn;
                })
                ->editColumn('home', function ($row) {
                    if ($row->home == 1) {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" id="homeDeactive">
                        <i class="fas fa-thumbs-down text-danger">
                        </i> <span class="badge badge-success">Active</span>
                        </a>';
                    } else {
                        return '<a href="javascript:void(0)" data-id="' . $row->id . '" id="homeActive">
                        <i class="fas fa-thumbs-up text-success"></i> 
                        <span class="badge badge-danger">Deactive</span>
                        </a>';
                    }
                })
                ->rawColumns(['image', 'action', 'home'])
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
    public function store(StoreCategoryRequest $request)
    {
        // Image Fields Upload folder files/category
        if ($request->hasFile('image')) {
            $categoryImage = $request->image;
            $categoryIcon = time() . '.' . $categoryImage->getClientOriginalExtension();
            Image::make($categoryImage)->resize(50, 50)->save(public_path('files/category/') . $categoryIcon);
        }

        // data is saved
        $data = [
            'category_name'    => $request->category_name,
            'image'    => $categoryIcon
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
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category = Category::findOrFail($category->id);
        $category->category_name = $request->category_name;
        if ($request->image) {
            $categoryImage = $request->image;
            $categoryIcon = time() . '.' . $categoryImage->getClientOriginalExtension();

            $image_path = public_path('files/category/' . $request->old_image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            Image::make($categoryImage)->resize(50, 50)->save(public_path('files/category/') . $categoryIcon);
            $category->image = $categoryIcon;
        } else {
            $category->image = $category->image;
        }

        $category->save();
        $notification = $this->notification('Category update successfully.', 'success');
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
        if ($category) {
            $category->delete();
            $notification = $this->notification('Category Delete successfully.', 'success');
            return response()->json($notification);
        }
    }


    public function homeActive($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $category->home = 1;
            $category->save();
            $notification = $this->notification('Category Active successfully.', 'info');
            return response()->json($notification);
        }
    }

    public function homeDeactive($category)
    {
        $category = Category::findOrFail($category);
        if ($category) {
            $category->home = 0;
            $category->save();
            $notification = $this->notification('Category Deactive successfully.', 'info');
            return response()->json($notification);
        }
    }
}
