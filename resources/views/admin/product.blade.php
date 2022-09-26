<!DOCTYPE html>
<html lang="en">
  <head>
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
                <h1 class="font_size">Add Product</h1>

                <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="div_design">
                        <label for="">Product title</label>
                        <input class="text_color" type="text" name="title" placeholder="write a product title" required="">
                    </div>
                    <div class="div_design">
                        <label for="">Product description</label>
                        <input class="text_color" type="text" name="description" placeholder="write a product description" required="">
                    </div>
                    <div class="div_design">
                        <label for="">Product price</label>
                        <input class="text_color" type="number" name="price" placeholder="write a product price" required="">
                    </div>
                    <div class="div_design">
                        <label for="">Discount price</label>
                        <input class="text_color" type="number" name="discount_price" placeholder="write a product titel">
                    </div>

                    <div class="div_design">
                        <label for="">Product quantity</label>
                        <input class="text_color" type="number" name="quantity" min="0" placeholder="write a product quantity" required="">
                    </div>
                    <div class="div_design">
                        <label for="">Product catagory</label>
                        <select class="text_color" name="catagory" id="" required="">
                            <option value="" selected="">Add a catagory</option>
                            @foreach($catagory as $catagory)
                               <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option> 
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="div_design">
                        <label for="">Product Image</label>
                        <input type="file" name="image" required="">
                    </div>
                    <div class="div_design">
                        <input type="submit" name="submit" value="Add product" class="btn btn-success">
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