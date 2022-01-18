<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Service\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryService $categoryService) {
        $categories = $categoryService->all();
        return view('admin.category.category_management', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $categoryService) {
        dd($request->all());
        try {
            $category = $categoryService->store($request->validated());

            $message = 'Category created successfully';

            return $this->success($this->responseMessage($message, $category));

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }

    public function edit(Category $category) {
        return $this->success($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, CategoryService $categoryService) {
        // dd($request->all());
        try {
            $photo    = $request->photo;

            $category = $categoryService->update($request->hidden_id, $request->validated(),$photo);

            $message = 'Category updated successfully';

            return $this->success($this->responseMessage($message, $category));

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {

        try {
            $category->delete();

            $message = 'Category deleted successfully';

            return $this->success($this->responseMessage($message, $category));

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    public function updateStatus(Request $request, CategoryService $categoryService) {
        try {
            $category = $categoryService->updateStatus($request->id, $request->type);

            $message = 'Status updated successfully';

            return $this->success($this->responseMessage($message));

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    // response message function
    function responseMessage($message, $category = null) {
        $data             = array();
        $data['message']  = $message;
        $data['category'] = $category;
        return $data;
    }

}
