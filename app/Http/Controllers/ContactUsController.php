<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return view('admin.contactus.index', compact('contacts'));
    }

    public function view($id)
    {
        $contact = $this->findModel($id);
        return view('admin.contactus.view', compact('contact'));
    }

    public function delete($id)
    {
        $contact = $this->findModel($id);
        $contact->status = -1;
        $contact->save();
        return redirect()->route('contactus.index')->with('danger', 'Contact deleted successfully');;
    }

    public function findModel($id)
    {
        $contact = Contact::find($id);

        if ($contact) {
            return $contact;
        }

        abort(404, 'Contact not found');
    }
}
