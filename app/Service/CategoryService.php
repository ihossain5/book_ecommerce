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
        return Category::create($data);
    }

    /** store a category */
    function update($id,$data) {
        $category = $this->find($id);
        
        $category->update($data);

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
}