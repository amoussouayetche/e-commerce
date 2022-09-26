<?php

namespace App\Http\Controllers;

use Session;
use Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $product=Product::paginate(10);
        return view('home.userpage',compact('product'));
    }

    public function redirect(){
        $usertype=Auth::user()->usertype;
        if($usertype=='1'){
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            $order=order::all();
            $total_revenue=0;
            foreach($order as $order){
                $total_revenue+=$order->price;
            }
            $Order_delivered=order::where('delivery_status','=','delivered')->get()->count();
            $Order_processing=order::where('delivery_status','=','processing')->get()->count();
            // $paid1=order::where('payement_status','=','Paid')->get()->count();
            // $paid=0;
            // foreach($order as $order){
            //     $paid+=$paid1;
            // }
            // $unpaid1=order::where('payement_status','!=','Paid')->get();

            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','Order_delivered','Order_processing','paid','unpaid'));
        }
        else{
            $product=Product::paginate(10);
            return view('home.userpage',compact('product'));
        }
    }
    public function product_details($id){
        $product=product::find($id);
        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request,$id){
        if(Auth::id()){
            $user=Auth::user();
            $product=Product::find($id);
            //dd($product);
            $cart=new Cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;
            $cart->product_title=$product->title;
            if($product->discount_price!=null){
                $cart->price=$product->discount_price * $request->quantity;
            }else{
                $cart->price=$product->price * $request->quantity;
            }
            
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->quantity=$request->quantity;

            $cart->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login'); 
        }
    }
    public function show_cart(){
        if(Auth::id()){

            $id=Auth::user()->id;
            $cart=Cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart'));
        }else{
            return redirect('login');
        }
    }
    public function remove_cart($id){
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order(){
        $user=Auth::user();
        $userid=$user->id;
        $data=Cart::where('user_id','=',$userid)->get();
        foreach($data as $data){
            $order= new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->address=$data->address;
            $order->phone=$data->phone;
            $order->user_id=$data->user_id;

            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->product_id=$data->product_id;
            $order->image=$data->image;
            
            $order->payement_status='cash on delevery';
            $order->delivery_status='processing';

            $order->save();

            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','Vous allez recevoir votre commande bientot, nous allons prendre contact avec vous');
    }
    public function stripe($totalprice){

        return view('home.stripe',compact('totalprice'));
    }
    
    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Merci pour votre payement" 
        ]);


        $user=Auth::user();
        $userid=$user->id;
        $data=Cart::where('user_id','=',$userid)->get();
        foreach($data as $data){
            $order= new Order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->address=$data->address;
            $order->phone=$data->phone;
            $order->user_id=$data->user_id;

            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->product_id=$data->product_id;
            $order->image=$data->image;
            
            $order->payement_status='Paid';
            $order->delivery_status='Processing...';

            $order->save();

            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    
}
