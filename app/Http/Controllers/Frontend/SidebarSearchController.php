<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Author;
use App\Models\Publication;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SidebarSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    
    
    public function author_sidebar_filter(Request $request)
    {
        //dd($request->all());
        $request->writer_search_key_sidebar;

        if($request->writer_search_key_sidebar!=null){

            $author_list=Author::where('name', 'LIKE', '%' . $request->writer_search_key_sidebar . '%')->orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'author_list' => $author_list,
                'message' => 'all author!',
                
            ]);
            
         
        }else{
            $author_list=Author::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'author_list' => $author_list,
                'message' => 'all author_list!',
                
            ]);
        }
        
    }


    public function publisher_sidebar_filter(Request $request)
    {
        //dd($request->all());
        $request->publisher_search_key_sidebar;

        if($request->publisher_search_key_sidebar!=null){

            $publication_list=Publication::where('name', 'LIKE', '%' . $request->publisher_search_key_sidebar . '%')->orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'publication_list' => $publication_list,
                'message' => 'all author!',
                
            ]);
            
         
        }else{
            $publication_list=Publication::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'publication_list' => $publication_list,
                'message' => 'all author_list!',
                
            ]);
        }
        
    }
    public function category_sidebar_filter(Request $request)
    {
        //dd($request->all());
        $request->category_search_key_sidebar;

        if($request->category_search_key_sidebar!=null){

            $category_list=Category::where('name', 'LIKE', '%' . $request->category_search_key_sidebar . '%')->orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'category_list' => $category_list,
                'message' => 'all author!',
                
            ]);
            
         
        }else{
            $category_list=Category::orderBy('name')->get();
            
            return response()->json([
                'success' => true,
                'category_list' => $category_list,
                'message' => 'all author_list!',
                
            ]);
        }
        
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
}
