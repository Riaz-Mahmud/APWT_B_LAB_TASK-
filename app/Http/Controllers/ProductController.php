<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Http\Requests;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->session()->get('username');

        $existing = DB::table('products')->where('username', $username)
        ->where('status', "existing")->get();
        $upcoming =DB::table('products')->where('username', $username)
        ->where('status', "upcoming")->get();

        return view('ProductMangement.Home')
        ->with('title', 'Product Management')
        ->with('existing', count($existing))
        ->with('upcoming', count($upcoming));
    }

    public function ExistingProduct(Request $request)
    {
        $username = $request->session()->get('username');

        $existing = DB::table('products')->where('username', $username)
        ->where('status', "existing")->paginate(20);

        return view('ProductMangement.ExistingProduct')
        ->with('title', 'Existing Product')
        ->with('existing', $existing);
    }
    
    public function ProductDetails($id)
    {
        $pDetails = DB::table('products')->where('id', $id)->first();
        return view('ProductMangement.ProductDetails')
        ->with('title', 'Product Details')
        ->with('pDetails', $pDetails);
    }

    public function ProductDelete($id)
    {

        $data= DB::table('products')
        ->where('id',$id)
        ->delete();
        if($data){
            return redirect()->back()->with([
                'error' => false,
                'message' => 'Delete Success'
            ]);
        }else{
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Something wrong'
            ]);
        }
    }

    public function ProductEdit($id)
    {

        $pDetails = DB::table('products')->where('id', $id)->first();
        return view('ProductMangement.EditProduct')
        ->with('title', 'Edit Product')
        ->with('pDetails', $pDetails);
    }

    public function ProductUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'product_name' => 'required',
            'category' => 'required',
            'unit_price' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => 'Required data missing.'
            ]);
        } else {
            $id = $request->input('id');
            $product_name = $request->input('product_name');
            $category = $request->input('category');
            $unit_price = $request->input('unit_price');
            $status = $request->input('status');

            $update = DB::update("UPDATE products SET product_name= '$product_name',price= '$unit_price',category= '$category',status= '$status' WHERE id = '$id';");

            if($update)
            {
                return redirect()->back()->with([
                    'error' => false,
                    'message' => 'Edit Success'
                ]);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => 'Somethis going wrong'
                ]);
            }

        }
    }

    //upcoming product
    public function UpcomingProduct(Request $request)
    {
        $username = $request->session()->get('username');

        $upcoming = DB::table('products')->where('username', $username)
        ->where('status', "upcoming")->paginate(20);

        return view('ProductMangement.UpcomingProduct')
        ->with('title', 'Upcoming Product')
        ->with('upcoming', $upcoming);
    }

    public function addIndex(Request $request)
    {
        $vendor = DB::table('vendor')->get();

        return view('ProductMangement.AddProduct')
        ->with('title', 'Add Product')
        ->with('vendor', $vendor);
    }

    public function AddProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'category' => 'required',
            'unit_price' => 'required',
            'status' => 'required',
            'vendor' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Required data missing.'
            ]);
        }else{
            $vendorId=$request->input('vendor');
            $username = $request->session()->get('username');

            $vendorInfo=DB::table('vendor')
            ->where('id',$vendorId)
            ->first();

            $product_name=$request->input('product_name');
            $category=$request->input('category');
            $unit_price=$request->input('unit_price');
            $status=$request->input('status');


            $data=array();
            $data['product_name']=$product_name;
            $data['price']=$unit_price;
            $data['category']=$category;
            $data['status']=$status;
            $data['username']=$username;
            $data['vendorId']=$vendorId;
            $data['vendorName']=$vendorInfo->name;

            $insert= DB::table('products')->insert($data);

            if($insert){
                return redirect()->back()->with([
                    'error' => false,
                    'message' => 'Insert New Product SuccessFully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'Something going wrong'
                ]);
            }
        }
    }
}
