<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HomeAbout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeabout = HomeAbout::latest()->paginate(5);
        return view('admin.home.index',compact('homeabout'));
    }

    public function AddAbout(){
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title' => $request->title,
            'short_des' =>  $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('home.about')->with('success', 'About data inserted Successfully !');
    }

    public function EditAbout($id){
        $homeabout = HomeAbout::find($id);
        return view('admin.home.edit',compact('homeabout'));
    }

    public function updateAbout(Request $request, $id){
        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_des' =>  $request->short_des,
            'long_des' => $request->long_des
        ]);
        return redirect()->route('home.about')->with('success', 'About data Updated Successfully !');
    }

    public function deleteAbout($id){
        $delete = HomeAbout::find($id)->delete();
        return redirect()->back()->with('success', 'About data deleted Successfully !');
    }
}
