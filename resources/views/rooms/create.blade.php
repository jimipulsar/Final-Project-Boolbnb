@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="pull-left">
                <h2>Crea un nuovo appartamento</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}"> Indietro</a>
            </div>
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
    <div class="container py-4">
    <div class="row">
        <div class="col-md-10 mx-auto">
    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
    	@csrf
      <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control"  placeholder="">
                    </div>
                    <div class="col-sm-6">
                    <label for="description">Descrizione</label>
              <textarea type="text" name="description" class="form-control" placeholder="" style="height:40px;"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                    <label for="street">Indirizzo</label>
            <input type="text" name="street" class="form-control"  placeholder="">
                    </div>
                    <div class="col-sm-1">
                    <label for="house_number">Civico</label>
            <input type="text" name="house_number" class="form-control"  placeholder="">
                    </div>
                    <div class="col-sm-3">
                        <label for="latitude">Latitudine</label>
                        <input type="text" name="latitude" class="form-control"   placeholder="">
                    </div>
                    <div class="col-sm-3">
                        <label for="longitude">Longitudine</label>
                        <input type="text" name="longitude" class="form-control"   placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="published">Stato di pubblicazione</label>
              <select class="form-control" name="published">

              <option value="0">Privato</option>
              <option value="1">Pubblico</option>

            </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="locality">Città</label>
                        <input type="text" name="locality" class="form-control"   placeholder="">
                    </div>
                    <div class="col-sm-2">
                        <label for="postal_code">Codice Postale</label>
                        <input type="text" name="postal_code" class="form-control" placeholder="">
                    </div>
                    <div class="col-sm-2">
                        <label for="state">Nazione</label>
                        <input type="text" name="state" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                      
                    <label for="service_id">Servizi</label>
              <select class="form-control" name="service_id">
              @foreach ($services as $service)
              <option value="{{ $service->title }}">{{$service->title}}</option>
              @endforeach
            </select>
                    </div>
                    <div class="col-sm-2">
                        <label for="n_rooms">Stanze</label>
                        <input type="number" name="n_rooms" class="form-control"   placeholder="">
                    </div>
                    <div class="col-sm-2">
                        <label for="n_baths">Bagni</label>
                        <input type="number" name="n_baths" class="form-control"  placeholder="">
                    </div>
                    <div class="col-sm-2">
                        <label for="n_beds">Letti</label>
                        <input type="number" name="n_beds" class="form-control" placeholder="">
                    </div>
                    <div class="col-sm-2">
                        <label for="metri_quadrati">m²</label>
                        <input type="number" name="metri_quadrati" class="form-control"   placeholder="">
                    </div>
    

                    <div class="col-sm-2">
                    <label for="price">Prezzo</label>
          <input type="number" name="price" class="form-control"  placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                <label for="cover">Immagine:</label>
            <input type="file" name="cover" placeholder="Inserisci un immagine" class="form-control">
            </div>
                </div>
                {{--Hidden--}}
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                    <button class="btn btn-primary">Salva</button>
                                </div>
                                </div>
                                {{--Hidden--}}
            </form>
        </div>
    </div>
    </div>
</div>
@endsection
