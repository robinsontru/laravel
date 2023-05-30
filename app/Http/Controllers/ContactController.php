<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return  contact::orderBy('id','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $contact= new contact;
        $contact->create($request->all());
    
    }

    /**
     * Display the specified resource.
     */
    public function show(contact $contact)
    {
        
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contact $contact)
    {
        $contact->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contact $contact)
    {
        $contact->delete();
    }
}
