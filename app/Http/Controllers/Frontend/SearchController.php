<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publication;
use App\Http\Controllers\Controller;
use App\Models\BookAuthor;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book_filter(Request $request)
    {
        //dd($request->all());

        $request->category_list;
        $category_search_key=$request->category_search_key;
        $publisher_search_key=$request->publisher_search_key;
        $request->price;
        $request->publisher_list;
        $request->writer_list;
        $writer_search_key=$request->writer_search_key;

        if($category_search_key!=null || $writer_search_key!=null || $publisher_search_key!=null){


            if($category_search_key!=null){
    
                $book_categories=Category::where('name', 'LIKE', '%' . $category_search_key. '%')->get();
                //dd($book_categories);
                $category_ids=[];
                foreach($book_categories as $book_category){
    
                    $category_ids[]=$book_category->category_id ;
                }
                //dd($category_ids);
    
                $book_categories=BookCategory::whereIn('category_id',$category_ids)->get();
            
                //dd($book_categories);
                $book_ids=[];
                foreach($book_categories as $book_category){
    
                    $book_ids[]=$book_category->book_id;
                }
                //dd($book_ids);
                
                if($book_ids!=null){
    
                    $bookID=Book::with('authors')->whereIn('book_id',$book_ids)->get();
        
                    //dd($bookID);
                }else{
                    $bookID=[];
                }
    
    
            }
    

            if($writer_search_key!=null){
    
                $book_authors=Author::where('name', 'LIKE', '%' . $writer_search_key. '%')->get();
                //dd($book_categories);
                $author_ids=[];
                foreach($book_authors as $book_author){
    
                    $author_ids[]=$book_author->author_id ;
                }
                //dd($author_ids);
    
                $book_authors=BookAuthor::whereIn('author_id',$author_ids)->get();
            
                //dd($book_authors);
                $book_ids=[];
                foreach($book_authors as $book_authors){
    
                    $book_ids[]=$book_authors->book_id;
                }
                //dd($book_ids);
                
                if($book_ids!=null){
    
                    $bookID=Book::with('authors')->whereIn('book_id',$book_ids)->get();
        
                    //dd($bookID);
                }else{
                    $bookID=[];
                }
    
    
            }
    
            if($publisher_search_key!=null){
    
                $book_publications=Publication::where('name', 'LIKE', '%' . $publisher_search_key. '%')->get();
                //dd($book_categories);
                $publication_ids=[];
                foreach($book_publications as $book_publication){
    
                    $publication_ids[]=$book_publication->publication_id  ;
                }
                //dd($publication_ids);
                
                if($publication_ids!=null){
    
                    $bookID=Book::with('authors')->whereIn('publication_id',$publication_ids)->get();
        
                    //dd($bookID);
                }else{
                    $bookID=[];
                }
    
            }
    
    
            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);
        
            }else{

                $books=Book::with('authors')->get();
                return response()->json([
                    'success' => true,
                    'book_list' => $books,
                ]);

            }



    }
    
    public function book_detials_filter(Request $request)
    {
       //dd($request->all());

       $author_id=$request->author_id;
       $category_list=$request->category_list;
       $category_search_key=$request->category_search_key;
       $writer_search_key=$request->writer_search_key;
       $publisher_search_key=$request->publisher_search_key;
       $price=$request->price;
       $publisher_list=$request->publisher_list;
       $writer_list=$request->writer_list;

       $author_info=Author::where('author_id',$author_id)->first();
       $author_name= $author_info->name;
       
       if($category_search_key!=null || $writer_search_key!=null || $publisher_search_key!=null){


        if($category_search_key!=null){

            $book_categories=Category::where('name', 'LIKE', '%' . $category_search_key. '%')->get();
            //dd($book_categories);
            $category_ids=[];
            foreach($book_categories as $book_category){

                $category_ids[]=$book_category->category_id ;
            }
            //dd($category_ids);

            $book_categories=BookCategory::whereIn('category_id',$category_ids)->get();
        
            //dd($book_categories);
            $book_ids=[];
            foreach($book_categories as $book_category){

                $book_ids[]=$book_category->book_id;
            }
            //dd($book_ids);
            
            if($book_ids!=null){

                $bookID=Book::whereIn('book_id',$book_ids)->get();
    
                //dd($bookID);
            }else{
                $bookID=[];
            }


        }



        if($writer_search_key!=null){

            $book_authors=Author::where('name', 'LIKE', '%' . $writer_search_key. '%')->get();
            //dd($book_categories);
            $author_ids=[];
            foreach($book_authors as $book_author){

                $author_ids[]=$book_author->author_id ;
            }
            //dd($author_ids);

            $book_authors=BookAuthor::whereIn('author_id',$author_ids)->get();
        
            //dd($book_authors);
            $book_ids=[];
            foreach($book_authors as $book_authors){

                $book_ids[]=$book_authors->book_id;
            }
            //dd($book_ids);
            
            if($book_ids!=null){

                $bookID=Book::whereIn('book_id',$book_ids)->get();
    
                //dd($bookID);
            }else{
                $bookID=[];
            }


        }

        if($publisher_search_key!=null){

            $book_publications=Publication::where('name', 'LIKE', '%' . $publisher_search_key. '%')->get();
            //dd($book_categories);
            $publication_ids=[];
            foreach($book_publications as $book_publication){

                $publication_ids[]=$book_publication->publication_id  ;
            }
            //dd($publication_ids);
            
            if($publication_ids!=null){

                $bookID=Book::whereIn('publication_id',$publication_ids)->get();
    
                //dd($bookID);
            }else{
                $bookID=[];
            }

        }


        return response()->json([
            'success' => true,
            'book_list' => $bookID,
            'author_name'=>$author_name,
        ]);
    
        }elseif($category_list!=null){
            //dd($category_list);

            $book_categories=BookCategory::whereIn('category_id',$category_list)->get();
        
            //dd($book_categories);
            $book_ids=[];
            foreach($book_categories as $book_category){

                $book_ids[]=$book_category->book_id;
            }
            //dd($book_ids);
            
            if($book_ids!=null){

                $book_authors=BookAuthor::whereIn('book_id',$book_ids)->where('author_id',$author_id)->get();
                //dd($book_authors);
    
                foreach($book_authors as $book_author){
    
                    $book_list[]=$book_author->book_id;
                }
                //dd($book_list);
    
                $bookID=Book::whereIn('book_id',$book_list)->get();
    
                //dd($bookID);
                
            }else{
                $bookID=[];
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name'=>$author_name,
            ]);

        }elseif($price!=null){

            $book_authors=BookAuthor::where('author_id',$author_id)->get();

            foreach($book_authors as $book_author){

                $book_list[]=$book_author->book_id;
            }

            if($price==100){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [0, 100])->get();
            }elseif($price==500){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [100, 500])->get();
            }elseif($price==1000){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [500, 1000])->get();
            }elseif($price==1500){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [1000, 2000])->get();
            }elseif($price==2000){
                $bookID=Book::whereIn('book_id',$book_list)->where('regular_price', '=>',2000)->get();
            }else{

                $book_authors=BookAuthor::where('author_id',$author_id)->get();

                foreach($book_authors as $book_author){
    
                    $book_list[]=$book_author->book_id;
                }
    
                $bookID=Book::whereIn('book_id',$book_list)->get();
            }
           
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name'=>$author_name,
            ]);
        }elseif($publisher_list!=null){

            $book_authors=BookAuthor::where('author_id',$author_id)->get();
            //dd($book_authors);

            foreach($book_authors as $book_author){

                $book_list[]=$book_author->book_id;
            }
            //dd($book_list);

            $bookID=Book::whereIn('book_id',$book_list)->whereIn('publication_id',$publisher_list)->get();

            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name'=>$author_name,
            ]);
        }elseif($writer_list!=null){
           
            $book_authors=BookAuthor::whereIn('author_id',$writer_list)->get();

            //dd($book_authors);
            $book_list=[];
        
            foreach($book_authors as $book_author){

                $book_list[]=$book_author->book_id;
            }
            //dd($book_list);
            $unique=array_unique($book_list);
            //dd($unique);

            $bookID=Book::whereIn('book_id',$unique)->get();
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name'=>$author_name,
            ]);
        }else{
                $book_authors=BookAuthor::where('author_id',$author_id)->get();

                foreach($book_authors as $book_author){

                    $book_list[]=$book_author->book_id;
                }

                $bookID=Book::whereIn('book_id',$book_list)->get();
                return response()->json([
                    'success' => true,
                    'book_list' => $bookID,
                    'author_name'=>$author_name,
                ]); 
            }

       



    }




    public function topic_filter(Request $request)
    {
       //dd($request->all());

       $category_id=$request->category_id;
       $category_list=$request->category_list;
       $category_search_key=$request->category_search_key;
       $writer_search_key=$request->writer_search_key;
       $publisher_search_key=$request->publisher_search_key;
       $price=$request->price;
       $publisher_list=$request->publisher_list;
       $writer_list=$request->writer_list;

    //    $author_info=Author::where('author_id',$author_id)->first();
    //    $author_name= $author_info->name;
       
       if($category_search_key!=null || $writer_search_key!=null || $publisher_search_key!=null){


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

                $bookID=Book::with('authors')->whereIn('book_id',$book_ids)->get();

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

                $bookID=Book::with('authors')->whereIn('book_id',$book_ids)->get();

                $books_id=BookAuthor::whereIn('book_id',$bookID)->get();
                $author_id=[];
                foreach($books_id as $book_id){

                    $author_id[]=$book_id->author_id;
                }

                $authors=Author::whereIn('author_id',$author_id)->get();

                foreach($authors as $author){

                    $bookID['author_name']=$author->name;
                }
    
                //dd($bookID);
            }else{
                $bookID=[];
            }


        }if($publisher_search_key!=null){

            $category_id=$request->category_id;

            $book_publications=Publication::where('name', 'LIKE', '%' . $publisher_search_key. '%')->get();
            //dd($book_publications);
            $publication_ids=[];
            foreach($book_publications as $book_publication){

                $publication_ids[]=$book_publication->publication_id  ;
            }
            //dd($publication_ids);


            $publicationToBooks=Book::whereIn('publication_id',$publication_ids)->get();
            //dd($publicationToBooks);
            $Book_Category_ids=[];
            foreach($publicationToBooks as $publicationToBook){

                $Book_Category_ids[]=$publicationToBook->book_id;
            }
            //dd($Book_Category_ids);
            $book_categories=BookCategory::whereIn('book_id',$Book_Category_ids)->where('category_id', $category_id)->get();
        
            //dd($book_categories);
            $book_ids=[];
            foreach($book_categories as $book_category){

                $book_ids[]=$book_category->book_id;
            }
            
            if($book_ids!=null){

                $bookID=Book::with('authors')->whereIn('book_id',$book_ids)->get();

                $books_id=BookAuthor::whereIn('book_id',$bookID)->get();
                $author_id=[];
                foreach($books_id as $book_id){

                    $author_id[]=$book_id->author_id;
                }

                $authors=Author::whereIn('author_id',$author_id)->get();

                foreach($authors as $author){

                    $author_name=$author->name;
                }
    
                //dd($bookID);
            }else{
                $bookID=[];
                $author_name="";
            }

        }

        return response()->json([
            'success' => true,
            'book_list' => $bookID,
            
        ]);
    
    }elseif($writer_list!=null){
           
            $category_id=$request->category_id;
            $book_authors=BookAuthor::whereIn('author_id',$writer_list)->get();

            //dd($book_authors);
            $book_list=[];
        
            foreach($book_authors as $book_author){

                $book_list[]=$book_author->book_id;
            }
            //dd($book_list);
            $unique=array_unique($book_list);
            //dd($unique);

            $book_categories=BookCategory::whereIn('book_id',$unique)->where('category_id', $category_id)->get();
        
            //dd($book_authors);
            $book_ids=[];
            foreach($book_categories as $book_category){

                $book_ids[]=$book_category->book_id;
            }
            //dd($book_ids);
            
            if($book_ids!=null){

                $bookID=Book::with('authors')->with('authors')->whereIn('book_id',$book_ids)->get();

                $books_id=BookAuthor::whereIn('book_id',$bookID)->get();
                $author_id=[];
                foreach($books_id as $book_id){

                    $author_id[]=$book_id->author_id;
                }

                $authors=Author::whereIn('author_id',$author_id)->get();

                foreach($authors as $author){

                    $author_name=$author->name;
                }
    
                //dd($bookID);
            }else{
                $bookID=[];
                $author_name="";
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);


        }elseif($publisher_list!=null){

            $category_id=$request->category_id;

            $book_categories=BookCategory::where('category_id', $category_id)->get();
            //dd($book_authors);
            $book_ids=[];
            foreach($book_categories as $book_category){

                $book_ids[]=$book_category->book_id;
            }

            $book_IDs=Book::whereIn('book_id',$book_ids)->get();

            $book_ids2=[];
            foreach($book_IDs as $book_ID){

                $book_ids2[]=$book_ID->book_id;
            }

            $book_IDs2=Book::whereIn('publication_id',$publisher_list)->get();
            //dd($book_IDs2);
            $bookID=[];
            foreach($book_IDs2 as $book_IDs){

                $bookID[]=$book_IDs->book_id;
            }

            //dd($bookID);
            if($bookID!=null){

                $bookID=Book::with('authors')->whereIn('book_id',$bookID)->get();

                $books_id=BookAuthor::whereIn('book_id',$bookID)->get();
                $author_id=[];
                foreach($books_id as $book_id){

                    $author_id[]=$book_id->author_id;
                }

                $authors=Author::whereIn('author_id',$author_id)->get();

                foreach($authors as $author){

                    $author_name=$author->name;
                }
    
                //dd($bookID);
            }else{
                $bookID=[];
                $author_name="";
            }

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
            ]);

        }elseif($price!=null){
            $category_id=$request->category_id;

            $book_categories=BookCategory::where('category_id', $category_id)->get();
            //dd($book_authors);
            $book_list=[];
            foreach($book_categories as $book_category){

                $book_list[]=$book_category->book_id;
            }

            if($price==100){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [0, 100])->get();
            }elseif($price==500){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [100, 500])->get();
            }elseif($price==1000){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [500, 1000])->get();
            }elseif($price==1500){
                $bookID=Book::whereIn('book_id',$book_list)->whereBetween('regular_price', [1000, 2000])->get();
            }elseif($price==2000){
                $bookID=Book::whereIn('book_id',$book_list)->where('regular_price', '=>',2000)->get();
            }else{
                
                $book_categories=BookCategory::where('category_id', $category_id)->get();
    
                $book_ids=[];
                foreach($book_categories as $book_category){
    
                    $book_ids[]=$book_category->book_id;
                }
    
                $bookID=Book::whereIn('book_id',$book_list)->get();
            }

            $author_name="";
            if($bookID!=null){

                $bookID=Book::with('authors')->whereIn('book_id',$bookID)->get();

                $books_id=BookAuthor::whereIn('book_id',$bookID)->get();
                $author_id=[];
                foreach($books_id as $book_id){

                    $author_id[]=$book_id->author_id;
                }

                $authors=Author::whereIn('author_id',$author_id)->get();

                foreach($authors as $author){

                    $author_name=$author->name;
                }
    
                //dd($bookID);
            }else{
                $bookID=[];
                $author_name="";
            }
           
            //dd($bookID);

            return response()->json([
                'success' => true,
                'book_list' => $bookID,
                'author_name'=>$author_name,
            ]);
        }else{
            $category_id=$request->category_id;
            $category_books=BookCategory::where('category_id',$category_id)->get();
            //dd($category_books);
            
            $bookID=[];
            foreach($category_books as $category_book){

                $bookID[]=$category_book->book_id ;
            }
            
            //dd($book_ids)
            
            $author_name="";
            if($bookID!=null){

                $bookID=Book::with('authors')->whereIn('book_id',$bookID)->get();

                $books_id=BookAuthor::whereIn('book_id',$bookID)->get();
                $author_id=[];
                foreach($books_id as $book_id){

                    $author_id[]=$book_id->author_id;
                }

                $authors=Author::whereIn('author_id',$author_id)->get();

                foreach($authors as $author){

                    $author_name=$author->name;
                }
    
                //dd($bookID);
            }else{
                $bookID=[];
                $author_name="";
            }

            //$bookID=Book::all();
            return response()->json([
                'success' => true,
                'book_list' => $bookID,
               
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
