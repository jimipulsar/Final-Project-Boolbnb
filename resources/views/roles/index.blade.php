@extends('layouts.app')

@section('content')

<div class="contenitore3">
    <div class="col-sm-12">
            <h2>Ruoli</h2>
        @can('role-create')
          <a class="btn btn-success" href="{{ route('roles.create') }}"> Crea nuovo ruolo</a>
          @endcan
          <hr>
        

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
  <div class="col-sm-12">
<table class="table table-striped">
  <tr>
     <th>ID</th>
     <th>Nome</th>
     <th>Permessi</th>
     <th  class="text-center" style="width:400px;">Azioni</th>
  </tr>
    @foreach ($roles as $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>{{ $role->name }}</td>
        <!-- @foreach($permission as $value)

            <td>{{ $value->name }}</td>


        @endforeach -->

        <td>
          <form action="{{ route('roles.destroy' ,$role->id) }}" method="post" class="text-right">

          <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-eye"></i></a>

          <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fas fa-edit"></i></a>
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

</div>


@endsection
