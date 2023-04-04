<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('USER.MainFolder.home',compact('pizza','category','cart','history'));
    }

    //user change password page
    public function changePasswordPage(){
        return view('USER.PasswordFolder.change');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        // dd($request->all());
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        // dd($user->toArray());
        $dbHashValue = $user->password;
        // dd($dbHashValue);

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');

            return back()->with(['changeSuccess'=>'Password changed']);
        }

        return back()->with(['notMatch'=>'The old password not match. Try again!']);
    }

    //account change page
    public function accountChangePage(){
        return view('USER.ProfileFolder.profileChange');
    }

    //user account change
    public function accountChange($id, Request $request){
        $this->accountValidation($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            // old image name
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image') -> getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
            // check => delete
            // store
        }

        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'User account updated.']);
    }

    //user pizza filter
    public function filter($id){
        // dd($id);
        $pizza = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('USER.MainFolder.home',compact('pizza','category','cart','history'));
    }

    //pizza details
    public function pizzaDetails($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('USER.MainFolder.details',compact('pizza','pizzaList'));
    }

    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','like','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }
        // dd($totalPrice);
        return view('USER.MainFolder.cart',compact('cartList','totalPrice'));
    }

    //history page
    public function history(){
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(3);
        return view('USER.MainFolder.history',compact('order'));
    }

    //directe user list page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        // dd($users->toArray());
        return view('admin.user.list',compact('users'));
    }

    //change user role
    public function userChangeRole(Request $request){
        // logger($request->all());
        $updateSource = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

    //user contact list
    public function userContact(){
        $data = Contact::select('id','name','email','message')->paginate(3);
        // dd($data->toArray());
        return view('admin.contactFolder.contact',compact('data'));
    }





    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmNewPassword'=>'required|min:6|same:newPassword'
        ],[
            'oldPassword.required'=>'ဖြည့်ရန်လိုအပ်ပါသည်။',
            'newPassword.required'=>'ဖြည့်ရန်လိုအပ်ပါသည်။',
            'confirmNewPassword.required'=>'ဖြည့်ရန်လိုအပ်ပါသည်။'
        ])->validate();
    }

    //account validation check
    private function accountValidation($request){
        Validator::make($request->all(),[
            'userName' => 'required',
            'userEmail' => 'required',
            'userPhone' => 'required',
            'userGender' => 'required',
            'image' => 'mimes:jpg, jpeg, png, webp|file',
            'userAddress' => 'required',
        ])->validate();
    }

    //get user data
    private function getUserData($request){
        return [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'phone' => $request->userPhone,
            'gender' => $request->userGender,
            'address' => $request->userAddress,
            'updated_at' => Carbon::now()
        ];
    }
}
