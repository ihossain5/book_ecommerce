<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureAttributeRequest;
use App\Models\FeatureAttribute;
use Exception;
use Illuminate\Http\Request;

class FeatureAttributeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $attributes = FeatureAttribute::latest()->get();
        return view('admin.feature-attribute.feature_attribute', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureAttributeRequest $request) {
        try {
            $attribute = FeatureAttribute::create($request->validated());

            $message = 'Feature attribute created successfully';

            return $this->success($this->responseMessage($message, $attribute));

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(FeatureAttribute $feature_attribute) {
        return $this->success($feature_attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeatureAttributeRequest $request, FeatureAttribute $feature_attribute) {
        try {
            $feature_attribute->update($request->validated());

            $message = 'Feature attribute updated successfully';

            return $this->success($this->responseMessage($message, $feature_attribute));

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
    public function destroy(FeatureAttribute $feature_attribute) {
        try {
            $feature_attribute->delete();

            $message = 'Feature attribute deleted successfully';

            return $this->success($this->responseMessage($message, $feature_attribute));

        } catch (Exception $e) {

            return $this->error($e->getMessage());
        }

    }

    // response message function
    function responseMessage($message, $attribute = null) {
        $data              = array();
        $data['message']   = $message;
        $data['attribute'] = $attribute;
        return $data;
    }
}
