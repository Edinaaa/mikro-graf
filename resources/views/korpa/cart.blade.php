@extends('layouts.app')

@section('content')

    <div id="div" class=" pl-14 min-h-screen w-full bg-gray-200 flex flex-col justify-center items-center">
        @if(Session::has('cart'))
            <div class="py-4 w-full flex flex-row justify-around items-center">
            
                <p class="text-lg text-primary-600"> Ukopna cijena: {{$ukupnoCijena}} KM</p>  
                <p class="text-lg text-gray-800"> Ukuplo proizvoda: {{$ukupnoKolicina}}</p>  
              
              @guest
              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <a href="#" onClick="Show('BOguest', 'MPguest', 'Mguest')" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</a>
                    </div>
                    @endguest
                    @auth
                  <form method="POST" action="{{ route('korpa.store') }}">
                    @csrf
                    
                   
                    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</button>
                    </div>
                </form>      
                    @endauth
   
      <x-emailITelefon  idBO="BOguest" idMP="MPguest" idM="Mguest"/>
      
            </div>      
            @if($ukupnoKolicina)
                    <div class=" w-full bg-gray-200  py-1 place-items-center  grid grid-cols-1 lg:grid-cols-2 ">
                        @foreach($proizvodi as $stavka)
                <x-cartKartica :stavka="$stavka"></x-cartKartica>

                        @endforeach
                    </div>
                                    
            @else
                    <p>Korpa je prazna.</p>
            @endif
        @endif
    </div>

<script>


</script>
@endsection

