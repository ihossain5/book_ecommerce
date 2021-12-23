<?php
namespace App\Service;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

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

        return $book;

    }

    function updateAuthor($author, $request) {
        $photo = $request->photo;

        if ($photo) {
            deleteImage($author->photo);
            $photo_url = $this->uploadPhoto($photo);
        } else {
            $photo_url = $author->photo;
        }
        $author->update([
            'name'        => $request->name,
            'description' => $request->description,
            'photo'       => $photo_url,

        ]);

        return $author;

    }

    /** upload book photo */
    function uploadPhoto($photo) {
        $path = 'books/';

        $photo_url = storeImage($photo, $path, 401, 296);

        return $photo_url;
    }

    /** upload book pdf  */
    function uploadPdf($pdf) {
        $path = 'books/';

        $pdf_url = storePdf($pdf, $path);

        return $pdf_url;
    }

    /** store book and related data into database   */
    protected function storeIntoDB($data, $cover_photo, $back_photo, $preview_book) {
        $book = $this->book;

        DB::transaction(function () use ($data, $cover_photo, $back_photo, $preview_book, $book) {
            
            $book->title                 = $data->title;
            $book->isbn                  = $data->isbn;
            $book->publication_id        = $data->publication_id;
            $book->short_description     = $data->short_description;
            $book->long_description      = $data->long_description;
            $book->backside_image        = $data->back_photo;
            $book->cover_image           = $data->cover_photo;
            $book->book_preview          = $data->preview_book;
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

            $book->update([
                'backside_image' => $back_photo,
                'cover_image'    => $cover_photo,
                'book_preview'   => $preview_book,
            ]);

            $book->categories()->attach($data->category);

            $book->authors()->attach($data->author);

            if($data->attribute){
                foreach ($data->attribute as $key => $attribute) {
                    $book->featureAttributes()->attach([$key => [
                        'value' => $attribute,
                    ]]);
                }
            }
            
        });
        return $book;
    }

}