<?php
namespace App\Service;

use App\Models\Author;


Class AuthorService {

    /** Get All Author */
    function all() {
        return Author::latest()->get();
    }

    /** store a Author */
    function store($data, $photo) {

        $photo_url = $this->uploadPhoto($photo);

        $author = Author::create($data);

        $author->update(['photo'=> $photo_url]);

        return $author;

    }



    function updateAuthor($author, $request){
        $photo  = $request->photo;
        
        if($photo){
            deleteImage($author->photo);
            $photo_url = $this->uploadPhoto($photo);
        }else{
            $photo_url = $author->photo;
        }
        $author->update([
            'name'        => $request->name,
            'description' => $request->description,
            'photo'       => $photo_url,

        ]);

        return $author;

    }

     function uploadPhoto($photo){
        $path = 'authors/';

        $photo_url = storeImage($photo, $path, 401, 296);

        return $photo_url;
    }

}