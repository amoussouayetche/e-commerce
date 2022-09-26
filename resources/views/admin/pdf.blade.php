<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
</head>
<body style="display: flex">
    <h1 >Order Details</h1>
    <div style="">
        <div>
            Username:
            <h3>{{$order->name}}</h3>
            User Email:
            <h3>{{$order->email}}</h3>
            User Address:
            <h3>{{$order->address}}</h3>
            User Phone:
            <h3>{{$order->phone}}</h3>
            User Id:
            <h3>{{$order->user_id}}</h3>
            Product Title:
            <h3>{{$order->product_title}}</h3>
            Product Price:
            <h3>{{$order->price}}</h3>
            Product Quantity:
            <h3>{{$order->quantity}}</h3>
            Payement status:
            <h3>{{$order->payement_status}}</h3>
            Product Id:
            <h3>{{$order->product_id}}</h3>
        </div>
        <img src="product/{{$order->image}}" alt="" width="50%">
    </div>
</body>
</html>