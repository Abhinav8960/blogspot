<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        // $contacts = Contact::orderBy('id', 'desc')->paginate(10);

        $query = Contact::query();

        if ($request->filled('search')) {
            $query
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $contacts = $query
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

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
