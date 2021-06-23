<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use App\Http\Requests;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->session()->get('username');

        $todayDate = Carbon::now()->subDays(1);
        $todayPhysicalSale = DB::table('physical_store_channel')->where('username', $username)
            ->where('created_at', '>=', $todayDate)->get();
        $todaySocialSale = DB::table('social_media_channel')->where('username', $username)
            ->where('created_at', '>=', $todayDate)->get();
        $todayEcomSale = DB::table('ecommerce_channe')->where('username', $username)
            ->where('created_at', '>=', $todayDate)->get();

        $date = Carbon::now()->subDays(7);
        $thisWeekPhysicalSale = DB::table('physical_store_channel')->where('username', $username)
        ->where('created_at', '>=', $date)->get();
        $thisWeekSocialSale = DB::table('social_media_channel')->where('username', $username)
        ->where('created_at', '>=', $date)->get();
        $thisWeekEcomSale = DB::table('ecommerce_channe')->where('username', $username)
        ->where('created_at', '>=', $date)->get();


        return view('Sales.Home')
        ->with('title', 'Sales Home')
        ->with('todayPhysicalSale', count($todayPhysicalSale))
        ->with('todaySocialSale', count($todaySocialSale))
        ->with('todayEcomSale', count($todayEcomSale))
        ->with('thisWeekPhysicalSale', count($thisWeekPhysicalSale))
        ->with('thisWeekSocialSale', count($thisWeekSocialSale))
        ->with('thisWeekEcomSale', count($thisWeekEcomSale));
    }

    public function PhysicalStore(Request $request)
    {
        $username = $request->session()->get('username');
        $todayDate = Carbon::now()->subDays(1);

        $todayPhysicalSale = DB::table('physical_store_channel')->where('username', $username)
        ->where('created_at', '>=', $todayDate)->get();
        $date = Carbon::now()->subDays(7);
        $thisWeekPhysicalSale = DB::table('physical_store_channel')
        ->where('username', $username)
        ->where('created_at', '>=', $date)->get();
        
        // $mostSellProduct= DB::select(DB::raw('COUNT(id) as cnt', 'product_id'))->groupBy('product_id')->orderBy('id', 'DESC')->first();
        
        $lastMonth = Carbon::now()->subDays(30);
        $avg_sellAmount = DB::table('physical_store_channel')
        ->where('username', $username)
        ->where('created_at', '>=', $lastMonth)
        ->avg('total_price');
        
        return view('Sales.PhysicalStore')
        ->with('title', 'Physical Store')
        ->with('todayPhysicalSale', count($todayPhysicalSale))
        ->with('avg_sellAmount', $avg_sellAmount)
        ->with('thisWeekPhysicalSale', count($thisWeekPhysicalSale));
    }

    public function SellProduct(Request $request)
    {
        $productAll=DB::table('products')->get();

        return view('Sales.SellProduct')
        ->with('title', 'Sell Product')
        ->with('productAll', $productAll);
    }

    public function createSellProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3' ,'max:30'],
            'address' => ['required', 'min:3' ,'max:50'],
            'phone' => ['required', 'min:11' ,'max:15'],
            'product' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
            'payment_type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with([
                'error' => true,
                'message' => 'Required data missing.'
            ]);
        }else{
            $productId=$request->input('product');

            $productData=DB::table('products')
            ->where('id',$productId)
            ->first();

            $full_name=$request->input('name');
            $address=$request->input('address');
            $phone=$request->input('phone');
            $unit_price=$request->input('unit_price');
            $quantity=$request->input('quantity');
            $country=$request->input('country');
            $totalPrice=$request->input('total_price');
            $payment_type=$request->input('payment_type');

            $todayDate = date('Y-m-d');

            $data=array();
            $data['customer_name']=$full_name;
            $data['address']=$address;
            $data['phone']=$phone;
            $data['product_id']=$productId;
            $data['product_name']=$productData->product_name;
            $data['unit_price']=$unit_price;
            $data['quantity']=$quantity;
            $data['total_price']=$totalPrice;
            $data['date_sold']=$todayDate;
            $data['payment_type']=$payment_type;
            $data['status']='sold';
            $data['username']=$request->session()->get('username');

            $insert_data = DB::table('physical_store_channel')->insert($data);
            if($insert_data){
                return redirect()->back()->with([
                    'error' => false,
                    'message' => 'Sell SuccessFully'
                ]);
            }else{
                return redirect()->back()->with([
                    'error' => true,
                    'message' => 'Something going wrong'
                ]);
            }
        }
    }

    public function sellLog(Request $request)
    {
        $lastMonth = Carbon::now()->subDays(30);
        $soldSell=DB::table('physical_store_channel')->where('created_at', '>=', $lastMonth)
        ->where('status','sold')->get();
        $pendingSell=DB::table('physical_store_channel')->where('created_at', '>=', $lastMonth)
        ->where('status','pending')->get();

        return view('Sales.SellLog')
        ->with('title', 'Sell Log')
        ->with('soldSell', $soldSell)
        ->with('pendingSell', $pendingSell);
    }

    public function productDetails(Request $request)
    {
        $id = $request->id;
        $productData=DB::table('products')
            ->where('id',$id)
            ->first();

        if($productData){
            return response()->json([
                'price' => $productData->price
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Something went wrong.'
            ]);
        }
    }
}
