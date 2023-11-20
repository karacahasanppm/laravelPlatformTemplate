<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

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
    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        $firmId = Auth::user()->firm_id;

        $rules = [
            'type_select' => 'required|'.Rule::in('Email','Sms'),
            'status_select' => 'required|'.Rule::in(1,0),
            'consent_date_input' => 'required|date_format:Y-m-d H:i:s'
        ];

        if ($request->type_select == "Email"){
            $rules['recipient_input'] = 'required|email|'.Rule::unique('recipients','recipient')->where('firm_id',$request->firm_id);
        }else{
            $rules['recipient_input'] = 'required|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/|'.Rule::unique('recipients','recipient')->where('firm_id',$request->firm_id);
        }

        $request->validate($rules);

        $recipient = new Recipient();
        $recipient->recipient = $request->recipient_input;
        $recipient->recipient_type = $request->type_select;
        $recipient->consent_date = $request->consent_date_input;
        $recipient->allow_status = $request->status_select;
        $recipient->firm_id = $firmId;

        $recipient->save();

        return Redirect::back()->with(['success' => 'Successfully saved']);
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
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'recipient_id' => 'required|integer',
            'status_select' => 'required|'.Rule::in(1,0),
            'consent_date_input' => 'required|date_format:Y-m-d H:i:s',
        ];

        $request->validate($rules);

        $recipient = Recipient::find($request->recipient_id);

        $recipient->allow_status = $request->status_select;
        $recipient->consent_date = $request->consent_date_input;

        $recipient->save();

        return Redirect::back()->with(['success' => 'Successfully saved']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($firmId,$id)
    {
        $recipient = Recipient::findOrFail($id);

        $recipient->delete();

        return Redirect::route('adminPage',[$firmId,'page=1'])->with(['success' => 'Successfully deleted Recipient '.$id]);
    }

    public function createRecipientPage(){
        return view('manage-firm/recipient.new');
    }
}
