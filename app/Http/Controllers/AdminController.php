<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use PDF;
use Notification;

class AdminController extends Controller
{
    public function view_catagory(){
        $data=catagory::all();
        return view('admin.catagory',compact('data'));
    }
    public function add_catagory(Request $request){
        $data=new catagory;

        $data->catagory_name=$request->catagory;

        $data->save();
        return redirect()->back()->with('message','catagory added succesfully');
    }
    public function delete_catagory($id){
        $data=catagory::find($id);
        $data->delete();
        return redirect()->back()->with('messag','catagory delete succesfully');
    }
    public function view_product(){
        $catagory=catagory::all();

        return view('admin.product',compact('catagory'));
    }
    public function add_product(Request $request){
        $product=new Product;

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->catagory=$request->catagory;
        //image
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;
        // $product->image=$request->image;
        $product->save();
        return redirect()->back()->with('message','product added succesfully');
    }
    public function show_product(){
        $product=Product::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id){
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('messag','catagory delete succesfully');
    }
    public function update_product($id){
        $product=product::find($id);
        $catagory=catagory::all();
        // $product->update();
        return view('admin.update_product',compact('product','catagory'));
    }
    public function update_product_confirm(Request $request,$id){
        $product=product::find($id);

        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->catagory=$request->catagory;
        //image
        $image=$request->image;
        if($image){

            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
        // $product->image=$request->image;
        $product->save();
        return redirect()->back()->with('message','product update succesfully');
    }
    public function order(){
        $order=Order::all();
        return view('admin.order',compact('order'));
    }
    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status="Delivered";
        $order->payement_status="Paid";
        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id){
        $order=order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }
    public function send_email($id){
        $order=order::find($id);
        return view('admin.email_info',compact('order'));
    }
    public function send_user_email(Request $request, $id){
        $order=order::find($id);

        $details=[
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,
        ];
        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back();
    }
    public function searchdata(Request $request){
        $searchText=$request->search;
        $order=order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
        return view('admin.order',compact('order'));
    }
}
