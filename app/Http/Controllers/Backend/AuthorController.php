<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationStoreRequest;
use App\Http\Requests\PublicationUpdateRequest;
use App\Models\Author;
use App\Service\AuthorService;
use Exception;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuthorService $authorService)
    {
        $authors = $authorService->all();

        return view('admin.author.author_management',compact('authors'));
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
    public function store(PublicationStoreRequest $request, AuthorService $authorService) {
        try {
            $photo = $request->photo;

            $author = $authorService->store($request->validated(), $photo);

            $author->message = 'Author created successfully';

            return $this->success($author);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author) {

        return $this->success($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicationUpdateRequest $request, Author $author, AuthorService $authorService) {
        try {

            $author = $authorService->updateAuthor($author, $request);

            $author->message = 'Author updated successfully';

            return $this->success($author);

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
    public function destroy(Author $author) {
        try {
            deleteImage($author->photo);

            $author->delete();

            $author->message = 'Author deleted successfully';

            return $this->success($author);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}
