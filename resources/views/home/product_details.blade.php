<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')

         <div class="container p-5">
            {{-- <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{url('product_details',$product->id)}}" class="option1">
                     Product details
                     </a>
                     <a href="" class="option2">
                     Buy Now
                     </a>
                  </div>
               </div> --}}
            <div class="row justify-content-center">
               <div class="col-md-4">
                  <div class="img-box">
                     <img src="/product/{{$product->image}}" alt="" width="70%">
                  </div>
               </div>
               <div class="col-md-4">

                  <div>
                     <h6 style="margin-bottom: 1rem">
                        <span style="font-weight: bold;">Title</span>
                        <br>
                        {{$product->title}}
                     </h6>
                     @if($product->discount_price!=null)
                     
                     <h6 style="margin-bottom: 1rem" >
                        <span style="font-weight: bold;">Discount Price</span>
                        <br>
                        <span style="color: red;">${{$product->discount_price}}</span>
                     </h6>
   
                     <h6 style="margin-bottom: 1rem">
                        <span style="font-weight: bold;">Price</span>
                        <br>
                        <span style="text-decoration: line-through;color:blue;">${{$product->price}}</span>
                     </h6>
                     @else
                     <h6 style="margin-bottom: 1rem">
                        <span style="font-weight: bold;">Price</span>
                        <br>
                        <span style="color: blue;">${{$product->price}}</span>
                     </h6>
                     @endif
                     <h6 style="margin-bottom: 1rem">
                        <span style="font-weight: bold;">Catagory</span>
                        <br>
                        <span>{{$product->catagory}}</span>
                     </h6>
                     <h6 style="margin-bottom: 1rem">
                        <span style="font-weight: bold;">Description</span>
                        <br>
                        {{$product->description}}
                     </h6>
                     <h6 style="margin-bottom: 1rem">
                        <span style="font-weight: bold;">Quantity</span>
                        <br>
                        <span>{{$product->quantity}}</span>
                     </h6>
   
                     <form action="{{url('add_cart',$product->id)}}" method="POST">
                        @csrf
                        <div class="row text-center">
                           <div class="col-md-6">
                              <input type="number" name="quantity" value="1" min="1">
                           </div>
                           <div class="col-md-3">
                              <input type="submit" value="Add to cart">
                           </div>
                        </div>
                        
                        
                     </form>
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
      
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>