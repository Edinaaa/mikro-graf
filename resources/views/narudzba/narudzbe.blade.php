@extends('layouts.app')

@section('content')

    <div id="div" class="min-h-screen w-full bg-gray-200 flex flex-col items-center">
            
    @if($narudzbe->count())
            <div class=" w-full sm:w-2/3 bg-gray-200  py-1 place-items-center  grid grid-cols-1 lg:grid-cols-2 ">
                  @foreach($narudzbe as $narudzba)
        <x-narudzbeKartica :narudzba="$narudzba" :stavke="$stavke"></x-narudzbeKartica>

                  @endforeach
            </div>
                              
            {{$narudzbe->links()}}<!--paging koristeci tailwind-->
      @else
            <p>Nema narudžbi.</p>
      @endif

    </div>

<script>


</script>
@endsection

