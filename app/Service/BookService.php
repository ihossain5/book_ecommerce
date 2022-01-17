<?php
namespace App\Service;

use App\Exceptions\BookNotAvailAbleException;
use App\Models\Book;

Class BookService {

    public $book;

    public function __construct(Book $book) {
        $this->book = $book;
    }

    /** Get All books */
    function all() {
        return $this->book->latest()->get();
    }

    /** store a book */
    function store($data) {

        $cover_photo = $this->uploadPhoto($data->cover_photo);

        $back_photo = $this->uploadPhoto($data->back_photo);

        $preview_book = $this->uploadPdf($data->preview_book);

        $book = $this->storeIntoDB($data, $cover_photo, $back_photo, $preview_book);

        $book->categories()->attach($data->category);

        $book->authors()->attach($data->author);

        if ($data->attribute) {
            foreach ($data->attribute as $key => $attribute) {
                $book->featureAttributes()->attach([$key => [
                    'value' => $attribute,
                ]]);
            }
        }

        return $book;

    }

    /** update a book */
    function updateBook($book, $data) {

        if ($data->cover_photo) {
            deleteImage($book->cover_image);
            $cover_photo = $this->uploadPhoto($data->cover_photo);
        } else {
            $cover_photo = $book->cover_image;
        }

        if ($data->back_photo) {
            deleteImage($book->backside_image);
            $back_photo = $this->uploadPhoto($data->back_photo);
        } else {
            $back_photo = $book->backside_image;
        }

        if ($data->preview_book) {
            deletePdf($book->book_preview);
            $preview_book = $this->uploadPdf($data->preview_book);
        } else {
            $preview_book = $book->book_preview;
        }

        $this->storeIntoDB($data, $cover_photo, $back_photo, $preview_book, $book);

        $book->categories()->sync($data->category);

        $book->authors()->sync($data->author);

        if ($data->attribute) {
            foreach ($data->attribute as $key => $attribute) {
                $values[$key] = [
                    'value' => $attribute,
                ];
            }
            $book->featureAttributes()->sync($values);
        }

        return $book;

    }

    /** upload book photo */
    function uploadPhoto($photo) {
        $path = 'books/';

        $photo_url = storeImage($photo, $path, 352, 501);

        return $photo_url;
    }

    /** upload book pdf  */
    function uploadPdf($pdf) {
        $path = 'books/';

        $pdf_url = storePdf($pdf, $path);

        return $pdf_url;
    }

    /** store book and related data into database   */
    protected function storeIntoDB($data, $cover_photo, $back_photo, $preview_book, $book = null) {
        if (!$book) {
            $book = $this->book;
        }

        // DB::transaction(function () use ($data, $cover_photo, $back_photo, $preview_book, $book) {

        $book->title                 = $data->title;
        $book->isbn                  = $data->isbn;
        $book->publication_id        = $data->publication_id;
        $book->short_description     = $data->short_description;
        $book->long_description      = $data->long_description;
        $book->backside_image        = $back_photo;
        $book->cover_image           = $cover_photo;
        $book->book_preview          = $preview_book;
        $book->regular_price         = floatval(preg_replace('/[^\d.]/', '', $data->regular_price));
        $book->discounted_percentage = floatval(preg_replace('/[^\d.]/', '', $data->discount_percentage));
        $book->discounted_price      = floatval(preg_replace('/[^\d.]/', '', $data->discounted_price));

        $book->save();

        // $book = $this->book->create([
        //     'title'                 => $data->title,
        //     'isbn'                  => $data->isbn,
        //     'publication_id'        => $data->publication_id,
        //     'short_description'     => $data->short_description,
        //     'long_description'      => $data->long_description,
        //     'backside_image'        => $data->long_description,
        //     'cover_image'           => $data->long_description,
        //     'book_preview'          => $data->long_description,
        //     'regular_price'         => floatval(preg_replace('/[^\d.]/', '', $data->regular_price)),
        //     'discounted_percentage' => floatval(preg_replace('/[^\d.]/', '', $data->discount_percentage)),
        //     'discounted_price'      => floatval(preg_replace('/[^\d.]/', '', $data->discounted_price)),
        // ]);

        // $book->update([
        //     'backside_image' => $back_photo,
        //     'cover_image'    => $cover_photo,
        //     'book_preview'   => $preview_book,
        // ]);

        // });
        return $book;
    }

    function find($id) {
        return $this->book->with('authors','reviews')->findOrFail($id);
    }

    /** Update book Status */
    function updateStatus($id, $type) {
        if ($type == 'is_visible') {

            return $this->updateVisibleStatus($id);

        } else if ($type == 'is_available') {

            return $this->updateAvailAbleStatus($id);

        } else {

            return false;
        }
    }

    /** Update book visible Status */
    function updateVisibleStatus($id) {
        $book = $this->find($id);

        if ($book->is_visible == 0) {
            $book->update([
                'is_visible' => 1,
            ]);
        } else {
            $book->update([
                'is_visible' => 0,
            ]);
        }
        return $book;
    }

    /** Update book available Status */
    function updateAvailAbleStatus($id) {
        $book = $this->find($id);

        if ($book->is_available == 0) {
            $book->update([
                'is_available' => 1,
            ]);
        } else {
            $book->update([
                'is_available' => 0,
            ]);
        }
        return $book;
    }

     /** check book availability */
    function checkAvailAbility($id){

        $book = $this->find($id);

        if($book->is_available != 1){
            throw new BookNotAvailAbleException('Book is not available');
        }

        return $book;
    }


}