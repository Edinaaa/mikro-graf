@props(['proizvod'=>'$proizvod'])
<div id="kartica" class="w-5/6 bg-gray-400 relative flex justify-center items-center m-2 rounded-md overflow-hidden">
   <a href="{{route('proizvodi.show', $proizvod)}}">
      <img class="flex flex-col  justify-between w-full h-96 
      shadow-md  object-cover object-center"
      src="{{asset('images/'.$proizvod->image->name)}}"/>
     @if ($proizvod->popust!='0%')
     <div  class="absolute top-0  w-full flex justify-between items-center ml-4 pr-8">
        
        <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Popust</div>
        <div  class="bg-primary-600 w-10 h-12 shadow flex flex-col-reverse pb-4 text-center font-bold text-white rounded-b-full">{{$proizvod->popust}}%</div>

      </div>
     @endif
     @if ($proizvod->novo!="ne")
     <div  class=" absolute top-0 flex justify-between items-center mt-3 ml-4 pr-8">
          <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Novo</div>
        </div>
     @endif
 
  </a>

  <div class=" w-full absolute bottom-0 bg-white bg-opacity-95 shadow-md rounded-l-md flex flex-col  p-4 ">
      <h3 class="text-xl font-bold pb-2">{{$proizvod->naziv}}</h3>
      <p class="truncate text-gray-500 text-sm">Visina {{$proizvod->visina}}, sirina {{$proizvod->sirina}}, font {{$proizvod->font->naziv}},
     materijal {{$proizvod->materijal->naziv}}
     @isset($proizvod->oblik)
        , oblik {{$proizvod->oblik->naziv}}
     @endisset
     .</p>
        <span class="pt-2 text-primary-600 font-semibold text-right  text-lg">Cijena: {{$proizvod->cijena}} KM</span>
     
  </div>

</div>