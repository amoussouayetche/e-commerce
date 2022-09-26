<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper bg-white text-black">
                <h1 style="padding-bottom: 20px">All order</h1>
                <table class="center table table-stripped">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Phone</th>
                          <th>Product title</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Payement status</th>
                          <th>Delivery status</th>
                          <th>Image</th>
                      </tr>
                  </thead>
                  <tbody>
                    @forelse($order as $order)
                      
                    <tr>
                        <th>{{$order->name}}</th>
                        <th>
                          {{$order->email}} <br>
                          <a href="{{url('send_email',$order->id)}}" class="btn btn-danger">Send Email</a>
                        </th>
                        <th>{{$order->address}}</th>
                        <th>{{$order->phone}}</th>
                        <th>{{$order->product_title}}</th>
                        <th>{{$order->quantity}}</th>
                        <th>{{$order->price}}</th>
                        <th style="text-align: center;">
                          {{$order->payement_status}} <br>
                          <a href="{{url('print_pdf',$order->id)}}" class="btn btn-info">Print PDF</a>
                        </th>
                        <th style="text-align: center;">
                          {{$order->delivery_status}} <br>
                          @if($order->delivery_status=="processing")
                            
                          <a href="{{url('delivered',$order->id)}}" onclick="return confirm('are you sur this product is delivered?')" class="btn btn-primary mt-1">Delivered</a>
                          @endif
                        </th>
                        <th><img src="/product/{{$order->image}}" alt=""></th>
                    </tr>
                    @empty
                    <tr>
                      <td >
                          Not Found
                      </td>
                    </tr>
                    
                    @endforelse
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