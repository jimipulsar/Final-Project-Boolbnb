@extends('layouts.app')
@section('content')
<div class="contenitore">

<h2 class="terzo-titolo">Crea nuovo utente</h2>
<form class="form-contatto-post" action="{{route('users.store')}}" method="POST">
	@csrf
	<table class="table">
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Attenzione!</strong> Ci sono dei problemi con i dati inseriti.
			<ul>
				@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
			@if(session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
			@endif
	</table>
	<div class="form-group">
	  <label for="name">Nome</label>
	  <input type="text" name="name" class="form-control" required>
	</div>
	<div class="form-group">
		<label for="surname">Cognome</label>
		<input type="text" name="surname" class="form-control" required>
	</div>
  <div class="form-group">
    <label for="date-input">Data di nascita</label>

      <input class="form-control" type="date" name="birthdate" value="2011-08-19" >

  </div>
  <div class="form-group">
      <label for="email">E-mail</label>
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  required>

      @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
  </div>
  <div class="form-group">
      <label for="password">Password</label>
          <input id="password" type="password" class="form-control" name="password"  required>
  </div>
<div class="form-group">

  <label for="roles">Ruolo</label>
      {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}

		</div>
	<div class="form-group">
		<input type="submit" value="Applica" class="form-control" id="save">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
@endsection



<!-- @section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Crea nuovo utente</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('users.index') }}"> Indietro</a>

        </div>

    </div>

</div>


@if (count($errors) > 0)

  <div class="alert alert-danger">

    <strong>Whoops!</strong> Hay algunos problemas con los datos ingresados.<br><br>

    <ul>

       @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>

       @endforeach

    </ul>

  </div>

@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Nombre:</strong>

            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Username:</strong>

            {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Contraseña:</strong>

            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Confirmar contraseña:</strong>

            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Rol:</strong>

            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Enviar</button>

    </div>

</div>

{!! Form::close() !!}


@endsection -->
