<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .div_center{
            text-align: center;
            padding-top: 40px;
        }
        .font_size{
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color{
            color: black;
            padding-bottom: 20px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .div_design{
            padding-bottom: 15px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  {{session()->get('message')}}
                </div>
            @endif
            <div class="div_center">
                <h1 class="font_size">Update Product</h1>

                <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_design">
                        <label for="">Product title</label>
                        <input class="text_color" type="text" name="title" placeholder="write a product title" required="" value="{{$product->title}}">
                    </div>
                    <div class="div_design">
                        <label for="">Product description</label>
                        <input class="text_color" type="text" name="description" placeholder="write a product description" required="" value="{{$product->description}}">
                    </div>
                    <div class="div_design">
                        <label for="">Product price</label>
                        <input class="text_color" type="number" name="price" placeholder="write a product price" required="" value="{{$product->price}}">
                    </div>
                    <div class="div_design">
                        <label for="">Discount price</label>
                        <input class="text_color" type="number" name="discount_price" placeholder="write a product titel" value="{{$product->discount_price}}">
                    </div>

                    <div class="div_design">
                        <label for="">Product quantity</label>
                        <input class="text_color" type="number" name="quantity" min="0" placeholder="write a product quantity" required="" value="{{$product->quantity}}">
                    </div>
                    <div class="div_design">
                        <label for="">Product catagory</label>
                        <select class="text_color" name="catagory" id="" required="">
                            <option value="{{$product->catagory}}" selected="">{{$product->catagory}}</option>
                            @foreach($catagory as $catagory)
                               <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option> 
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="div_design">
                        <label for="">Current Product Image</label>
                        <img style="margin: auto;" src="/product/{{$product->image}}" alt="" width="50px">
                    </div>

                    <div class="div_design">
                        <label for="">Change Product Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="div_design">
                        <input type="submit" name="submit" value="Update product" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>