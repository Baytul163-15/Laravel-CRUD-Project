<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success', 'User Logout Successfully');
    }

    public function HomeSlider(){
        $sliders = Slider::latest()->paginate(5);
        //$sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));
    }

    public function AddSlider(){
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){

        #Upload Image
        $slider_image = $request->file('image'); 

        #Image intervention
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1928,1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' =>  $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('home.slider')->with('success', 'Slider inserted Successfully !');
    }

    public function deleteSlider($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return redirect()->back()->with('success', 'Slider Deleted Successfully !');
    }

    public function EditSlider($id){
        $sliders = Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));
    }  

    public function updateSlider(Request $request, $id){

        $old_image = $request->old_image;

        $slider_img = $request->file('image');

        if ($slider_img) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($slider_img->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/slider/';
            $last_img = $up_location.$img_name;
            $slider_img->move($up_location,$img_name);
            unlink($old_image);

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success', 'Slider Updated Successfully !');
        }else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
            return redirect()->route('home.slider')->with('success', 'Slider Updated Successfully !');
        }
    }
}
