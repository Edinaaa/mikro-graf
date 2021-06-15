@extends('layouts.app')

@section('content')
@auth
<div  class=" pl-14 min-h-screen w-full bg-gray-200 flex flex-col justify-center items-center">
<div id="div" class="py-4 w-full flex flex-col md:flex-row justify-around items-start md:items-center">
 
      </div>
      <div class="py-4 w-full flex flex-col md:flex-row justify-around items-start md:items-center">
        @isset($narudzba)
          @isset($narudzba->cijena)
              <p class="px-4  text-lg text-primary-600"> Cijena narudzbe: {{$narudzba->cijena}} KM</p>  
          @endisset
        <div  class='flex flex-row h-auto items-center justify-center '>
                  <p class="px-4  text-lg text-gray-800"> Stanje: {{$narudzba->stanje->naziv}}</p>  
              @if (auth()->user()->hasRole('admin'))
                      <a  href="#" onClick="Show('BOizmjena', 'MPizmjena', 'Mizmjena')" class=' w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Izmjeni</a>
                        @if ($stanja->count())
                                <x-modalIzmajenaNarudzba :stanja="$stanja" idnarudzbe="{{$narudzba->id}}" idBO="BOizmjena" idMP="MPizmjena" idM="Mizmjena"/>
                        @endif
              @endif
        </div>
       
        @endisset
      </div>      
    @if($korpa->count())
            <div class=" w-full bg-gray-200  py-1  grid grid-cols-1 lg:grid-cols-2 ">
                  @foreach($korpa as $stavka)
        <x-korpaKartica :narudzba="$stavka"></x-korpaKartica>

                  @endforeach
            </div>
                              
            {{$korpa->links()}}<!--paging koristeci tailwind-->
    @else
            <p>Korpa je prazna.</p>
    @endif

</div>

<script>


</script>
@endauth
   
@endsection
