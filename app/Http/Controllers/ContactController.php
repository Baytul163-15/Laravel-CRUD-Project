<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    // public function index(){
    //     return view('contact');
    // }

    public function AdminContact(){
        $contacts = Contact::latest()->paginate(5);
        return view('admin.contact.index', compact('contacts'));
    }

    public function AddContact(){
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request){
        Contact::insert([
            'address' => $request->address,
            'email' =>  $request->email,
            'call' => $request->call,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('admin.contact')->with('success', 'Contact data inserted Successfully !');
    }

    public function EditContact($id){
        $contactes = Contact::find($id);
        return view('admin.contact.edit',compact('contactes'));
    }

    public function UpdateContact(Request $request, $id){
        $update = Contact::find($id)->update([
            'address' => $request->address,
            'email' =>  $request->email,
            'call' => $request->call,
        ]);
        return redirect()->route('admin.contact')->with('success', 'Contact data Updated Successfully !');
    }

    public function DeleteContact($id){
        $delete = Contact::find($id)->delete();
        return redirect()->route('admin.contact')->with('success', 'Contact data Updated Successfully !');
    }

    public function ContactPage(){
        $contactse = Contact::first();
        return view('layouts.page.contact',compact('contactse'));
    }

    public function ContactForm(Request $request){
        ContactForm::insert([
            'name' => $request->name,
            'email' =>  $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('contact')->with('success', 'Contact message send Successfully !');
    }

    public function AdminMessage(){
        $messages = ContactForm::latest()->paginate(10);
        return view('admin.contact.message',compact('messages'));
    }

    public function DeleteMessage($id){
        $delete = ContactForm::find($id)->delete();
        return redirect()->route('admin.message')->with('success', 'Message deleted Successfully !');
    }
}
