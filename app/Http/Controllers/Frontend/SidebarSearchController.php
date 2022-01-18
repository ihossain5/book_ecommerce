<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Author;
use App\Models\Publication;
use App\Models\Category;
use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SidebarSearchController extends Controller
{
    public function book_search(Request $request)
    {
        //dd($request->all());
        $key=$request->navbar_search;
        $books = Book::with('authors')->where('title', 'like', '%' .$key. '%')->where('is_visible',1)->paginate(12);
        $authors=Author::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $publications=Publication::orderBy('name')->get();

        return view('frontend.book.books',compact('books','authors','categories','publications'));

    }

    public function getBook(Request $request){

        //dd($request->all());
        $search = $request->search;

        if($search == ''){
            $response =null;
        }else{
        
            $books = Book::where('title', 'like', '%' .$search . '%')
            ->orwhere('slug', 'like', '%' .$search . '%')
            ->where('is_visible',1)->limit(5)->get();
            $response = array();
            foreach($books as $book){
            $response[] = array("value"=>$book->book_id,"label"=>$book->title);
            }
        }   
        

        return response()->json([
            'success' => true,
            'value' => $response,
            
        ]);
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
}
