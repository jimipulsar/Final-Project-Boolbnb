<div class="room__main__message__title">
    <div class="row">
        <div class="col-12">
            <h3>Scrivi al proprietario</h3>
        </div>
    </div>
</div>
<div class="room__main__message">
    <form class="form-group needs-validation" action="{{ route('room.message.store') }}" method="post" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" placeholder="Inserisci il nome" required>
            <div class="valid-feedback">
                Campo valido
            </div>
            <div class="invalid-feedback">
                Inserisci il tuo nome per esteso
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            @if(isset(Auth::user()->id))
                <input type="email" name="email" class="form-control" placeholder="Inserisci la email" value="{{ Auth::user()->email }}" required>
            @else
                <input type="email" name="email" class="form-control" placeholder="Inserisci la email" required>
            @endif
            <div class="valid-feedback">
                Campo valido
            </div>
            <div class="invalid-feedback">
                Inserisci una mail valida
            </div>
        </div>
        <div class="form-group">
            <label for="text">Testo</label>
            <textarea class="form-control" name="text" rows="3" placeholder="Inserisci il testo" required></textarea>
            <div class="valid-feedback">
                Campo valido
            </div>
            <div class="invalid-feedback">
                Inserisci un messaggio
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{ $room->user_id }}">
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <div class="form-group">
            <input type="submit" value="Invia" class="form-control">
        </div>
    </form>
</div>