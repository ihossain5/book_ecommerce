<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Author;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Book;
use App\Http\Controllers\Controller;
use App\Models\BookAuthor;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        $authors=Author::all();
        return view('frontend.writer.writers',compact('sliders','authors'));
    }

    public function author_details($id)
    {

        $authors=Author::orderBy('name')->get();
        $categories=Category::orderBy('name')->get();
        $publications=Publication::orderBy('name')->get();

        $author_books=BookAuthor::with('books')->where('author_id',$id)->get();


        $book_list=[];
        foreach($author_books as $author_book){

            $book_list[]=$author_book->book_id;
        }


        $books=Book::with('authors')->whereIn('book_id',$book_list)->get();

        $author_info=Author::where('author_id',$id)->first();
        //dd($author_info);
        return view('frontend.writer.writer_details',compact('author_info','authors','categories','publications','author_books','books'));
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
