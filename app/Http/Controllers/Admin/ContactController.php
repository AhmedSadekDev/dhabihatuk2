<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
        ]);

        $contact = Contact::find($request->contact_id);
        $contact->delete();
        return back()->with('message', 'تم حذف الرساله بنجاح');
    }
}
