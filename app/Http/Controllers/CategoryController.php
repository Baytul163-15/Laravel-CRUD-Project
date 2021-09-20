<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function AllCat(){

        //Query Builder relationship
        // $categories = DB::table('categories')
        //         ->join('users','categories.user_id','users.id')
        //         ->select('categories.*','users.name')
        //         ->latest()->paginate(5);

        //Eloquent ORM Data read
        $categories = Category::latest()->paginate(5);

        //For Add to Trash/SoftDelete
        $trachCat = Category::onlyTrashed()->latest()->paginate(3);
        

        //Query Builder Data Read
        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories','trachCat'));
    }

    public function AddCat(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please input category name',
            'category_name.max' => 'Category less then 255 chatracter   ',
        ]);

        //Eloquent ORM Insert Data
        Category::insert([
            'category_name'=>$request->category_name,
            'user_id'=> Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);

        //Eloquent ORM Data insert in another way
        // $category = new Category;
        // $category->category_name=$request->category_name;
        // $category->user_id=Auth::user()->id;
        // $category->save();

        //Insert Data With Query Builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category inserted Successfully !');
    }

    #Edit method for category_edit
    public function Edit($id){
        //Eloquent ORM
        //$categories = Category::find($id);

        //Query Builder
        $categories = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    #Update method for category_update
    public function update(Request $request, $id){
        //Eloquent ORM
        // $update = Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        //Query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        
        return redirect()->route('all.category')->with('success', 'Category updated Successfully !');
    }

    #Delete method for category_SoftDelete
    public function softdelete($id){
        #Eloquent ORM delete data
        $delete = Category::find($id)->delete();

        return redirect()->back()->with('message', 'Category SoftDeleted Successfully !');
    }

    #restore category data
    public function restore($id){
        $delete = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('message', 'Category Restore Successfully !');
    }

    #Category ForceDeleted/Parmanent deleted
    public function pdelete($id){
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('message', 'Category Parmanent Deleted Successfully !');
    } 
}
