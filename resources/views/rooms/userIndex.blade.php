@extends('layouts.app')
@section('content')
    <div class="rooms">
        <div class="rooms__main">
            {{--Title--}}
            <div class="rooms__main__title">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>I tuoi appartamenti</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{--/Title--}}
            {{-- Button aggiungi appartamento --}}
            <div class="rooms__main__button">
              <div class="row">
                  <div class="col-4 offset-8">
                      <a href="{{ route('room.create') }}" class="btn btn-default"><i class="fas fa-plus"></i>AGGIUNGI UN APPARTAMENTO</a>
                  </div>
              </div>
            </div>
            {{-- /Button aggiungi appartamento --}}
            <div class="rooms__main__content mt-5">
                <div class="container">
                    {{-- Cards --}}
                    <div class="row">
                        @forelse ($rooms as $room)
                            <div class="col-lg-4 col-sm-6 mb-4">
                                @component('components.room.card', ['room' => $room])
                                @endcomponent
                            </div>
                        @empty
                            <h2>Non hai appartamenti</h2>
                        @endforelse
                    </div>
                    {{-- End Cards --}}
                </div>
            </div>
        </div>
    </div>
@endsection
