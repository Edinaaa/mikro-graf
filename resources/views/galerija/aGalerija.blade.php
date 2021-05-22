@extends('layouts.admin')

@section('content')
<div> <header class=" bg-gray-900 flex flex-row-reverse sm:justify-between sm:items-center sm:px-4 sm:py-3">
<div class="flex  ">
<button class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0">Dodaj</button>
<button class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0">Brisi</button>

</div>
</header></div>
<div class="container mx-auto px-4">           
    <section class="py-8 px-4">
            <div class="flex flex-wrap -mx-4">

                  <x-aGalerijaItem Naslov="Vjesaloca za kljuceve" 
                        Slika="https://source.unsplash.com/random/1280x720">
                  </x-aGalerijaItem>

                  <x-slika Naslov="Vjesaloca za kljuceve" 
                  Slika="https://source.unsplash.com/random/1280x720">

                  </x-slika>
                  <x-slika Naslov="Vjesaloca za kljuceve" 
                  Slika="https://source.unsplash.com/random/1280x720">

                  </x-slika>
                  <x-slika Naslov="Vjesaloca za kljuceve" 
                  Slika="https://source.unsplash.com/random/1280x720">

                  </x-slika>
                  <x-slika Naslov="Vjesaloca za kljuceve" 
                  Slika="https://source.unsplash.com/random/1280x720">

                  </x-slika>
                  <x-slika Naslov="Vjesaloca za kljuceve" 
                  Slika="https://source.unsplash.com/random/1280x720">

                  </x-slika>
            </div>
    </section>
</div>
@endsection