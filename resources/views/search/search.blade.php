
@extends('layouts.app')
@section('content')
          <div class="jumbotron" id="slide">
          <div class="contenitore4 style fade-in">
            <label for="q" style="font-size:18px;color:#003342;" id="text-search">Cerca un appartamento</label>
            <form action="/search" method="POST" role="search" >
        			{{ csrf_field() }}
        			<div class="form-group">
        				<input type="text" class="form-control mr-sm-2" name="q"
        					placeholder="Ricerca appartamenti">
                  <button type="submit" class="btn btn-success my-2 mr-sm-2 pull-right" >Cerca</button>
                    <span class="input-group-btn" id="text-btn">
                    <label for="q"><i class="fas fa-sort"></i> Filtra ricerca:    <input type="checkbox" name="q" value="wifi"> Wifi</label>
        	            <label for="q"> <input type="checkbox" name="q" value="parcheggio"> Parcheggio</label>
                    <label for="q"><input type="checkbox" name="q" value="piscina"> Piscina </label>
                    <label for="q"><input type="checkbox" name="q" value="aria condizionata"> Aria Condizionata </label>
        				    </span>
        			</div>
        		</form>
            <br>
            @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
            
        </div>
      </div>
      @if(isset($details))
        <div class="colonna">

          <br>
            @foreach($details as $room)
            @if($room->published == '1')
              <div class="row"  id="featured">
                <div class="col-sm-4">
                <img src="/storage/images/{{$room->cover}}"  class="img-fluid img-thumbnail" alt="Responsive image" >
              </div>
                <div class="media-body">
                  <h3 class="mt-0 mb-1 text-left" style="margin-left:30px;">{{$room->title}}</h3><p class="text-left" style="margin-left:30px;margin-top:10px;"><i class="far fa-check-circle" style="color:#15707c;font-size:18px;"> </i> {{$room->service_id}} &nbsp; &nbsp;<i class="fas fa-bed" style="color:#15707c;font-size:18px;"></i> Posti Letto:  {{$room->n_beds}} &nbsp; <i class="fas fa-bath" style="color:#15707c;font-size:18px;></i> style="color:#15707c;font-size:18px;"> </i> Bagni:  {{$room->n_baths}}</p>
                  <p class="text-left" style="margin-left:30px;font-size:14px;">{{$room->description}}</h5>
                  <br>
                  <a class="btn btn-info" href="{{ route('rooms.show',$room->id) }}">Visita l'appartamento</a>
                </div>
              </div>
              <br>
              <hr style="height:10px;">
              <br>
              @endif
              @endforeach
          @elseif(isset($message))
          <p style="font-size:18px;color:#003342; text-align:center;">{{ $message }}</p>
          @endif
        </div><br>
      </div>
          <div class="contenitore3">
          <div class="row justify-content-md-center">
            @foreach($rooms as $room)
            @if($room->published == '1')
            <div class="col-sm-3 my-2 p-2">
              <div class="card">
              <img class="card-img-top" src="/storage/images/{{$room->cover}}"  alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{$room->title}}</h5><p class="text-left" style="margin-top:10px;"><i class="far fa-check-circle" style="color:#15707c;font-size:18px;"> </i> {{$room->service_id}} &nbsp; &nbsp;<i class="fas fa-bed" style="color:#15707c;font-size:18px;"></i> Posti Letto:  {{$room->n_beds}} &nbsp; <i class="fas fa-bath" style="color:#15707c;font-size:18px;></i> style="color:#15707c;font-size:18px;"> </i> Bagni:  {{$room->n_baths}}</p>
                  <p class="card-text">{{ substr($room->description, 0, 100)}}{{ strlen($room->description) > 100 ? '...' : ""}}</p>
                  <form action="{{ route('rooms.destroy' ,$room->id) }}" method="post" >
               <a class="btn btn-info classeform" href="{{ route('rooms.show',$room->id) }}"><i class="fas fa-eye">  </i>  Mostra</a>
               </form>
                </div>
              </div>
            </div>
            @endif
          @endforeach
          </div>
        </div>
      </div>
      <div class="centro">
      {{$rooms->links()}}
      </div>
    </div>
    </div>
@endsection