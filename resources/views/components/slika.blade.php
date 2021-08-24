@props(['slika'=>$slika])
<div class=" border-gray-400 border-solid border-2 w-11/12 bg-gray-50 relative flex justify-center items-start m-2 rounded-md overflow-hidden">

  <img class=" h-56"
      src="{{asset('images/'.$slika->image->name)}}"
     />
    
      <div id="{{$slika->id}}" class="flex flex-col  w-full absolute bottom-0  shadow-md bg-opacity-50 bg-black text-gray-200 p-4 ">
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

    function silkahover(id){
      var naziv=document.getElementById(id);

        naziv.classList.remove("text-transparent");
        naziv.classList.remove("bg-transparent");

        naziv.classList.add("text-gray-200");
        naziv.classList.add("bg-black");
        naziv.classList.add("bg-opacity-50");


    }
    function silkahoverout(id){
      var naziv=document.getElementById(id);
     
        naziv.classList.remove("text-gray-200");
        naziv.classList.remove("bg-black");
        naziv.classList.remove("bg-opacity-50");


        naziv.classList.add("text-transparent");
        naziv.classList.add("bg-transparent");

    }
</script>
      