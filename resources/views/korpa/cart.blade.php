@extends('layouts.app')

@section('content')

    <div id="div" class="  min-h-screen w-full bg-gray-200 flex flex-col justify-center items-center">
        @if(Session::has('cart'))
            <div class="py-4 w-full flex flex-col md:flex-row  justify-around items-center">
            
                <p class="text-lg text-primary-600"> Ukopna cijena: {{$ukupnoCijena}} KM</p>  
                <p class="text-lg text-gray-800"> Ukuplo proizvoda: {{$ukupnoKolicina}}</p>  
                <div class='flex flex-row items-center justify-center p-5'>
                                <a href="{{ route('korpa.odustani')}}"  class='w-auto bg-white hover:bg-primary-300 rounded-lg shadow-xl font-medium text-primary-600 px-4 py-2 mx-2'>Odustani</a>
                        
                    @guest
                             <a href="{{ route('contactForm')}}"  class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 mx-2'>Naruci</a>
                        
                    @endguest
                    @auth
                        <form method="POST" action="{{ route('narudzba') }}">
                            @csrf
                            
                                <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 mx-2'>Naruci</button>
                            
                        </form>      
                    @endauth
                </div>
      
            </div>  

            @if($ukupnoKolicina)
                    <div class=" w-full bg-gray-200  p-1 place-items-center  grid grid-cols-1 lg:grid-cols-2 ">
                        @foreach($proizvodi as $stavka)
                <x-cartKartica :stavka="$stavka"></x-cartKartica>

                        @endforeach
                    </div>
                                    
            @else
                    <p>Korpa je prazna.</p>
            @endif
        @else
                    <p>Korpa je prazna.</p>
        @endif
    </div>

<script>


</script>
@endsection

