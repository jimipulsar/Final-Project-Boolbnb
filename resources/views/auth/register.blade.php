@extends('layouts.app')

@section('content')
<div class="contenitore3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Iscriviti alla nostra piattaforma per inserire il tuo appartamento</div>

                <div class="card-body">
                  @if (count($errors) > 0)
              		<div class="alert alert-danger">
              			<strong>Attenzione!</strong> Ci sono dei problemi con i dati inseriti.<br><br>
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
                  <!-- <form method="POST" action="{{ route('register') }}">
                      @csrf

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Inserisci il tuo nome" required autofocus>

                              @if ($errors->has('name'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-email') }}</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Inserisci il tuo indirizzo e-mail" required>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Inserisci una password" required>

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Conferma la tua password" required>
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Registrati ora') }}
                              </button>
                          </div>
                      </div>
                  </form> -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                      	  <label for="name">Nome</label>
                      	  <input type="text" name="name" class="form-control" required>
                      	</div>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        	<div class="form-group">
                      		<label for="surname">Cognome</label>
                      		<input type="text" name="surname" class="form-control" required>
                      	</div>
                        <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" required>
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
                          <label for="date-input">Data di nascita</label>

                            <input class="form-control" type="date" name="birthdate" value="" >

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Conferma Password</label>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                  Registrati
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
