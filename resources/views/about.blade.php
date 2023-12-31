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
    <title>Gifts Shop</title>
</head>
<body class="welcome text-black">
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
        <div class="about-cover">ABOUT US</div>
            <div class="welcome-product-card mt-5 mb-2 p-4 d-flex justify-content-center flex-column align-items-center">
            <div class="col col-12 d-flex px-5 my-5">
                <img src="{{asset('/imgs/office-1.jpg')}}" style="border-radius: 0.3rem; width:28rem !important; z-index:360;" alt="">
                <div class="d-flex flex-column justify-content-center px-5">
                <h1 style="color:#E32C92">Our Store</h1>
                <p class="my-1 mt-5">Welcome to our Gifts Store, your ultimate destination for unique and memorable gifts. At our Gifts Store, we believe that giving and receiving gifts should be a joyous experience that leaves a lasting impression. We are passionate about curating a diverse collection of products that celebrate special moments, express love and appreciation, and bring smiles to faces. With years of experience in the gifting industry, we understand the importance of finding the perfect gift for every occasion. </p>
                </div>
            </div>
            <div class="col col-12 d-flex px-5 my-5">
                <div class="d-flex flex-column justify-content-center px-5">
                <h1 style="color:#E32C92;">User Friendly Environment</h1>
                    <p class="my-1 mt-5">Our user-friendly website is designed to make browsing and purchasing effortless, and our dedicated customer support team is always ready to assist you with any questions or concerns you may have. We prioritize secure and reliable payment options, ensuring that your transactions are safe and smooth. We believe in the power of gift-giving to create cherished memories and strengthen relationships.</p>
                    <p class="my-1"> That's why we go above and beyond to ensure that each item is carefully packaged and delivered with love and care. We take pride in our prompt and reliable shipping services, ensuring that your gifts arrive on time, ready to create moments of joy and celebration. Thank you for choosing our Store as your go-to destination for gifts that make a difference.</p>
                </div>
                <img src="{{asset('/imgs/office-2.jpg')}}" style="border-radius: 0.3rem; width:28rem !important; z-index:360;" alt="">
            </div>
            </div>
        @component('components.footer')    
        @endcomponent
    </div>
</body>
</html>