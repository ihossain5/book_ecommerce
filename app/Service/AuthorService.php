<?php
namespace App\Service;

use App\Exceptions\PrecedanceExistException;
use App\Models\Author;
use Illuminate\Support\Str as Str;


    /** Get All Author */
    function all() {
        return Author::latest()->get();
    }

    /** store a Author */
    function store($data, $photo) {

        $precedance_exists = Author::where('precedance', $data['precedance'])->first();

        if ($precedance_exists) {
            throw new PrecedanceExistException('This precedance is taken');
        }

        $photo_url = $this->uploadPhoto($photo);

        $author = Author::create($data);

        $author->update(['photo' => $photo_url]);

        $author->formated_description = Str::limit($author->description, 30, '...');

        return $author;

    }

    function updateAuthor($author, $request) {
        $photo = $request->photo;

        $precedance_exists = Author::where('author_id', '!=', $author->author_id)->where('precedance', $request->precedance)->first();

        if ($precedance_exists) {
            throw new PrecedanceExistException('This precedance is taken');
        }

        if ($photo) {
            deleteImage($author->photo);
            $photo_url = $this->uploadPhoto($photo);
        } else {
            $photo_url = $author->photo;
        }
        $author->update([
            'name'        => $request->name,
            'description' => $request->description,
            'precedance'  => $request->precedance,
            'photo'       => $photo_url,

        ]);

        $author->formated_description = Str::limit($author->description, 30, '...');

        return $author;

    }

    function uploadPhoto($photo) {
        $path = 'authors/';

        $photo_url = storeImage($photo, $path, 277, 369);

        return $photo_url;
    }

}