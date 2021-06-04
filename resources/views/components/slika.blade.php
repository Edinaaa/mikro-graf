@props(['slika'=>$slika])
<div id="kartica"  class="w-11/12 bg-gray-400 relative flex justify-center items-center m-2 rounded-md overflow-hidden">

  <img class="flex flex-col  justify-between w-full h-96 
      shadow-md  object-cover object-center"
      src="{{asset('images/'.$slika->image->name)}}"
     />
    
      <div class="flex flex-col  w-full absolute bottom-0 bg-transparent text-transparent 
      hover:text-gray-200 hover:bg-black hover:bg-opacity-50 shadow-md   p-4 ">
      <div class="flex justify-between w-full">
      <h3 class="text-xl  font-bold pb-2">{{$slika->name}}</h3>

      @can('delete',$slika)
        <form action="{{route('galerija.destroy', $slika)}}" method="post" class="mr-1">
          @csrf                                          
          @method('DELETE')
          <button type="submit"  class=" focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Brisi</button>
        </form>
     @endcan
      </div>
     
      </div>


</div>

      