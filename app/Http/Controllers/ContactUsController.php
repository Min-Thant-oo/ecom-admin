<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contactus.index', [
            'contactmessages' => ContactUs::latest()
                ->filter(request(['search']))
                // ->get(),
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function destroy(ContactUs $contactmessage)
    {
        $contactmessage->delete();
        return back()->with('success', 'Contact Message Deleted Successfully');
    }
}
