<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RoomStoreRequest;
use Carbon\Carbon;

use Illuminate\Support\Facades\Gate;
use App\Visit;
use App\Message;
use App\Room;
use App\Service;
use App\Statu;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Mapper;

class RoomController extends Controller

{
  private $validation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //  $this->middleware(['auth', 'verified']);
        //   $this->middleware('permission:rooms-list');
         $this->middleware('permission:rooms-create', ['only' => ['create','store']]);
         $this->middleware('permission:rooms-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:rooms-delete', ['only' => ['destroy']]);
        
        $this->validation = [
            'title'=> 'required',
            'description'=> 'required|string',
            'price'=> 'required|numeric',
            'street'=> 'required|string',
            'house_number'=> 'required|numeric',
            'locality'=> 'required|string',
            'postal_code'=> 'required|numeric',
            'latitude'=> 'required|numeric',
            'longitude'=> 'required|numeric',
            'cover'=>'nullable|image',
            'metri_quadrati'=>'required|numeric',
            'n_rooms'=>'required|numeric',
            'n_beds'=>'required|numeric',
            'n_baths'=>'required|numeric',
            'user_id'=>'exists:users,id',
            'state'=>'required|string',
            'services'=>'nullable|exists:services,name',
        ];
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {
      
      $sponsorships = Room::AllActiveSponsorhips()->get();

      return view('rooms.index', compact('sponsorships'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()

    {
      $rooms = Room::all();
      $services = Service::all();
      $stato = Statu::all();
      $permission = Permission::get();

      return view('rooms.create',compact('permission', 'services', 'stato'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(RoomStoreRequest $request)

    {
      $data = $request->all();


      $validated_data = Validator::make($data, $this->validation);

      if ($validated_data->fails()) {
          return redirect()->back()
              ->withErrors($validated_data)
              ->withInput();
      }
      $room = new Room;
      $room->fill($data);
      $room->save();

      if(isset($request['services'])){
          $services_all = Service::all();
          $this_services = $services_all->whereIn('name', $request['services'])->pluck('id')->all();
          $room->services()->sync($this_services);
      }
              if ($request->hasFile('cover')) {
          $image = $request->file('cover');
          $name = $image->getClientOriginalName();
          $destinationPath = public_path('storage/images/');
          $imagePath = $destinationPath. "storage/images/".  $name;
          $image->move($destinationPath, $name);
          $room->cover = $name;
        }
        $room->save();
        return redirect()->route('rooms.stanze')
                        ->with('success','Appartamento creato con successo!');

    }

    /**

     * Display the specified resource.
     *
     * @param  \App\Room  $auto
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {
        $room = Room::find($id);
        Mapper::map($room->latitude, $room->longitude);
        return view('rooms.show',compact('room'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $auto
     * @return \Illuminate\Http\Response
     */
    public function userIndex()
    {
        $user = Auth::user()->id;
        $rooms = Room::where('user_id', $user)->orderBy('updated_at', 'DESC')->get();
        return view('room.userIndex', compact('rooms'));
    }
     public function edit($id)
       {
        $room = Room::find($id);
        return view('rooms.edit',compact('room'));

       }


    /**

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $auto
     * @return \Illuminate\Http\Response
     */

     public function update(RoomStoreRequest $request, $id)

     {

      $validated = $request->validated();
        $room = Room::find($id);
        $status = Statu::all();
        $services = Service::all();
        

         $room->update([
             'title' => $request->input('title'),
             'description' => $request->input('description'),
             'n_rooms' => $request->input('n_rooms'),
             'n_beds' => $request->input('n_beds'),
             'n_baths' => $request->input('n_baths'),
             'metri_quadrati' => $request->input('metri_quadrati'),
             'street' => $request->input('street'),
             'price' => $request->input('price'),
             'house_number'=> $request->input('house_number'),
             'locality'=> $request->input('locality'),
             'postal_code'=> $request->input('postal_code'),
             'latitude'=> $request->input('latitude'),
             'longitude'=>$request->input('longitude'),

             'state'=>$request->input('state'),
             'services'=>$request->input('services'),
             ]);

             if ($request->hasFile('cover')) {
               $image = $request->file('cover');
               $name = $image->getClientOriginalName();
               $destinationPath = public_path('storage/images');
               $imagePath = $destinationPath. "storage/images".  $name;
               $image->move($destinationPath, $name);
               $room->cover = $name;
             }

             $room->save();

           return redirect()->route('rooms.stanze', compact('room','status', 'services'))->with('success','Appartamento modificato con successo!');

     }

    /**

     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $auto
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)

    {
        $room = Room::find($id);
        $room->delete();
        return redirect()->route('rooms.stanze')->with('danger','Appartamento eliminato con successo');

    }

    public function statistics(Room $room)
    {
      
      

       

        $visits = Visit::get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        })->toArray();

        $messages = Message::get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        })->toArray();

        $years = array_unique(array_merge(array_keys($visits), array_keys($messages)), SORT_REGULAR);

        $data = [
            'room' => $room,
            'years' => $years
        ];

        return view('rooms.statistics', $data);
    }
/**
     *
     * View Search
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function search(Request $request){
      $data = $request->all();
      return view('rooms.search', compact('data'));
  }


}
      // $maxprice = DB::table('rooms')->max('price');
      // $minprice = DB::table('rooms')->min('price');
      //  $price = Room::orderBy('price','ASC')->paginate(10);
//       if(!$user){
//         //user is not found 
//  }
//  if($user){
//         // user found 
//  }