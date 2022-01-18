<?php
namespace App\Service;

use App\Exceptions\PrecedanceExistException;
use App\Models\Publication;

Class PublicationService {

    /** Get All Publications */
    function all() {
        return Publication::latest()->get();
    }

    /** store a publication */
    function store($data, $photo) {

        $precedance_exists = Publication::where('precedance', $data['precedance'])->first();

        if ($precedance_exists) {
            throw new PrecedanceExistException('This precedance is taken');
        }


        $photo_url = $this->uploadPhoto($photo);

        $publication = Publication::create($data);

        $publication->update(['photo'=> $photo_url]);

        return $publication;

    }



    function updatePublication($publication, $request){
        $photo  = $request->photo;

        $precedance_exists = Publication::where('publication_id', '!=', $publication->publication_id)->where('precedance', $request->precedance)->first();

        if ($precedance_exists) {
            throw new PrecedanceExistException('This precedance is taken');
        }
        
        if($photo){
            deleteImage($publication->photo);
            $photo_url = $this->uploadPhoto($photo);
        }else{
            $photo_url = $publication->photo;
        }
        $publication->update([
            'name'        => $request->name,
            'description' => $request->description,
            'precedance' => $request->precedance,
            'photo'       => $photo_url,

        ]);

        return $publication;

    }

     function uploadPhoto($photo){
        $path = 'publications/';

        $photo_url = storeImage($photo, $path, 401, 296);

        return $photo_url;
    }

}