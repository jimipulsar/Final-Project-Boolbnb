@extends('layouts.app')

@section('content')
<div class="container py-4">
<div class="row">
        <div class="col-md-10 mx-auto">
            <div class="pull-left">
                <h2>Modifica Appartamento</h2>
            </div>
            <div class="pull-right">
            <a class="btn btn-primary" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> Indietro</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Attenzione!</strong> Ci sono stati dei problemi con i dati inseriti.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
</div>
<div class="container py-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
        <form action="{{ route('rooms.update',$room->id) }}" method="POST" enctype="multipart/form-data">
        	@csrf
        @method('PUT')
                <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" value="{{$room->title}}">
                    </div>
                    <div class="col-sm-6">
                    <label for="description">Descrizione</label>
            <textarea type="text" name="description" class="form-control" placeholder="" value="{{$room->description}}" style="height:50px;">{{$room->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                    <label for="street">Indirizzo</label>
            <input type="text" name="street" class="form-control"  value="{{$room->street}}">
                    </div>
                    <div class="col-sm-1">
                    <label for="house_number">Civico</label>
            <input type="text" name="house_number" class="form-control"  value="{{$room->house_number}}">
                    </div>
                    <div class="col-sm-3">
                        <label for="latitude">Latitudine</label>
                        <input type="text" name="latitude" class="form-control"  value="{{$room->latitude}}">
                    </div>
                    <div class="col-sm-3">
                        <label for="longitude">Longitudine</label>
                        <input type="text" name="longitude" class="form-control"  value="{{$room->longitude}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                    <label for="published">Stato di pubblicazione</label>
                      {!! Form::select('published', ['1' => 'Pubblicato', '0' => 'Privato'], array('default' => $room->published), array('class' => 'form-control')); !!}
                    </div>
                    <div class="col-sm-3">
                        <label for="state">Nazione</label>
                        <input type="text" name="state" class="form-control"  value="{{$room->locality}}">
                    </div>
                    <div class="col-sm-3">
                        <label for="locality">Città</label>
                        <input type="text" name="locality" class="form-control"  value="{{$room->locality}}">
                    </div>
                    <div class="col-sm-3">
                        <label for="postal_code">Codice Postale</label>
                        <input type="text" name="postal_code" class="form-control"  value="{{$room->postal_code}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                      
                    <label for="service_id">Servizi</label>
          {!! Form::select('service_id', ['Wifi' => 'Wifi', 'Piscina' => 'Piscina', 'Parcheggio' => 'Parcheggio', 'Aria Condizionata' => 'Aria Condizionata',], array('default' => $room->service_id), array('class' => 'form-control')); !!}
                    </div>
                    <div class="col-sm-3">
                    <label for="price">Prezzo</label>
          <input type="text" name="price" class="form-control" value=" {{$room->price}}">
                    </div>
                    <div class="col-sm-2">
                        <label for="n_rooms">Stanze</label>
                        <input type="number" name="n_rooms" class="form-control"  value="{{$room->n_rooms}}">
                    </div>
                    <div class="col-sm-2">
                        <label for="n_baths">Bagni</label>
                        <input type="number" name="n_baths" class="form-control"  value="{{$room->n_baths}}">
                    </div>
                    <div class="col-sm-1">
                        <label for="n_beds">Letti</label>
                        <input type="number" name="n_beds" class="form-control"  value="{{$room->n_beds}}">
                    </div>
                    <div class="col-sm-1">
                        <label for="metri_quadrati">m²</label>
                        <input type="number" name="metri_quadrati" class="form-control"  value="{{$room->metri_quadrati}}">
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-4">    
                    <img src="/storage/images/{{$room->cover}}"  class="img-fluid img-thumbnail" style="height:200px;">
                    <label for="cover" ></label>        
                    <input type="file" name="cover" class="form-control" value="/storage/images/{{$room->cover}}" >
                    </div>
  
                </div>
                <button type="submit" class="btn btn-primary">Applica modifiche</button>
            </form>
        </div>
    </div>
</div>
    </div>
@endsection
