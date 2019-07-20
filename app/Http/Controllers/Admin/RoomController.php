<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::paginate(5);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::find($id);

        if (empty($room)) {
            abort(404);
        };

        $data = [
            'title' => 'Modifica l\'appartamento '.$room->title,
            'method' => 'PATCH',
            'route' => route('Admin.room.update', $room->id),
            'room' => $room
        ];

        return view('room.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $validated = $request->validated();
        $data = $request->all();
        if (empty($room)) {
            abort(404);
        };
        $data['user_id'] = $room->user->id;

        if($request['delete_image']){
            $delete = Storage::disk('public')->delete($request['delete_image']);
            $data['image'] = null;
        }

        
        

        if ($validated->fails()) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        }

       /** Carico un immagine **/
       if ($request->hasFile('cover')) {
        $image = $request->file('cover');
        $name = $image->getClientOriginalName();
        $destinationPath = public_path('/storage');
        $imagePath = $destinationPath. "/".  $name;
        $image->move($destinationPath, $name);
        $room->cover = $name;
      }


        $data['updated_at'] = Carbon::now();

        $room->fill($data);
        $room->save();

        if(isset($request['services'])){
            $services_all = Service::all();
            $this_services = $services_all->whereIn('title', $request['services'])->pluck('id')->all();
            $room->services()->sync($this_services);
        }

        $message = 'Appartamento aggiornato con successo';

        return redirect(route('Admin.rooms.index'))->with('status', $message);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        if (empty($room)) {
            abort(404);
        };

        $room_title = $room->title;
        $messages = $room->messages()->get();
        foreach ($messages as $message){
            $message->delete();
        }

        $room->delete();

        $message = 'Hai cancellato l\'appartamento ' . $room_title;

        return redirect(route('Admin.rooms.index'))->with('status', $message);
    }
}
