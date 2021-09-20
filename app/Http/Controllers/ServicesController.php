<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeService;
use Carbon\Carbon;

class ServicesController extends Controller
{
    public function HomeService(){
        $homeservice = HomeService::latest()->paginate(5);
        return view('admin.service.index', compact('homeservice'));
    }

    public function addService(){
        return view('admin.service.create');
    }

    public function StoreService(Request $request){
        HomeService::insert([
            'sub_title' =>  $request->sub_title,
            'sud_des' => $request->sud_des,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('home.service')->with('success', 'Service data inserted Successfully !');
    }

    public function EditService($id){
        $homeservice = HomeService::find($id);
        return view('admin.service.edit',compact('homeservice'));
    }

    public function updateService(Request $request, $id){
        $update = HomeService::find($id)->update([
            'sub_title' =>  $request->sub_title,
            'sud_des' => $request->sud_des,
        ]);
        return redirect()->route('home.service')->with('success', 'Service data Updated Successfully !');
    }

    public function deleteService($id){
        $delete = HomeService::find($id)->delete();
        return redirect()->back()->with('success', 'Service data deleted Successfully !');
    }
}
