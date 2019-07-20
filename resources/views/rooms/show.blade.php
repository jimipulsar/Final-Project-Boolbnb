@extends('layouts.app')

@section('content')
<div class="contenitore3">
      <div class="row">
          <div class="col-lg-5">

              <br>
            <img src="/storage/images/{{$room->cover}}" class="img-fluid img-thumbnail" width="100%;" >
            <h4 class="text-absolute">{{$room->title}}</h4>
      
          </div>
          <div class="col-lg-6">
            <br>
            <h4><strong>Descrizione:<strong></h4>
              <p>{{$room->description}}</p>
              <div class="services">
              <p class="text-left" style="margin-top:10px;"><i class="far fa-check-circle" style="color:#15707c;font-size:18px;"> </i> {{$room->service_id}} &nbsp; &nbsp;<i class="fas fa-bed" style="color:#15707c;font-size:18px;"></i> Posti Letto:  {{$room->n_beds}} &nbsp; <i class="fas fa-bath" style="color:#15707c;font-size:18px;></i> style="color:#15707c;font-size:18px;"> </i> Bagni:  {{$room->n_baths}} </p>
              <p> <i class="fas fa-map-marker-alt" style="color:#15707c;font-size:18px;">  </i>  {{$room->street}}, {{$room->house_number}} - {{$room->locality}}</p>
</div>
              @if(isset(Auth::user()->id) && ($room->user_id === Auth::user()->id || Auth::user()->hasRole('admin_root')))
          <div class="pull-left">
                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">Modifica</a>
                <a href="{{ route('rooms.statistics', $room->id) }}" class="btn btn-primary">Visualizza statistiche</a>
            @if(!Auth::user() || Auth::user()->id != $room->user_id)
                    {{--messaggio--}}
                    <div class="col-12">
                      @component('components.message.form',['room' => $room])
                      @endcomponent
                    </div>
                    {{--/messaggio--}}
                @endif
          </div>
        @endif
              <a class="btn btn-primary" href="{{ url()->previous() }}" style=""><i class="fas fa-arrow-left"></i> Torna indietro</a>
       
            </ul>
          </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
          <div class="col-sm-6">
            <br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10496.116007754863!2d2.359508332330819!3d48.876723668626816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66ddfb585c261%3A0x995f6ca1eb548801!2sColonel+Fabien!5e0!3m2!1sit!2sit!4v1553619400251" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
          <div class="col-sm-6">
         
          <br>
           <h3 align="center">Scrivi al proprietario per richiedere maggiori informazioni</h3><br />
           @if (count($errors) > 0)
            <div class="alert alert-danger">
             <button type="button" class="close" data-dismiss="alert">×</button>
             <ul>
              @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
              @endforeach
             </ul>
            </div>
           @endif
           @if ($message = Session::get('success'))
           <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                   <strong>{{ $message }}</strong>
           </div>
           @endif
           <form method="post" action="{{url('sendemail/send')}}">
            {{ csrf_field() }}
            <div class="form-group">
             <label>Il tuo nome</label>
             <input type="text" name="name" class="form-control" value="" />
            </div>
            <div class="form-group">
             <label>La tua E-mail</label>
             <input type="text" name="email" class="form-control" value="" />
            </div>
            <div class="form-group">
             <label>Il tuo messaggio</label>
             <textarea name="message" class="form-control" style="height:150px;"></textarea>
            </div>
            <div class="form-group">
             <input type="submit" name="send" class="btn btn-info" value="Invia" style="width:100%;" />
            </div>
           </form>
        </div>
      </div>
</div>
<br>
@endsection
