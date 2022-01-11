<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookAuthor;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications=Publication::all();
        return view('frontend.publisher.publishers',compact('publications'));
    }

    public function publisher_info($id)
    {

        $authors=Author::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $publications=Publication::orderBy('name')->get();

        $books=Book::with('authors','reviews')->where('publication_id',$id)->paginate(12);

        $publicaiton_info=Publication::where('publication_id',$id)->first();
        $publication_name=$publicaiton_info->name;
        //dd($publication_name);
        return view('frontend.publisher.publisher_books',compact('authors','categories','publications','books','publication_name','publicaiton_info'));
    }
    public function publisher_filter(Request $request)
    {
       //dd($request->all());

        $publication_id=$request->publication_id;
       $category_list=$request->category_list;
       $category_search_key=$request->category_search_key;
       $writer_search_key=$request->writer_search_key;
       $price=$request->price;
       $writer_list=$request->writer_list;

       if($category_search_key!=null || $writer_search_key!=null){


        if($category_search_key!=null){

            $categories=Category::where('name', 'LIKE', '%' . $category_search_key. '%')->get();
            //dd($categories);;
            $category_ids=[];
            foreach($categories as $category){

                $category_ids[]=$category->category_id ;
            }
            //dd($book_ids);

            $category_books=BookCategory::whereIn('category_id',$category_ids)->get();
            //dd($category_books);
            
            $book_ids=[];
            foreach($category_books as $category_book){

                $book_ids[]=$category_book->book_id ;
            }
            
            //dd($book_ids);

            if($book_ids!=null){

                $bookID=Book::with('authors','reviews')->whereIn('book_id',$book_ids)->where('publication_id',$publication_id)->where('is_visible',1)->get();
    
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }

            }else{
                $bookID=[];
            }


        }if($writer_search_key!=null){

            $category_id=$request->category_id;

            $authors=Author::where('name', 'LIKE', '%' . $writer_search_key. '%')->get();
            //dd($book_categories);
            $author_ids=[];
            foreach($authors as $author){

                $author_ids[]=$author->author_id ;
            }
            //dd($author_ids);

            $books_id=BookAuthor::whereIn('author_id',$author_ids)->get();
        
            $author_books_ids=[];
            foreach($books_id as $book_id){

                $author_books_ids[]=$book_id->book_id ;
            }
            //dd($author_books_ids);

            $book_categories=BookCategory::whereIn('book_id',$author_books_ids)->where('category_id', $category_id)->get();
        
            //dd($book_authors);
            $book_ids=[];
            foreach($book_categories as $book_category){

                $book_ids[]=$book_category->book_id;
            }
            //dd($book_ids);
            
            if($book_ids!=null){

                $bookID=Book::with('authors','reviews')->whereIn('book_id',$book_ids)->where('publication_id',$publication_id)->where('is_visible',1)->get();
    
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }else{
                $bookID=[];
            }


        }

        return response()->json([
            'success' => true,
            'book_list' => $bookID,
            
        ]);
    
    }elseif($writer_list!=null){
        
            $book_authors=BookAuthor::whereIn('author_id',$writer_list)->get();

            //dd($book_authors);
            $book_list=[];
        
            foreach($book_authors as $book_author){

                $book_list[]=$book_author->book_id;
            }
            //dd($book_list);
            $book_ids=array_unique($book_list);
            //dd($unique);
;
            
            if($book_ids!=null){

                $bookID=Book::with('authors','reviews')->whereIn('book_id',$book_ids)->where('publication_id',$publication_id)->where('is_visible',1)->get();
                
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
                
            }else{
                $bookID=[];
                
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);


        }elseif($category_list!=null){


            $book_categories=BookCategory::whereIn('category_id', $category_list)->get();
            $bookID=[];
            foreach($book_categories as $book_category){

                $bookID[]=$book_category->book_id;
            }


            //dd($bookID);
            if($bookID!=null){

                $bookID=Book::with('authors','reviews')->whereIn('book_id',$bookID)->where('publication_id',$publication_id)->where('is_visible',1)->get();
                
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }

            }else{
                $bookID=[];
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);

        }elseif($price!=null){
        //dd($price);

            if($price==100){
                $bookID=Book::with('authors','reviews')->whereBetween('discounted_price', [0, 100])->where('publication_id',$publication_id)->where('is_visible',1)->get();
              
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }elseif($price==500){
                $bookID=Book::with('authors','reviews')->whereBetween('discounted_price', [100, 500])->where('publication_id',$publication_id)->where('is_visible',1)->get();
                //dd($bookID);
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }elseif($price==1000){
                $bookID=Book::with('authors','reviews')->whereBetween('discounted_price', [500, 1000])->where('publication_id',$publication_id)->where('is_visible',1)->get();
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }elseif($price==1500){
                $bookID=Book::with('authors','reviews')->whereBetween('discounted_price', [1000, 2000])->where('publication_id',$publication_id)->where('is_visible',1)->get();
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }elseif($price==2000){
                $bookID=Book::with('authors','reviews')->where('discounted_price', '=>',2000)->where('publication_id',$publication_id)->where('is_visible',1)->get();
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }else{
             
    
                $bookID=Book::with('authors','reviews')->where('publication_id',$publication_id)->where('is_visible',1)->get();
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }
            }

          
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        }else{
           

                $bookID=Book::with('authors','reviews')->where('publication_id',$publication_id)->where('is_visible',1)->get();
                
                foreach($bookID as $book){
                    $rating=getTotalRating($book->reviews);
                    $book->rating=$rating;
                }


            //$bookID=Book::all();
            return response()->json([
                'success' => true,
                'book_list' => $bookID,
               
            ]); 
        }
    
    
    }
}
