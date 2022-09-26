<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .center{
            margin: auto;
            /* text-align: center; */
            width: 100%;
            /* align-items: center; */
            justify-content: space-between;
            margin-top: 40px;
        }
        .All_product{
            color: red;
            padding-top: 20px;
        }
        .tr_color{
            color: rgb(11, 11, 99);
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
                @if(session()->has('messag'))
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  {{session()->get('messag')}}
                </div>
                @endif

                <h2 class="All_product">All product</h2>
                <table class="center table table-stripped text-info">
                    <thead class="">
                    <tr >
                        <th>Product title</th>
                        <th>Product description</th>
                        <th>Quantity</th>
                        <th>Catagory</th>
                        <th>Price</th>
                        <th>Discount price</th>
                        <th>Product image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $product)
                        
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->catagory}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td>
                            <img src="/product/{{$product->image}}" alt="">
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete this')" class="btn btn-danger" href="{{url('delete_product',$product->id)}}">Delete</a>
                        </td>
                        <td>
                            <a href="{{url('update_product',$product->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>