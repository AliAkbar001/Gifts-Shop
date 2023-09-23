<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('app.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Custom Gift | Gifts Shop</title>
</head>
<body class="shop text-black">
    <div>
    <div class="header d-flex justify-content-between align-items-center" style="height: 70px;">
            <div>
                <a href="/user/{{$email}}"><img src="{{asset('/imgs/GIFTLAB-Logo.png')}}" alt="" style="width:120px"></a>
            </div>
            <div class="d-flex justify-content-around align-items-center">
                <a href="/about/{{$email}}" class="mx-3">About Us</a>
                <a href="/shop/{{$email}}" class="mx-3">Gifts</a>
                <a href="/custom/{{$email}}" class="mx-3">Custom Gifts</a>
                <a href="/cart/{{$email}}" class="mx-3">Cart</a>
                @if ($status==1)
                    <a href="/logout/{{$email}}" class="mx-3">Logout</a>
                @else
                    <a href="/login" class="mx-3">Login</a>
                @endif
            </div>
        </div>
        <div class="about-cover">Customize Your Gift</div>
        <div style="display:flex; justify-content: space-between">
         <div class="product-card">
		<div class="badge">Hot</div>
		<div class="product-tumb">
			<img src="{{asset('/imgs/customcup.webp')}}" alt="">
		</div>
		<div class="product-details">
			<span class="product-catagory">Cups</span>
			<h4><a href="/{{$email}}/custom/cup">Custom Cups</a></h4>
			<p>Custom Bistro Style Large Coffee Mugs 16 oz. Set of 10, Personalized Bulk Pack - Perfect for Coffee, Tea, Espresso, Hot Cocoa, Other Beverages - Orange</p>
			<div class="product-bottom-details">
				<div class="product-price"><small>$25.00</small>$20.00</div>
				<div class="product-links">
					<a href=""><i class="fa fa-heart"></i></a>
					<a href=""><i class="fa fa-shopping-cart"></i></a>
				</div>
			</div>
		</div>
	</div>

    <div class="product-card">
		<div class="badge">Hot</div>
		<div class="product-tumb">
			<img src="{{asset('/imgs/customdiary.jpg')}}" alt="">
		</div>
		<div class="product-details">
			<span class="product-catagory">Diary</span>
			<h4><a href="/{{$email}}/custom/diary">Custom Diary</a></h4>
			<p>LEATHER VILLAGE Tree of Life Journal – 8 X 6 (A5) inches – 200 Antique Deckle Edge Handmade Paper – Book of Shadows – Vintage Black Color - Vintage Leather Bound Journal for Women & Men</p>
			<div class="product-bottom-details">
				<div class="product-price"><small>$50.00</small>$40.00</div>
				<div class="product-links">
					<a href=""><i class="fa fa-heart"></i></a>
					<a href=""><i class="fa fa-shopping-cart"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
        @component('components.footer')
        @endcomponent
    </div>
</body>
</html>