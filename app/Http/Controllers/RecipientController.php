<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($firmId,$recipientId)
    {
        $recipient = Recipient::where('firm_id','=',$firmId)->find($recipientId);
        if (is_null($recipient)){
            return redirect()->back()->with(['error' => 'Recipient Not Found.']);
        }
        return view('manage-firm/recipient.detail',compact('recipient'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipient $recipient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipient $recipient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipient $recipient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipient $recipient)
    {
        //
    }
}
