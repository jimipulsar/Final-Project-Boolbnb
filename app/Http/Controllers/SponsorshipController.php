<?php

namespace App\Http\Controllers;

use App\Room;
use App\Sponsorship;
use App\SponsorshipsType;
use Illuminate\Http\Request;
use Braintree_ClientToken;
use Braintree_Customer;
use Braintree_PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SponsorshipController extends Controller
{
    //
    public function index($id){
        $room = Room::find($id);
        $sponsorships_type = SponsorshipsType::all();
        $data = [
            'sponsorships_type' => $sponsorships_type,
            'room' => $room
        ];
        return view('payment.index', $data);
    }

    public function payment($id, $sponsorship_type_id){
        $room = Room::find($id);
        $user = Auth::user();
        if(!$room || $room->user_id != $user->id){
            abort('404');
        }

        $now = Carbon::now('Europe/Rome');

        $room_id = $room->id;
        $sponsorship = Sponsorship::where('room_id', $room_id)->first();
        $sponsorship_expire = Carbon::create($sponsorship['sponsor_expired']);
        $diff = $sponsorship_expire->diffInDays($now, false);

        if($diff <= 0){
            $message = 'Sponsorizzazione già attiva';
            return redirect()->back()->with('status', $message);
        }

        $client_token = Braintree_ClientToken::generate();

        $data = [
            'room' => $room,
            'client_token'=> $client_token,
            'sponsorship' => $sponsorship_type_id
        ];

        return view('payment.pay',$data);
    }


    public function process(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $payload = $data['payload'];
        $sponsorship_type_id = $data['sponsorship'];
        $sponsorship_type = SponsorshipsType::find($sponsorship_type_id);

        $room_id = $data['roomId'];

        if(!$user->customer_id){
            $create_customer = Braintree_Customer::create([
                'firstName' => $user->name,
                'lastName' => $user->lastname,
            ]);
            if($create_customer->success){
                $user->customer_id = $create_customer->customer->id;
                $user->save();
            }
        }

        $status = Braintree_PaymentMethod::create([
            'customerId' => $user->customer_id,
            'paymentMethodNonce' => $payload,
            'options' => [
                'verifyCard' => true,
                'verificationAmount' =>  $sponsorship_type->price,
            ]
        ]);

       if($status->success){
            $now = Carbon::now('Europe/Rome');
            $period = $now->addHours($sponsorship_type["period"]);

            $new_sponsorship = new Sponsorship();
            $new_sponsorship->room_id = $room_id;
            $new_sponsorship->sponsorships_type_id = $sponsorship_type_id;
            $new_sponsorship->sponsor_expired = $period;
            $new_sponsorship->created_at = $now;
            $new_sponsorship->updated_at = $now;
            $new_sponsorship->save();
        }


        return response()->json($status);
    }
}
