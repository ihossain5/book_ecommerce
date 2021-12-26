<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();


        return view('admin.contact.contact', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //dd($request->all());

        $validator = Validator::make($request->all(), [

            'add_name'    => 'required|max:100',
            'add_contact'   => 'required|digits:11',
            'add_email'       => 'required|max:100|email',
            'add_address'    => 'required|max:100',
            'add_pabx'    => 'nullable|max:11',
            'add_bcash'    => 'nullable|digits:11',
         
          

        ]);

        if ($validator->fails()) {

            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {

            $contacts = Contact::create([
                'name' => $request->add_name,
                'contact_number' => $request->add_contact,
                'email' => $request->add_email,
                'address' => $request->add_address,
                'pabx' => $request->add_pabx,
                'bcash' => $request->add_bcash,

            ]);

            /// variable=>db data
            $data = array();
            $data['message'] = 'Contact Added Successfully';
            $data['name'] = $contacts->name;
            $data['contact'] = $contacts->contact_number;
            $data['email'] = $contacts->email;
            $data['address'] = $contacts->address;
            $data['pabx'] = $contacts->pabx;
            $data['bcash'] = $contacts->bcash;
            $data['id'] = $contacts->id;


            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         //dd($request->id);
         $contacts = Contact::find($request->id);
         //dd($testimonials);
         if ($contacts) {
             return response()->json([
                 'success' => true,
                 'data'    => $contacts,
             ]);
         } else {
             return response()->json([
                 'success' => false,
                 'data'    => 'No information found',
             ]);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'edit_name'    => 'required|max:100',
            'edit_contact'   => 'required|digits:11',
            'edit_email'       => 'required|max:100|email',
            'edit_address'    => 'required|max:100',
            'edit_pabx'    => 'nullable|max:11',
            'edit_bcash'    => 'nullable|digits:11',
            'hidden_id'       => 'required',
        ]);
        if ($validator->fails()) {
            $data          = array();
            $data['error'] = $validator->errors()->all();
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        } else {
            $contacts = Contact::find($request->hidden_id);


            $contacts['name']       = $request->edit_address;
            $contacts['contact_number']       = $request->edit_contact;
            $contacts['email']       = $request->edit_email;
            $contacts['address']       = $request->edit_address;
            $contacts['pabx']       = $request->edit_pabx;
            $contacts['bcash']       = $request->edit_bcash;
          
            $contacts->update();

            $data                = array();
            $data['message']     = 'Contact updated successfully';
            $data['name']       = $contacts->name;
            $data['contact']       = $contacts->contact_number;
            $data['email']       = $contacts->email;
            $data['address']       = $contacts->address;
            $data['pabx'] =  $contacts->pabx;
            $data['bcash']       = $contacts->bcash;
            $data['id']          = $request->hidden_id;

            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request->id);
        $contacts= Contact::findOrFail($request->id);
        if ($contacts) {
            $contacts->delete();
            $data            = array();
            $data['message'] = 'Contact deleted successfully';
            $data['id']      = $request->id;
            return response()->json([
                'success' => true,
                'data'    => $data,
            ]);
        } else {
            $data            = array();
            $data['message'] = 'Contact can not deleted!';
            return response()->json([
                'success' => false,
                'data'    => $data,
            ]);
        }
    }
}
