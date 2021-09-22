@props(['slika'=>$slika])
<div class=" border-gray-400 border-solid border-2 w-11/12 bg-gray-50 relative flex justify-center items-start m-2 rounded-md overflow-hidden">

    <a data-lightbox="roadtrip"  class=" h-56 w-full "
      href="{{asset('slike/'.$slika->image->name)}}"><img class=" h-full w-full  object-cover"  src="{{asset('thumb/'.$slika->image->name)}}"/></a>
    
      <div  class="flex flex-col  w-full absolute bottom-0  shadow-md bg-opacity-50 bg-black text-gray-200 p-4 ">
        <div class="flex justify-between w-full">
        <h3 class="text-xl  font-bold pb-2">{{$slika->name}}</h3>
        <div class="flex flex-row items-center">
            @can('delete',$slika)
              <form action="{{route('galerija.destroy', $slika)}}" method="post" class="mr-1">
                @csrf                                          
                @method('DELETE')
                <button type="submit"  class=" focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Briši</button>
              </form>
            @endcan
            @can('update',$slika)
           
            <a href=" {{route('galerija.show', $slika)}}" class=" focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Izmjeni</a>

            @endcan
        </div>
      
        </div>
     
      </div>
     

</div>
<script>

</script>
      