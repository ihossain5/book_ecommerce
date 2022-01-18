<?php
namespace App\Service;

use App\Models\Book;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;

Class OfferService {

    public $model;

    public function __construct(Offer $model) {
        $this->model = $model;
    }

    /* get all books  */
    function getBooks() {
        return Book::all();
    }

    /* get all offers  */
    function all() {
        return $this->model->with('books')->latest()->get();
    }

     /* store a offer */
    function store($data) {
        $offer = $this->model->create(['title' => $data['title']]);

        $offer->books()->attach($data['book']);

        return $offer;
   
    }

      /* update a offer */

      function updateOffer($data) {

        $offer = $data->update(['title' => $data['title']]);

        $offer->books()->sync($data['book']);

        return $offer;
   
    }

        /** Update offer Status */
        function updateStatus($id) {
            $offer = $this->model->findOrFail($id);

            if ($offer->is_visible == 0) {
                $offer->update([
                    'is_visible' => 1,
                ]);
            } else {
                $offer->update([
                    'is_visible' => 0,
                ]);
            }
            return $offer;
        }

}