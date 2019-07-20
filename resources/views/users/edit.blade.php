@extends('layouts.app')
@section('content')
<div class="contenitore">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Modifica Utente</h2>
        </div>
        <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('users.index') }}"> Indietro</a>
        </div>
    </div>
</div>
@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Attenzione!</strong> Ci sono stati dei problemi con i dati inseriti.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
<form action="{{ route('users.update', $user->id) }}" method="POST">
	@csrf
  @method('PUT')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
    	  <label for="name">Nome</label>
    	  <input type="text" name="name" class="form-control" value="{{ $user->name }}" >
    	</div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
    	  <label for="surname">Cognome</label>
    	  <input type="text" name="surname" class="form-control" value="{{ $user->surname }}" >
    	</div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
      <label for="password">Password</label>
        <input type="password" class="form-control" name="password"  value="{{$user->password}}" placeholder="******">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="email">Indirizzo E-mail</label>
        <input type="text" name="email" class="form-control" value="{{ $user->email }}" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="date-input">Data di nascita</label>
        <input class="form-control" type="date" name="birthdate" value="{{$user->birthdate}}" >
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
        <label for="roles">Ruolo</label>
{!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Applica modifiche</button>
    </div>
</div>

</form>
</div>
@endsection
