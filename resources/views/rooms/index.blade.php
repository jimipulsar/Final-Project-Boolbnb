@extends('layouts.app')
@section('content')
  {{-- Sponsorized Apartments --}}
    @isset($sponsorships)
        <div class="sponsorships">
        <h1 class="title-blue" style="width:100% !important; border-radius:0px !important; font-size:26px; background:linear-gradient(141deg, #002f3c 0%, #0e5a76 51%, #107e8e 75%);">Appartamenti in evidenza</h1>
            <div class="sponsorships___main">
                <div class="sponsorships__main__title">
                    <div class="container">
                    
                        <div class="row">
                            <div class="col-12">
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sponsorships__main__content mt-5">
                    <div class="container">
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
            </div>
        </div>
    @endisset
  {{-- END Sponsorized Apartments --}}
@endsection
