@extends('layouts.app')

@section('content')
<div class="contenitore3">
  <div class="row">

        <div class="col-sm-12">
            <div class="sinistra">
                <h2>Appartamenti</h2>
            </div>
            <div class="pull-right">
                @can('rooms-create')
                <a class="btn btn-success" href="{{ route('rooms.create') }}"> Crea un nuovo appartamento</a>
                @endcan
            </div>
        </div>
                <!-- <form action="{{url('/rooms/search')}}" method="POST" class="form-inline my-2 my-lg-0">
        			{{ csrf_field() }}
        			<div class="form-group">
        				<input type="text" class="form-control mr-sm-2" name="q"
        					placeholder="Ricerca appartamenti">
                            <button type="submit" class="btn btn-outline-success my-2 mr-sm-2" >Cerca</button>
                        </div>
                        <div class="form-inline my-2 my-lg-0">
                    <label for="q" class="mr-sm-2"> <span class="mr-sm-2">Filtra ricerca:  </span> <i class="fas fa-sort mr-sm-2"></i> <input type="checkbox" name="q" value="wifi" class="mr-sm-2"> Wifi</label>
        	            <label for="q" class="mr-sm-2"> <input class="mr-sm-2" type="checkbox" name="q" value="parcheggio"> Parcheggio</label>
                    <label for="q" class="mr-sm-2"><input class="mr-sm-2" type="checkbox" name="q" value="piscina"> Piscina</label>
        			</div>
        		</form> -->
                @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Attenzione!</strong> Ci sono problemi con i dati inseriti.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
  </div>
    <div class="row">
    <table class="table table-striped">
            <tr>
            <th >Id</th>
            <th width="200px;">Immagine</a></th>
            <th>Titolo</th>
            <th>Descrizione</th>
            <th>Indirizzo</th>
            <th>Prezzo</th>
            <th width="130px;">Servizi</th>
            <th width="100px;">@sortablelink('status_id')</th>
            <th width="180px">Azioni</th>
        </tr>
            @if(isset($details))
            <div class="col-sm-12">
            <h5 class="testocentrale"> I risultati della ricerca <b> {{ $query }} </b> sono :</h5>
            </div>
          <hr>
        @foreach($details as $room)
                <tr>
	        <td>{{ $room->id }}</td>
          <td><img src="/storage/images/{{$room->cover}}"  class="img-fluid img-thumbnail" alt="Responsive image"></td>
           <td>{{ $room->title }} </td>
	        <td>{{ substr($room->description, 0, 100)}}{{ strlen($room->description) > 100 ? '...' : ""}}</td>
            <td>{{ $room->street }}</td>
            <td width="100px">€ {{$room->price}}</th>
            <td>{{$room->service_id}}</td>
            @if($room->status_id == 'Pubblicato')
            <td><label class="badge badge-success">{{$room->status_id}}</label></td>
            @endif
            @if($room->status_id == 'Privato')
              <td><label class="badge badge-danger">{{$room->status_id}}</label>  </td>
            @endif
            <td>
               <form action="{{ route('rooms.destroy' ,$room->id) }}" method="post">
               <a class="btn btn-info" href="{{ route('rooms.show',$room->id) }}"><i class="fas fa-eye"></i></a>
               <a class="btn btn-primary" href="{{ route('rooms.edit',$room->id) }}"><i class="fas fa-edit"></i></a>
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
               </form>
	        </td>
	    </tr>     
        @endforeach     
           
        @endif
        
        </div>
        
	    @foreach ($rooms as $room)
	    <tr>
	        <td>{{ $room->id }}</td>
          <td><img src="/storage/images/{{$room->cover}}"  class="img-fluid img-thumbnail" alt="Responsive image"></td>
           <td>{{ $room->title }} </td>
	        <td>{{ substr($room->description, 0, 100)}}{{ strlen($room->description) > 100 ? '...' : ""}}</td>
            <td>{{ $room->street }}</td>
            <td width="100px">€ {{$room->price}}</th>
            <td>{{$room->service_id}}</td>
            @if($room->status_id == 'Pubblicato')
            <td><label class="badge badge-success">{{$room->status_id}}</label></td>
            @endif
            @if($room->status_id == 'Privato')
              <td><label class="badge badge-danger">{{$room->status_id}}</label>  </td>
            @endif
            <td>
               <form action="{{ route('rooms.destroy' ,$room->id) }}" method="post">
               <a class="btn btn-info" href="{{ route('rooms.show',$room->id) }}"><i class="fas fa-eye"></i></a>
               <a class="btn btn-primary" href="{{ route('rooms.edit',$room->id) }}"><i class="fas fa-edit"></i></a>
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
               </form>
	        </td>
	    </tr>
    @endforeach
    </table>
    </div>
    <div class="centro">
    {{$rooms->links()}}
    </div>
        </div>

@endsection