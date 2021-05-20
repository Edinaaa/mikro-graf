@props(['naslov','sadrzaj','popust', 'cijena','slika','novo'])
<div id="kartica" class="w-5/6 bg-gray-400 relative flex justify-center items-center m-2 rounded-md overflow-hidden">

  <a class="flex flex-col justify-between w-5/6 sm:w-96 h-96 bg-white bg-center 
      text-gray-800 shadow-md  cursor-pointer"
      style="background-image:url({{$slika}})"
      href="{{route('narudzba')}}">
      @isset($popust)
      <div  class="flex justify-between items-center ml-4 pr-8">
        
          <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Popust</div>
          <div id="procenat" class="bg-primary-600 w-10 h-12 shadow flex flex-col-reverse pb-4 text-center font-bold text-white rounded-b-full">{{$popust}}%</div>

        </div>
      @endisset

      @isset($novo)
      <div  class="flex justify-between items-center mt-3 ml-4 pr-8">
          <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Novo</div>
        </div>
      @endisset
 
  </a>

  <div class=" w-full absolute bottom-0 bg-white bg-opacity-95 shadow-md rounded-l-xl flex flex-col  p-4 mb-8">
      <h3 class="text-xl font-bold pb-2">{{$naslov}}</h3>
      <p class="truncate text-gray-500 text-sm">{{$sadrzaj}}</p>
        <span class="pt-2 text-primary-600 font-semibold text-right  text-lg">Cijena: {{$cijena}}KM</span>
     
  </div>

</div>