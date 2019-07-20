@extends('layouts.app')

@section('content')
<div class="contenitore3">
    <div class="col-sm-12">
          <h2>Utenti</h2>
          <a class="btn btn-success" href="{{ route('users.create') }}"> Crea nuovo utente</a>
          <hr>
    </div>
      @if ($message = Session::get('success'))
      <div class="alert alert-success">
        <p>{{ $message }}</p>
      </div>
      @endif
    <div class="col-sm-12">
      <table class="table table-striped">
       <tr>
         <th>ID</th>
         <th>Nome</th>
         <th>Cognome</th>
         <th>Email</th>
         <th>Ruolo</th>
         <th width="280px" class="text-center">Azioni</th>
       </tr>

       @foreach ($data as $key => $user)
        <tr>
          <td>{{ ++$i }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->surname }}</td>
          <td>{{ $user->email }}</td>

            <td>@if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
                 <label class="badge badge-success">{{ $v }}</label>
              @endforeach
            @endif
          </td>
          <td>
            <form action="{{ route('users.destroy' ,$user->id) }}" method="post" class="text-center">

            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"><i class="fas fa-eye"></i></a>

            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="fas fa-edit"></i></a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>
       @endforeach
      </table>
    </div>
</div>
@endsection
