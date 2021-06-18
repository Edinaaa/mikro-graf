@props(['oblik'=>$oblik])
<div   class="w-11/12 md:w-9/12 lg:w-1/2 bg-gray-100  flex justify-center items-center m-2 rounded-md overflow-hidden">

@isset($oblik->image)
<img class="flex flex-col  justify-between w-1/2 
      shadow-md  object-cover object-center p-4"
      src="{{asset('images/'.$oblik->image->name)}}"
     />
@endisset
  
    
      <div class="flex  w-1/2   text-gray-700 p-4 ">
      <div class="flex sm:flex-row flex-col  justify-between w-full">
      <div class="flex flex-col  justify-between w-full">
      <p class=" text-base sx:text-xl   ">Naziv: {{$oblik->naziv}}</p>
      
            @if (!$oblik->aktivan)
            <p class=" text-base sx:text-xl   ">Status: Nedostupno </p>

            @else
            <p class=" text-base sx:text-xl   ">Status: Dostupno </p>
            
            @endif
     
      @if ($oblik->visina)
            <p class=" text-base sx:text-xl   ">
            Dimenzije: v{{$oblik->visina}}cm
            s{{$oblik->sirina}}cm
            </p>
      @endif

      </div>
     
      {{$slot}}
   
      </div>
     
      </div>


</div>