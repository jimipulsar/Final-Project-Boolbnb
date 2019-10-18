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
            <th width="100px;">Stato</th>
            <th width="180px">Azioni</th>
        </tr>
        
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
            @if($room->published == '1')
            <td><label class="badge badge-success">Pubblico</label></td>
            @endif
            @if($room->published == '0')
              <td><label class="badge badge-danger">Privato</label>  </td>
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