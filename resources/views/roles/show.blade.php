@extends('layouts.app')


@section('content')
<div class="contenitore3">
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> Mostra Ruolo</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Indietro</a>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Nome:</strong>

            {{ $role->name }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="card">

            <strong>Permessi:</strong>
            <div class="col-sm-12">
            @if(!empty($rolePermissions))

                @foreach($rolePermissions as $v)

                    <label class="label label-success">{{ $v->name }},</label>

                @endforeach

            @endif

        </div>
        </div>
    </div>

</div>
</div>
@endsection
