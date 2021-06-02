@extends('layouts.app')

@section('content')

    <div id="div" class="min-h-screen w-full bg-gray-200 flex justify-center items-center">
            
    @if($narudzbe->count())
            <div class=" w-full bg-gray-400 pl-14 py-1  grid grid-cols-1 lg:grid-cols-2 ">
                  @foreach($narudzbe as $narudzba)
        <x-narudzbeKartica :narudzba="$narudzba"></x-narudzbeKartica>

                  @endforeach
            </div>
                              
            {{$narudzbe->links()}}<!--paging koristeci tailwind-->
      @else
            <p>Nema narudzbi.</p>
      @endif

    </div>

<script>


</script>
@endsection

