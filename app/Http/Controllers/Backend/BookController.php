<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Models\Book;
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
        $books      = $bookService->all();
        $attributes   = FeatureAttribute::orderBy('name', 'ASC')->get();

        return view('admin.book.book_management', compact('publications', 'categories', 'authors', 'attributes','books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
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
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
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
}
