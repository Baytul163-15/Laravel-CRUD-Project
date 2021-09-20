<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class multipicController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    #Multipic Page controller received method from web.php
    public function multipic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    } 

    public function StoreImage(Request $request){

        #Upload Image
        $image = $request->file('image'); 

        foreach ($image as $multi_img) {
            #image intervention
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300,300)->save('image/multipic/'.$name_gen);
            $last_img = 'image/multipic/'.$name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->back()->with('success', 'MultiImage inserted Successfully !');  
    }

}
