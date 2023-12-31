<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Exception; 
use Intervention\Image\Facades\Image;

class DataBase extends Controller
{

    public $status=0;
    function registration(Request $req){
        try {
            $newUser = new User;
            $newUser->name = $req->name;
            $newUser->email = $req->email;
            $newUser->password = $req->password;
            $newUser->status=0;
            $newUser->save();
            

            Schema::create($req->name.'_orders', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('price');
                $table->integer('qty');
                $table->string('image1');
            });

            return redirect()->back()->with('success', "You are successfully Registered");

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function login(Request $req){
        try {
            $req->validate([
                'email'=> 'required',
                'password'=>'required'  
              ]);
              $check=0;
              $email = $req->email;
              $password = $req->password;
              if ($email=="admin@admin.com" && $password = "admin@123") {
                  return redirect('/admin');
              } else {
                  $data = DB::table('users')->where('email', $email)->where('password', $password)->get();
                  DB::update("UPDATE `users` SET `status`= 1 WHERE `email` = '".$req->email."'");
                  $check = count($data);
                  if($check!=0){
                      return redirect('/user/'.$email);
                  }
                  else{
                      return redirect()->back()->with('error', 'Sorry, your email or password was incorrect. Please double-check your credentials.');
                  }   
              }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function addnewproduct(Request $req){
        try {
            if($req->hasFile('image')){
                $image = $req->file('image');
                $image_name = $image->getClientOriginalName();
                $image->move(public_path('/imgs/flowers'),$image_name);
                $flowerpicture = "imgs/flowers/".$image_name;
            }
            DB::insert("INSERT INTO `products`(`id`, `name`, `description`, `price`, `qty`, `image1`, `image2`) VALUES (NULL,'".$req->name."','".$req->description."','".$req->price."','".$req->quantity."','".$flowerpicture."','".$flowerpicture."')");
            return redirect()->back()->with('success', "Product is successfully added");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    function checkStatus($email){
        $data = DB::select("select * from `users` where `email` = '".$email."'");
        foreach($data as $user){
            $this->status=$user->status;
        }
    }

    function carousel($email){
        $this->checkStatus($email);
        $sliders = Product::all();
        return view('welcome')->with('sliders', $sliders)->with('email', $email)->with('status', $this->status);
    }

    function about($email){
        $this->checkStatus($email);
        return view('about')->with('email', $email)->with('status', $this->status);
    }

    function custom($email){
        $this->checkStatus($email);
        return view('customgifts')->with('email', $email)->with('status', $this->status);
    }

    function customcup($email){
        $this->checkStatus($email);
        return view('customcup')->with('email', $email)->with('status', $this->status);
    }

    function customdiary($email){
        $this->checkStatus($email);
        return view('customdiary')->with('email', $email)->with('status', $this->status);
    }

    function customizecup(Request $request, $email, $imagename, $cupname){
        $this->checkStatus($email);
        $selectedCupImage = $imagename;
        $inputText = $request->input('input_text');
        $cupImagePath = 'imgs/' . $selectedCupImage;

        $cupImage = Image::make($cupImagePath);

        $imageWidth = $cupImage->width();
        $imageHeight = $cupImage->height();
        $textWidth = strlen($inputText) * 10; 
        $textHeight = 24; 

        $x = ($imageWidth - $textWidth) / 2 - $textWidth ;
        $y = ($imageHeight - $textHeight) / 2 + $textHeight;

        $cupImage->text($inputText, $x, $y, function($font) {
            $font->file('C:\Windows\Fonts\Arial.ttf');
            $font->size(30);
            $font->color('#ffffff');
        });

        $customizedCupImagePath = 'imgs/' . $inputText.'png';
        $cupImage->save($customizedCupImagePath);

        return view('customcupview')->with('email', $email)->with('status', $this->status)->with('customizedCupImage', $customizedCupImagePath)->with('imagename', $imagename)->with('cupname', $cupname);
    }

    function customizediary(Request $request, $email, $imagename, $diaryname){
        $this->checkStatus($email);
        $selectedDiaryImage = $imagename;
        $inputText = $request->input('input_text');
        $diaryImagePath = 'imgs/' . $selectedDiaryImage;

        $diaryImage = Image::make($diaryImagePath);

        $imageWidth = $diaryImage->width();
        $imageHeight = $diaryImage->height();
        $textWidth = strlen($inputText) * 10; 
        $textHeight = 24; 

        $x = ($imageWidth - $textWidth) / 2 -10 ;
        $y = ($imageHeight - $textHeight) / 2 + $textHeight;

        $diaryImage->text($inputText, $x, $y, function($font) {
            $font->file('C:\Windows\Fonts\Arial.ttf');
            $font->size(30);
            $font->color('#ffffff');
        });

        $customizedDiaryImagePath = 'imgs/' . $inputText.'png';
        $diaryImage->save($customizedDiaryImagePath);

        return view('customdiaryview')->with('email', $email)->with('status', $this->status)->with('customizedDiaryImage', $customizedDiaryImagePath)->with('imagename', $imagename)->with('diaryname', $diaryname);
    }

    function showproduct($email, $flowername){
        $this->checkStatus($email);
        $sliders = DB::select("select * from `products` where `name` = '".$flowername."'");
        // dd($sliders);
        $secondslide = Product::all();
        return view('product')->with('sliders', $sliders)->with('second', $secondslide)->with('email', $email)->with('status', $this->status);
    }
    
    function showshop($email){
        $this->checkStatus($email);
        $data = Product::all();
        return view('shop')->with('collection', $data)->with('email', $email)->with('status', $this->status);
    }
    function logout($email){
        // echo file_get_contents('imgs/flowers/reading.jpg');
        DB::update("UPDATE `users` SET `status`= 0 WHERE `email` = '".$email."'");
        return redirect('/');
    }

    function addtocart(Request $req, $email, $name, $price, $image){
        $check=0;
        $qty=0;
        $quantity=0;
        $user = DB::select("select * from `users` where `email` = '".$email."'");
        foreach($user as $item){
            $username=$item->name;
        }
        $products = DB::select("select * from `products` where `name` = '".$name."'");
        foreach($products as $product){
            $quantity = $product->qty;
        }
        if($quantity==0){
            return redirect()->back()->with('empty', 'Flowers Out Of Stock');
        }
        else{
            $checkProduct = DB::select("select * from `".$username."_orders`");
            foreach($checkProduct as $product){
                if($product->name==$name){
                    $check=1;
                    $qty=$qty+$product->qty;
                    break;
                }
            }
            if($check==1){
                $qty=$qty+$req->qty;
                DB::update("UPDATE `".$username."_orders` SET `qty`= ".$qty." WHERE `name` = '".$name."'");
            }
            else{
                DB::insert("INSERT INTO `".$username."_orders`(`id`, `name`, `price`, `qty` , `image1`) VALUES (NULL,'".$name."','".$price."','".$req->qty."', 'imgs/flowers/".$image."')");
            }
            $originalQty = DB::select("select * from `products` where `name` = '".$name."'");
            foreach($originalQty as $item){
                $origQty=$item->qty;
            }
            $newQty = $origQty-$qty;
            DB::update("UPDATE `products` SET `qty`= ".$newQty." WHERE `name` = '".$name."'");
            return redirect()->back()->with('success', 'Successfully Added to Cart');
        }
    }

    function showcart($email){
        $name='';
        $user = DB::select("select * from `users` where `email` = '".$email."'");
        foreach($user as $item){
            $name=$item->name;
        }
        $data = DB::select("select * from `".$name."_orders`");
        return view('cart', ['orders'=>$data])->with('email', $email);
    }

    function deletefromcart($email, $name){
        $user = DB::select("select * from `users` where `email` = '".$email."'");
        foreach($user as $item){
            $username=$item->name;
        }
        DB::delete("DELETE FROM `".$username."_orders` WHERE `name` = '".$name."'");
        return redirect()->back();
    }

    function checkout($email, $total){
        // $user = DB::select("select * from `users` where `email` = '".$email."'");
        $lineItems = [];
        // foreach($user as $item){
        //     $username=$item->name;
        // };
        // $orders = DB::select("select * from `".$username."_orders`");
        // foreach($orders as $order){
            // $products = DB::select("select * from `products` where `name` = '".$order->name."'");
            // foreach($products as $product){
                // $quantity = $product->qty;
                $lineItems[] = [
                    'price_data' => [
                    'currency' => 'pkr',
                    'product_data' => [
                        //'name' => $product->name,
                        'name' => 'Ali',
                        // 'images' => [ $product->image1,  $product->image2]
                    ],
                    //'unit_amount' => $product->price,
                    'unit_amount' => 240,
                    ],
                    //'quantity' => $order->qty,
                    'quantity' => 1,
                ];
            // }
            // $quantity = $quantity-$order->qty;
            // DB::update("UPDATE `products` SET `qty` = ".$quantity." WHERE `name` = '".$order->name."'");
        // }
        $stripe = new \Stripe\StripeClient('sk_test_51NrRGOEO9kDOXxjhnpMUOeF3deQaynrJfdq1GUUBcndmfCfaGbn392MfzEFOHnehazrwQA2fZwUXRtFgdT87gboG00y2nW0UfL');
        $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => route('checkout.success', [], true),
        'cancel_url' => route('checkout.cancel', [], true),
        ]);
        // DB::delete("DELETE FROM `".$username."_orders` ");
        return redirect($checkout_session ->url);
    }

    function success_payment(){
        return view('checkout-success');
    }

    function cancel_payment(){
        return view('checkout-cancel');
    }
    
    function showlist(){
        $products = DB::select("select * from `products`");
        return view ('adminlist', ['collection'=>$products]);
    }

    function showupdatepage($name){
        $products = DB::select("select * from `products` where `name` = '".$name."'");
        return view('updateproduct', ['collection'=>$products]);
    }

    function updateproduct(Request $req, $name){
        $products = DB::select("select * from `products` where `name` = '".$name."'");
        DB::update("UPDATE `products` SET `name`='".$req->name."',`description`='".$req->description."',`price`= ".$req->price.",`qty`= ".$req->quantity." WHERE `name` = '".$name."'");
        return redirect('/list');
    }

    function deleteproduct($name){
        DB::delete("DELETE FROM `products` WHERE `name` = '".$name."'");
        return redirect()->back();
    }
}
