
<div class="h-100 card">
    <div class="card__content {{(!$room->published) ? 'unpublished' : null}} {{($room->sponsorship && \App\Sponsorship::IsActiveSponsorship($room->id))? 'sponsorized' : null}}">
        @if(isset($med_visits))
        <div class="alert-sponsorship">
            Solo {{$med_visits}} {{($med_visits == 1) ? 'visita' : 'visite'}} al mese
        </div>
        @endif
        <div class="card__header">
            <div class="card__img">
                <a href="{{route('rooms.show', $room->id)}}" {{(Route::currentRouteName() === 'rooms.search') ? 'target="_blank"' : null}}  style="background-image: url('/storage/images/{{$room->cover}}')">
                <img class="card-img-top img-fluid" src="/storage/images/{{$room->cover}}"  alt="Card image cap"></a>
            </div>
        </div>
        <div class="card__body">
            <div class="pull-icons">
            <p class="text-left" style=""><i class="far fa-check-circle" style="color:#15707c;font-size:18px;"> </i> {{$room->service_id}} &nbsp; &nbsp;<i class="fas fa-bed" style="color:#15707c;font-size:18px;"></i> Posti Letto:  {{$room->n_beds}} &nbsp; </p>
            </div>
            <div class="card-title">
                <a href="{{route('rooms.show', $room->id)}}" {{(Route::currentRouteName() === 'rooms.search') ? 'target="_blank"' : null}} ><h3 style="font-size:20px;" class="mt-0 mb-1 text-center" style="">{{$room->title}}</h3></a>
            </div>
            <div class="card__info">
                <p style="text-align:center" class="card__price"><strong>{{$room->price}} € </strong>a persona</p>
                @if(!empty(Auth::user()))
                    @if($room->user->id !== Auth::user()->id)
                    <p class="card__user">{{$room->user->name}}</p>
                     @endif
                @endif
            </div>
        </div>
    </div>
    {{--Bottoni utente autenticato--}}
        @if(!empty(Auth::user()) && $room->user->id === Auth::user()->id && empty($med_visits))
            <div class="card__edit-buttons">
                <div class="pull-icons">
                    @if($room->published && \App\Sponsorship::IsActiveSponsorship($room->id) === false)
                    <a href="{{ route('sponsorships.index', $room->id) }}" class="btn btn-sponsor"><i class="fas fa-certificate" title="Sponsorizza"></i></a>
                    @endif
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-default {{(!$room->published) ? 'unpublished' : null}}"><i class="fas fa-eye" title="Visualizza"></i></a>
                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-default"><i class="fas fa-pen" title="Modifica"></i></a>
                    <a href="{{ route('rooms.statistics', $room->id) }}" class="btn btn-default"><i class="fas fa-chart-bar" title="Statistiche"></i></a>
                    <a href="{{ route('messages.index', $room->user->id) }}" class="btn btn-default"><i class="fas fa-envelope" title="Messaggi"></i></a>
                </div>
                <div class="pull-icons">
                <form action="{{route('rooms.destroy', $room->id)}}" method="post" class="btn-trash">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"> </i> Elimina</button>
                            
                </form>
            </div>
            </div>
        @endif
        @if(!empty(Auth::user()) && !empty($med_visits) && $room->published && \App\Sponsorship::IsActiveSponsorship($room->id) === false)
        <div class="card__edit-buttons justify-content-center">
            <div class="pull-icons">
                <a href="{{ route('sponsorships.index', $room->id) }}" class="btn btn-sponsor"><i class="fas fa-certificate" title="Sponsorizza"></i> Sponsorizzalo ora!</a>
            </div>
        </div>
        @endif
    {{--/Bottoni utente autenticato--}}
</div>
