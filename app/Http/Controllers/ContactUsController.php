<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function contactMessages()
    {
        return view('contactus.contactus', [
            'contactmessages' => ContactUs::orderBy('id')
                ->filter(request(['search']))
                ->get(),
        ]);
    }

    // public function contactMessagesDestroy(ContactUs $contactus){
    //     $contactus->delete();
    //     return back()->with('success', 'Contact Message Deleted Successfully');
    // }

    public function contactMessagesDestroy($id)
    {
        $contactMessage = ContactUs::findOrFail($id);
        $contactMessage->delete();
        return back()->with('success', 'Contact Message Deleted Successfully');
    }
}
