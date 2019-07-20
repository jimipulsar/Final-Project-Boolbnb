<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Sponsorship;
use App\Message;
use App\Service;
use App\Visit;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
               // $this->middleware(['auth', 'verified']);
        //   $this->middleware('permission:rooms-list');
        $this->middleware('permission:rooms-create', ['only' => ['create','store']]);
        $this->middleware('permission:rooms-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:rooms-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->id;
        //ultimi 3 appartamenti
        $rooms = Room::where('user_id', $user)->latest()->limit(3)->get();
        //ultimi 4 messaggi
        $messages = Message::where('user_id', $user)->latest()->limit(4)->get();
        //tutti fli appartamenti dell'utente
        $rooms_all = Room::where('user_id', $user)->where('published', true)->get();
        //tutte le sponsorizzazioni attive
        $sponsorships = room::UserActiveSponsorhips($user)->get();

        if(count($sponsorships->toArray()) === 0){
            $sponsorships = null;
            $suggestion_sponsorships = [];
            $i = 0;

            while($i < count($rooms_all) && $i < 2){

                $visits = Visit::where('room_id', $rooms_all[$i]->id)->orderBy('created_at', 'desc')->get();

                $data = [
                    'year' => Carbon::now()->year,
                    'visits'=> [0,0,0,0,0,0,0,0,0,0,0,0],
                ];

                foreach ($visits as $visit){
                    $visit_created = Carbon::make($visit['created_at']);
                    $visit_month = $visit_created->month;
                    $visit_year = $visit_created->year;

                    if($data['year'] === $visit_year){
                        $data['visits'][$visit_month-1] += 1;
                    }
                }

                $med_visits = ceil(array_sum ($data['visits']) / 12);

                if($med_visits < 100){
                    $suggestion_sponsorships[$i]['room'] = $rooms_all[$i];
                    $suggestion_sponsorships[$i]['med_visits'] = $med_visits;
                }

                $i++;
            }
        }

        $data = [
            'rooms' => $rooms,
            'messages' => $messages,
            'sponsorships' => $sponsorships,
            'suggestion_sponsorships' =>  (isset($suggestion_sponsorships)) ? $suggestion_sponsorships : null
        ];

        return view('user.home', $data);
    }
    
    public function stanze(Request $request) {
        $service = Service::all();
        $rooms = Room::orderBy('created_at','DESC')->paginate(10);
        // $rooms = DB::table('rooms')->where('status_id', 'Pubblicato')->get();
        return view('rooms.stanze', compact('rooms', 'service'));
    }
    

}
