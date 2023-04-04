<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    public function changePassword(Request $request){
        // dd($request->all());
        /*
            1. All fields must be fill
            2. New password & confirm password length must be greater than six
            3. New password & confirm password must be same
            4. Client old password must be same with DB password
            5. Password Change
        */

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

        // dd(Hash::make('hello'));
        // $hashValue = Hash::make('hello');
        // if(Hash::check('hello',$hashValue)){
        //     dd('password same');
        // }else{
        //     dd('incorrect');
        // }
    }

    //direct admin detail blade
    public function details(){
        return view('admin.account.details');
    }

    //direct admin edit blade
    public function edit(){
        return view('admin.account.edit');
    }

    //direct admin update blade
    public function update($id, Request $request){
        // dd($id,$request->all());
        $this->accountValidation($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            // old image name
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;
            // dd($dbImage);

            if($dbImage != null){
                // Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image') -> getClientOriginalName();
            // dd($fileName);
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
            // check => delete
            // store
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin account updated.']);
    }

    //admin list
    public function list(){
        $admin = User::
        when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                    ->orWhere('email','like','%'.request('key').'%')
                    ->orWhere('gender','like','%'.request('key').'%')
                    ->orWhere('phone','like','%'.request('key').'%')
                    ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','like','admin')
                ->paginate(3);
        // dd($admin->toArray());
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //admin delete
    public function delete($id){
        User::where('id','like',$id)->delete();
        // dd('delete');
        return back()->with(['deleteSuccess'=>'Admin account has been deleted.']);
    }

    //admin change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //admin change
    public function change($id, Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //AJAX CHANGE ROLE
    public function ajaxChangeRole(Request $request){
        // logger($request->all());
        // User::where('id',$request->userId)
        //     ->update([
        //         'role' => $request->adminRole
        //     ]);
        // return redirect()->route('admin#list');

        $updateSource = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }



    //request user data
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
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
}
