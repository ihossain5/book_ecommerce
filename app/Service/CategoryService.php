<?php
namespace App\Service;

use App\Models\Category;

Class CategoryService {

    /** Get All Category */
    function all() {
        return Category::latest()->get();
    }

    /** Find a Category By Id */
    function find($id) {
        return Category::findOrFail($id);
    }

    /** store a category */
    function store($data) {

        $photo_url = $this->uploadPhoto($data['photo']);

        $category = Category::create($data);

        $category->update(['photo' => $photo_url]);

        return $category;
    }

    /** update a category */
    function update($id, $data, $photo = null) {
        $category = $this->find($id);

        // $photo = $data['photo'];

        if ($photo != null) {
            deleteImage($category->photo);
            $photo_url = $this->uploadPhoto($photo);
        } else {
            $photo_url = $category->photo;
        }

        $category->update([
            'name'        => $data['name'],
            'description' => $data['description'],
            'photo'       => $photo_url,
        ]);

        return $category;
    }

    /** Update Category Status */
    function updateStatus($id, $type) {
        if ($type == 'is_nav') {

            return $this->updateNavStatus($id);

        } else if ($type == 'is_home') {

            return $this->updateHomeStatus($id);

        } else {

            return false;
        }
    }

    /** Update Category Home Status */
    function updateHomeStatus($id) {
        $category = $this->find($id);

        if ($category->is_home == 0) {
            $category->update([
                'is_home' => 1,
            ]);
        } else {
            $category->update([
                'is_home' => 0,
            ]);
        }
        return $category;
    }

    /** Update Category Nav Status */
    function updateNavStatus($id) {
        $category = $this->find($id);

        if ($category->is_nav == 0) {
            $category->update([
                'is_nav' => 1,
            ]);
        } else {
            $category->update([
                'is_nav' => 0,
            ]);
        }
        return $category;
    }

    function uploadPhoto($photo) {
        $path = 'categories/';

        $photo_url = storeImage($photo, $path, 207, 296);

        return $photo_url;
    }
}