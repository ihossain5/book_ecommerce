<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Service\OfferService;
use Exception;
use Illuminate\Http\Request;

class OfferController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OfferService $offerService) {
        $books = $offerService->getBooks();

        $offers = $offerService->all();

        return view('admin.offers.offer_management', compact('books', 'offers'));
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
    public function store(OfferRequest $request, OfferService $offerService) {
        try {
            $offer = $offerService->store($request->validated());

            $offer->load('books');

            $data = [];

            foreach ($offer->books->take(3) as $book) {
                $data[] = $book->title;
            }

            $offer->message = 'Offer created successfully';

            $offer->data = $data;

            return $this->success($offer);

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
    public function edit(Offer $offer) {
        $offer->load('books');

        return $this->success($offer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, Offer $offer) {
        try {

            $offer->update(['title' => $request->title]);

            $offer->books()->sync($request->book);

            $offer->load('books');

            $data = [];

            foreach ($offer->books->take(3) as $book) {
                $data[] = $book->title;
            }

            $offer->message = 'Offer updated successfully';

            $offer->data = $data;

            return $this->success($offer);

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
    public function destroy(Offer $offer) {

        $offer->delete();

        $offer->message = 'Offer deleted successfully';

        return $this->success($offer);
    }

    public function updateStatus(Request $request, OfferService $offerService) {
        try {
            $offer = $offerService->updateStatus($request->id);

            $offer->message = 'Status updated successfully';

            return $this->success($offer);

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }
}
