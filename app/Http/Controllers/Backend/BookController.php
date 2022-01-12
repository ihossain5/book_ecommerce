<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\BookReview;
use App\Models\FeatureAttribute;
use App\Service\AuthorService;
use App\Service\BookService;
use App\Service\CategoryService;
use App\Service\PublicationService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PublicationService $publicationService, CategoryService $categoryService, AuthorService $authorService, BookService $bookService) {
        $publications = $publicationService->all();
        $categories   = $categoryService->all();
        $authors      = $authorService->all();
        $books        = $bookService->all();
        $attributes   = FeatureAttribute::orderBy('name', 'ASC')->get();

        return view('admin.book.book_management', compact('publications', 'categories', 'authors', 'attributes', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookStoreRequest $request, BookService $bookService) {
        try {
            $book = $bookService->store($request);

            $book->message = 'Book created successfully';

            return $this->success($book);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book) {
        $book->load('categories', 'authors', 'authors', 'featureAttributes');

        return $this->success($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book, BookService $bookService) {
        // dd($request->all());
        try {
            $book = $bookService->updateBook($book, $request);

            $book->message = 'Book updated successfully';

            return $this->success($book);

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
    public function destroy(Book $book) {
        try {
            deleteImage($book->cover_image);

            deleteImage($book->backside_image);

            deletePdf($book->book_preview);

            $book->delete();

            $book->message = 'Book deleted successfully';

            return $this->success($book);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }

    public function updateStatus(Request $request, BookService $bookService) {
        try {

            $book = $bookService->updateStatus($request->id, $request->type);

            $book->message = 'Book updated successfully';

            return $this->success($book);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }
    public function getPdf(Book $book) {
        return $this->success($book->book_preview);
    }

    public function book_review($id) {
        
        $book_reivews=BookReview::with('user')->where('book_id',$id)->get();
        $book_info=Book::with('reviews')->where('book_id',$id)->first();
        $book_name=$book_info->title;
        return view('admin.book.book_review',compact('book_reivews','book_name','book_info'));
    }


}
 