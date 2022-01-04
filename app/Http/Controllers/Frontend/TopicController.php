<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publication;
use App\Models\Slider;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $sliders=Slider::all();
        return view('frontend.topic.topics',compact('sliders','categories'));
    }
    
    public function topic_name($id)
    {

        $authors=Author::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $publications=Publication::orderBy('name')->get();

        $category_books=BookCategory::with('books')->where('category_id',$id)->get();
        $book_list=[];
        foreach($category_books as $category_book){

            $book_list[]=$category_book->book_id;
        }


        $books=Book::with('authors','reviews')->whereIn('book_id',$book_list)->get();

        // foreach($books as $book){
        //     $rating=getTotalRating($book->reviews);
        //     $book->rating=$rating;
        // }
        //dd($books);

        //dd($books);
        $category_details=Category::where('category_id',$id)->first();
       
        return view('frontend.topic.topics_name',compact('category_books','category_details','authors','categories','publications','books'));
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
