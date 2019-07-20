@extends('layouts.app')

@section('content')
<div class="contenitore3">
    <div class="home">
        <div class="home__main">
            {{-- TITOLO PAGINA --}}
            <div class="home__main__title">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>Benvenuto, {{ Auth::user()->name }}</h4>
                            <hr>
                        </div>
                       
                    </div>
                </div>
            </div>
            {{-- ULTIMI MESSAGGI --}}

            <div class="home__main__last-messages">
            <div class="container">
                    <div class="row">
                        <div class="col-8 d-flex align-items-left">
                            <h4 class="title-blue">Ultimi messaggi</h4>
                        </div>
                        <div class="col-4 text-right d-flex justify-content-end align-items-center">
                            <a href="{{route('messages.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-envelope" title="message"></i> Tutti i messaggi</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Appartamento</th>
                                    <th>Da</th>
                                    <th class="table__td-message">Messaggio</th>
                                    <th>Data</th>
                                    <th>Leggi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($messages as $message)
                                    <tr>
                                        <td>{{ $message->room->title }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td class="table__td-message">{{ str_limit($message->text, 30, '(...)') }}</td>
                                        <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('Admin.messages.show', $message->id) }}" class="btn btn-default"><i class="fas fa-eye"title="Leggi"></i></a>            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"><p>Non ci sono messaggi</p></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            {{-- /ULTIMI MESSAGGI --}}
            @if($sponsorships)
                {{-- APPARTAMENTI SPONSORIZZATI --}}
                <div class="home__main__sponsorized-rooms">
                    <div class="container">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <h2 class="title-blue">Appartamenti sponsorizzati</h2>
                            </div>
                            
                            <div class="col-4 text-right d-flex justify-content-end align-items-center">
                                <a href="{{route('rooms.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-home" title="home"></i> Tutti gli appartamenti</a>
                            </div>
                        </div>
                        {{-- Cards --}}
                        <div class="row">
                            @foreach($sponsorships as $room_sponsorized)
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    @component('components.room.card', ['room' => $room_sponsorized])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        {{-- End Cards --}}
                    </div>
                </div>
                {{-- /APPARTAMENTI SPONSORIZZATI --}}
                {{-- APPARTAMENTI MENO VISITATI --}}
            @else
                <div class="home__main__sponsorized-rooms">
                    <div class="container">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <h2 class="title-blue">Appartamenti meno visitati</h2>
                            </div>
                            <div class="col-4 text-right d-flex justify-content-end align-items-center">
                                <a href="{{route('rooms.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-home" title="home"></i> Tutti gli appartamenti</a>
                            </div>
                        </div>
                        {{-- Cards --}}
                        <div class="row">
                            @foreach($suggestion_sponsorships as $room_to_sponsor)
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    @component('components.room.card', ['room' => $room_to_sponsor['room'], 'med_visits' => $room_to_sponsor['med_visits']])
                                    @endcomponent
                                </div>
                                @endforeach
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="card sponsor-adv">
                                        <div class="card__content">
                                            <i class="fas fa-certificate"></i>
                                            <h1>Sponsorizza</h1>
                                            <h2>Ottieni più visite con soli</h2>
                                            <ul>
                                                <li>2,99 € per 24 ore</li>
                                                <li>5.99 € per 72 ore</li>
                                                <li>9.99 € per 144 ore</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        {{-- End Cards --}}
                    </div>
                </div>
                {{-- /APPARTAMENTI MENO VISITATI --}}
            @endif
            {{-- ULTIMI APPARTAMENTI --}}
            <div class="home__main__last-rooms mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <h2 class="title-blue">Ultimi Appartamenti</h2>
                        </div>
                        <div class="col-4 text-right d-flex justify-content-end align-items-center">
                            <a href="{{route('rooms.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-home" title="home"></i> Tutti gli appartamenti</a>
                        </div>
                    </div>
                        {{-- Cards --}}
                        <div class="row">
                            @foreach($rooms as $room)
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    @component('components.room.card', ['room' => $room])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        {{-- End Cards --}}
                </div>
            </div>
        </div>
        </div>
@endsection
