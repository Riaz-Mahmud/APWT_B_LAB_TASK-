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

    
}
