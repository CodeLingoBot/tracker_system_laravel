<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactType;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = User::find(\Input::get('user_id'));
        $this->middleware('auth');
        $this->middleware('role:admin|subadmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where(['user_id' => $this->user->id])->paginate(Setting::paginacao());
        return view('contacts.index', ['user' => $this->user, 'contacts' => $contacts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Contact::create($request->input())) {
            return redirect(route('contacts.index') . "?user_id=" . $this->user->id);
        } else {
            return $this->create();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ContactType::all();
        return view('contacts.form', ['user' => $this->user, 'contact' => new Contact(), 'types' => $types]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if ($contact->update($request->input())) {
            return redirect(route('contacts.index') . "?user_id=" . $this->user->id);
        } else {
            return $this->edit($contact);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $types = ContactType::all();
        return view('contacts.form', ['user' => $this->user, 'contact' => $contact, 'types' => $types]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect(route('contacts.index') . "?user_id=" . $this->user->id);
    }
}
