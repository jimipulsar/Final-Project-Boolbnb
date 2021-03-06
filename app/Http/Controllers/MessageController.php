<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if($user->id !==  Auth::user()->id && !Auth::user()->hasRole('admin')){
            abort(404);
        }

        $messages = Message::where('user_id', $user->id)->paginate(10);

        $data =  [
            'user' => $user,
            'messages' => $messages,
        ];

      return view('user.messages.index', compact('data'));

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
      $data = $request->all();

      $newMessage = new Message();
      $newMessage->name = $data['name'];
      $newMessage->email = $data['email'];
      $newMessage->text = $data['text'];
      $newMessage->user_id = $data['user_id'];
      $newMessage->room_id = $data['room_id'];

      $newMessage->save();

        $status = 'Messaggio inviato con successo';
        return redirect()->back()->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        if (empty($message)) {
          abort(404);
        };

        return view('user.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $message = Message::find($id);
        if(empty($message)){
            abort('404');
        }

        $message_name = $message->name;
        $message->delete();

        $status = 'Hai cancellato il messaggio ricevuto da ' . $message_name;

        if (Auth::user()->can('modify') && $message->user_id != $user->id) {
          return redirect( route('Admin.messages.index'))->with('status', $status);
        } else {
          return redirect( route('messages.index', $user))->with('status', $status);
        }

    }
}
