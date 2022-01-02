<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublicationStoreRequest;
use App\Http\Requests\PublicationUpdateRequest;
use App\Models\Publication;
use App\Service\PublicationService;
use Exception;
use Illuminate\Http\Request;

class PublicationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PublicationService $publicationService) {

        $publications = $publicationService->all();

        return view('admin.publication.publication', compact('publications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationStoreRequest $request, PublicationService $publicationService) {
        try {
            $photo = $request->photo;

            $publication = $publicationService->store($request->validated(), $photo);

            $publication->message = 'Publication created successfully';

            return $this->success($publication);

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
    public function edit(Publication $publication) {

        return $this->success($publication);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicationUpdateRequest $request, Publication $publication, PublicationService $publicationService) {
        try {

            $publication = $publicationService->updatePublication($publication, $request);

            $publication->message = 'Publication updated successfully';

            return $this->success($publication);

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
    public function destroy(Publication $publication) {
        try {
            deleteImage($publication->photo);

            $publication->delete();

            $publication->message = 'Publication deleted successfully';

            return $this->success($publication);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }
}
