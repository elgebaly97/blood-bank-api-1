<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Government;
use App\City;
use App\Notification;
use App\Setting;
use App\Client;
use Illuminate\Http\Request;
use App\Post;
use App\Order;
use Illuminate\Support\Facades\DB;
use App\Token;


class Api extends Controller
{
    //
    private function apiResponse($status, $message, $data=null){
        $response =[
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
}

    public function governments(){
        $government = Government::all();

        return responseJson(1, 'success', $government);
    }

    public function categories(){
        $categories = Category::all();

        return $this->apiResponse(1, 'success', $categories);
    }



    public function settings(){

        $settings = Setting::all();
        return responseJson(1,'',$settings);

    }

    public function profile(Request $request){

        $client = Client::where('mobile', $request->mobile)->first();
        $client->update([
            'email' => $request->email,
            'city_id' => $request->city_id,
            'last_donate' => $request->last_donate
        ]);
        return responseJson(1, 'مرحبا', $client);


    }

    public function contacts(Request $request){
        $validator = validator()->make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails()){
            return $this->apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        //$contact = Contact::all();
        DB::table('contacts')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return $this->apiResponse(1, 'تم ارسال رسالتك بنجاح', [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
    }













    /*public function post(){
        $posts = Post::all();

        return $this->apiResponse(1, 'success', $posts);
    }*/

    /*public function cities(Request $request){
        $cities = City::where('government_id',$request->government_id)->get();
        return $this->apiResponse(1, 'success', $cities);

    }*/

    public function cities(Request $request){
        $cities = City::where(function($query) use($request){
            if($request->has('government_id')){

                $query->where('government_id', $request->government_id);

            }
        })->get();

        return $this->apiResponse(1, 'success', $cities);
    }

    public function posts(Request $request){
        $posts = Post::where(function($query) use ($request){
            if($request->has('category_id')){
                $query->where('category_id', $request->category_id);
            }
        })->get();

        return $this->apiResponse(1, 'success', $posts);
    }

    public function post(Request $request){
        $post = Post::find($request->post_id);
        if(!$post){
            return responseJson(0,'فشل');
        }
        return responseJson(1, '', $post);
    }

    public function favourites(Request $request){
        $posts = $request->user()->posts()->paginate(10);
        return responseJson(1, '', $posts);
    }

    public function toggleFav(Request $request){
        $request->user()->posts()->toggle($request->post_id);

        return responseJson(1, 'تمام');
    }

    public function requestDonate(Request $request)
    {

        $validator = validator()->make($request->all(),[
            'name' => 'required',
            'age' => 'required',
            'blood_type_id' => 'required',
            'num_quantity' => 'required',
            'hospital' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'client_id' => 'required',
            'city_id' => 'required',
        ]);

        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $orderRequest = $request->user()->orders()->create($request->all());
        $clientsIds = $orderRequest->city->government->clients()->whereHas('blood_types', function ($query) use ($request) {
            $query->where('blood_types.id', $request->blood_type_id);
        })->pluck('client_id')->toArray();

        $send="";
        //dd($clientsIds);
        if(count($clientsIds)){
            $notification = $orderRequest->notification()->create([
                'title' => 'محتاج متبرع',
                'content' => $request->user()->name. 'محتاج متبرع للفصيلة'
            ]);



            $tokens = Token::whereIn('client_id', $clientsIds)->where('token', '!=', null)->pluck('token')->toArray();



            //$tokens = $client->tokens()->where('token','!=', '')->whereIn('client_id', $clientsIds)->pluck('token')->toArray();

            if(count($tokens)){

                /*$notification->clients()->attach($clientsIds);
                $tokens = $request->ids;
                $title = $request->title;
                $body = $request->body;
                $data = Order::first();
                $send = notifyByFirebase($title, $body, $tokens, $data, true);
                info("firebase result: " . $send);*/
                /*$audience = ['include_players_id' => $tokens];
                $content = [
                    'ar' => 'يوجد اشعار من '.$request->user()->name(),
                    'en' => 'you have new notificatopn from' . $request->user()->name()
                ];*/

                $title = $notification->title;
                $content = $notification->content;
                $data = [
                    'donation_request_id' => $orderRequest->id
                ];

                //info(json_encode($data));

                $send = notifyByFirebase($title, $content, $tokens, $data);
                //info($send);
                //info(['firebase result', $send]);
                //$send = json_decode($send);
            }
            //return responseJson(1,'تم الارسال بنجاح',$orderRequest);
        }


        return responseJson(1, 'تم الاضافه بنجاح', $send);
        //dd($clientsIds);
        //return responseJson(1, 'تم الاضافه بنجاح', $clientsIds);

    }


    public function notifications(Request $request){

    }

    public function notificationSettings(Request $request){
        if($request->has('government')){

            $request->user()->governments()->sync($request->governments);

            $governmentId = $request->user()->governmnets()->pluck('id')->toArray();
            return responseJson(1, 'تم التحديث', $governmentId);

        }
        if($request->has('blood_type')){
            $request->user()->blood_types()->sync($request->blood_types_id);

            $bloodTypeId = $request->user()->blood_types()->pluck('id')->toArray();
            return responseJson(1, 'تم التحديث',  $bloodTypeId);
        }

        return responseJson(1, 'تم التحديث');
    }

    public function donationRequests(Request $request) {
        //RequestLog::create(['content' => $request->all(), 'service' => 'orders']);
        $orders = Order::where(function($query) use ($request){
            if($request->input('government_id')){
                $query->whereHas('city', function($query) use ($request){
                    $query->where('government_id', $request->government_id);
                });
            }elseif ($request->input('city_id')){
                $query->where('city_id', $request->city_id);
            }
            if($request->input('blood_type_id')){
                $query->where('blood_type_id', $request->blood_type_id);
            }
        })->with('city.government', 'client', 'blood_type')->latest()->paginate(10);

        return responseJson(1, 'success', $orders);
    }


    public function notificationList(Request $request) {
        //$notifications = Notification::all();
        $notification = $request->user()->notifications;
        //$notification = $request->user()->notifications()->all();
        return responseJson(1, '', $notification);
    }





}
