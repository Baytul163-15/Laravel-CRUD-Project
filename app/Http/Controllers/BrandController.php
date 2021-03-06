<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function AllBrand(){
        //Eloquent ORM Data. at the time all data are store in $brands veriable.  
        $brands = Brand::latest()->paginate(10);
        return view("admin.brand.index", compact('brands'));
    }

    public function AddBrand(Request $request){
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|unique:brands|min:4',
        //     'brand_image' => 'required|mimes:jpg.jpeg,png',
        // ],
        // [
        //     'brand_name.required' => 'Please input brand name',
        //     //'brand_name.min' => 'Brand name longer then 4 chatracter',
        //     //'brand_image.min' => 'Brand name longer then 4 chatracter',
        // ]);

        #Upload Image
        $brand_image = $request->file('brand_image'); 

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        #Image intervention
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

     #Edit method for brand_edit
     public function Edit($id){
        //Eloquent ORM
        $brands = Brand::find($id);

        //Query Builder
        //$categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.brand.edit', compact('brands'));
    }

    public function updateBrand(Request $request, $id){
        // $validatedData = $request->validate([
        //     'brand_name' => 'required|min:4',
        // ],
        // [
        //     'brand_name.required' => 'Please input brand name',
        //     //'brand_name.min' => 'Brand name longer then 4 chatracter',
        //     //'brand_image.min' => 'Brand name longer then 4 chatracter',
        // ]);

        $old_image = $request->old_image;

        #Upload Image
        $brand_image = $request->file('brand_image'); 

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$img_name;
            $brand_image->move($up_location,$img_name);

            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand Updated Successfully !',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand Updated Successfully !',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }     
    }

    public function deleteBrand($id){
        $iamge = Brand::find($id);
        $old_image = $iamge->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand Deleted Successfully !');
    }
}
