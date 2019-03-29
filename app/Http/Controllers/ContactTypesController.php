<?php

namespace App\Http\Controllers;

use App\ContactType;
use App\Setting;
use Illuminate\Http\Request;

class ContactTypesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactTypes = ContactType::paginate(Setting::paginacao());
        return view('contact_types.index', ['contactTypes' => $contactTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact_types.form', ['contactType'=>new ContactType()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (ContactType::create($request->input())){
            return redirect(route('contact_types.index'));
        } else {
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \ContactType $contactType
     * @return \Illuminate\Http\Response
     */
    public function show(ContactType $contactType)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \ContactType $contactType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactType $contactType)
    {
        return view('contact_types.form',['contactType' => $contactType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \ContactType $contactType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactType $contactType)
    {
        if ($contactType->update($request->input())){
            return redirect(route('contact_types.index'));
        } else {
            return $this->edit($contactType);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \ContactType $contactType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactType $contactType)
    {
        $contactType->delete();
        return redirect(route('contact_types.index'));
    }
}
