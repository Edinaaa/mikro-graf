@extends('layouts.app')
@section('title','Stavke')

@section('content')
@auth
<div  class=" min-h-screen w-full bg-gray-200 flex flex-col items-center">

      <div class="py-4 w-full flex flex-col md:flex-row justify-around items-center">
        @isset($narudzba)
          @isset($narudzba->cijena)
              <p class="px-4  text-lg text-primary-600"> Cijena narudžbe: {{$narudzba->cijena}} KM</p>  
          @endisset
        <div  class='flex flex-row h-auto items-center justify-center '>
                  <p class="px-4  text-lg text-gray-800"> Stanje: {{$narudzba->stanje->naziv}}</p>  
              @if (auth()->user()->hasRole('admin'))
              @can('update',$narudzba)
                  
                  <a href=" {{route('narudzba.show', $narudzba)}}"  class=' w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Izmjeni</a>
                   @endcan     
              @endif
        </div>
       
        @endisset
      </div>      
    @if($stavke->count())
            <div class=" w-full bg-gray-200  py-1   place-items-center  grid grid-cols-1 ">
                  @foreach($stavke as $stavka)
        <x-korpaKartica :narudzba="$stavka"></x-korpaKartica>

                  @endforeach
            </div>
                              
            {{$stavke->links()}}<!--paging koristeci tailwind-->
    @else
            <p>Nema stavki.</p>
    @endif

</div>

<script>


</script>
@endauth
   
@endsection

