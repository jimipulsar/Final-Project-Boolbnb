<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Room;
use App\Statu;
use DB;


class SearchController extends Controller

{
   public function index(Request $request)
{
  // $items = DB::table('rooms')->paginate(4);
  $rooms = DB::table('rooms')->where('published', '=', '1')->paginate(8);

  return view('search.search', compact( 'rooms'))->with('i', ($request->input('page', 1) - 1) * 4);
}


public function search(Request $request)
{

      $q = Input::get( 'q' );

      $rooms = Room::where ( 'service_id', 'ilike', '%' . $q . '%' )->orWhere('title', 'ilike', '%' . $q . '%')->paginate(10);
      $rooms->appends(['search' => $q]);

      if(count($rooms) > 0)
          return view ( 'search.search', compact('rooms'))->withDetails ( $rooms )->withQuery ( $q );
          else 
            return redirect()->route('search.search')->with('danger','Nessuna corrispondenza trovata');
          


  }

  // $data = $request->all();
  // $room->service_id = $data['service_id'];
};

// function searchfilter(Request $request)
// {
//         $r = Input::get( 'r' );
//       $room = Room::where ( 'service_id', 'LIKE', '%' . $r . '%' )->orWhere('title', 'LIKE', '%' . $r . '%')->orWhere('indirizzo', 'LIKE', '%' . $r . '%')->get();
//       if (count ( $room ) > 0)
//           return view ( 'search.search' )->withDetails ( $room )->withQuery ( $r );
//       else
//           return view ( 'search.search' )->withMessage ( 'Nessuna corrispondenza trovata. Prova di nuovo' );
//   }
  // $data = $request->all();
  // $room->service_id = $data['service_id'];