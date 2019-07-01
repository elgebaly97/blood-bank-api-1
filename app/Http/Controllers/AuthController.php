<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Token;
use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    //
    private function apiResponse($status, $message, $data=null){
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data

        ];
        return response()->json($response);
    }

    public function register(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:clients',
            'mobile' => 'required',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails()){
            return $this->apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->save();
        return $this->apiResponse(1, 'تم الاضافه بنجاح', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }


    public function login(Request $request){
        $validator = validator()->make($request->all(),[

            'mobile' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('mobile', $request->mobile)->first();

        if($client){
            if(Hash::check($request->password, $client->password)){
                return $this->apiResponse(1, 'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else{
                return $this->apiResponse(2, 'بيانات المستخدم غير صحيحه');
            }
        }
        return $this->apiResponse(2, 'بيانات المستخدم غير صحيحه');
    }


    public function password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'password' => 'required|confirmed',
            //'pin' => 'required'
        ]);

        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $user = Client::where('mobile', $request->mobile)->first();
        if($user){
            //$code = rand(1111,9999);

            $password = Hash::make($request->password);
            $update = $user->update(['password' => $password]);



            if($update){
                return responseJson(1, 'تم تغيير كلمة السر بنجاح');
            }
        }


        return responseJson(2, 'فشل فى التغييى يبشه');



    }

    public function reset(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'mobile' => 'required',

        ]);

        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $user = Client::where('mobile', $request->mobile)->first();
        if($user){
            $code = rand(1111, 9999);
            $update = $user->update(['pin' => $code]);

            if($update){
                // send sms
                // send email
                Mail::to($user->email)
                    ->bcc("helgebaly65@gmail.com")
                    ->send(new ResetPassword($code));

                return responseJson(1, 'تفحص هاتفك', ['pin code is ' => $code]);
            }else {
                return responseJson(0, 'حاول مره اخرى');
            }
        }else {
            return responseJson(0, 'انت غير مسجل اصلا');
        }

    }

    public function registerToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',
            'platform' => 'required|in:android,ios'

        ]);

        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'تم التسجيل بنجاح');
    }

    public function removeToken(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required'
        ]);

        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();
        return responseJson(1, 'تم المسح بنجاح');
    }

}
