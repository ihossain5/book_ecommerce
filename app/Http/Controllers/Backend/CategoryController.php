<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Service\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryService $categoryService)
    {
        $categories = $categoryService->all();
        return view('admin.category.category_management',compact('categories'));
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request, CategoryService $categoryService) {
        try {
            $category = $categoryService->updateStatus($request->id,$request->type);

          } catch (Exception $e) {
              
            return $this->error($e->getMessage());
          }
          
        return $this->success($this->responseMessage($category->category_id));
    }

    // public function updateIsNavStatus(Request $request, CategoryService $categoryService) {
    //     try {
    //         $category = $categoryService->updateNavStatus($request->id);

    //       } catch (Exception $e) {
              
    //         return $this->error($e->getMessage());
    //       }

    //     return $this->success($this->responseMessage($category->category_id));
    // }

    protected function responseMessage($id){
        $data            = array();
        $data['message'] = 'Status updated successfully';
        $data['id']      = $id;
        return $data;
    }
}
