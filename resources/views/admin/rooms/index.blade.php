@extends('layouts.app')
@section('content')
  <div class="rooms">
    <div class="rooms__main">
      {{--Title--}}
      <div class="rooms__main__title">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1>Appartamenti di tutti gli utenti</h1>
            </div>
          </div>
        </div>
      </div>
      {{--/Title--}}
    </div>
    <div class="rooms__main__table mt-5">
      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th>Dati</th>
              <th>Visualizza</th>
              <th>Modifica</th>
              <th>Elimina</th>
            </tr>
          </thead>
          <tbody>
          @forelse ($rooms as $room)
            <tr  class="{{(!$room->published) ? 'unpublished' : null}}">
              <td>
                <h2>{{ $room->title }}</h2>
                <p>{{ $room->street}} {{ $room->house_number}}, {{ $room->locality}}, {{ $room->postal_code}}, {{ $room->state }}</p>
                <p>Prezzo: {{ $room->price }}€</p>
              </td>
              <td>
                <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-default"><i class="fas fa-eye" title="Visualizza"></i></a>
              </td>
              @if($room->published)
                <td>
                  <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-default"><i class="fas fa-pen" title="Modifica"></i></a>
                </td>
              @endif
              @if(!$room->published)
                <td>
                  <a href="{{ route('Admin.rooms.edit', $room->id) }}" class="btn btn-default unpublished"><i class="fas fa-pen" title="Modifica"></i></a>
                </td>
              @endif
              <td>
                <form action="{{route('Admin.rooms.destroy', $room->id)}}" method="post" class="btn-trash">
                  @csrf
                  @method('DELETE')
                  <input class="btn-trash__input btn" type="submit" value="Elimina">
                  <i class="fas fa-trash" title="Elimina"></i>
                </form>
              </td>
            </tr>
          @empty
            <h2>Non hai appartamenti</h2>
          @endforelse
          </tbody>
        </table>
        {{ $rooms->links() }}
      </div>
    </div>
@endsection
