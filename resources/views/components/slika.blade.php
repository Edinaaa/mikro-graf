@props(['slika'=>$slika])
<div  onMouseover="silkahover('{{$slika->id}}')" onMouseout="silkahoverout('{{$slika->id}}')" class="w-11/12 bg-gray-400 relative flex justify-center items-center m-2 rounded-md overflow-hidden">
<a href="#">
  <img class="flex flex-col  justify-between w-full h-96 
      shadow-md  object-cover object-center"
      src="{{asset('images/'.$slika->image->name)}}"
     />
    
      <div id="{{$slika->id}}" class="flex flex-col  w-full absolute bottom-0 bg-transparent text-transparent shadow-md   p-4 ">
      <div class="flex justify-between w-full">
      <h3 class="text-xl  font-bold pb-2">{{$slika->name}}</h3>
      <div class="flex flex-row">
          @can('delete',$slika)
            <form action="{{route('galerija.destroy', $slika)}}" method="post" class="mr-1">
              @csrf                                          
              @method('DELETE')
              <button type="submit"  class=" focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Brisi</button>
            </form>
          @endcan
          @can('update',$slika)
              
             <button onClick="Show('BO{{$slika->id}}', 'MP{{$slika->id}}', 'M{{$slika->id}}')" class=" focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Izmjeni</button>

          @endcan
      </div>
      <x-modalFrmGalerija :galerija="$slika" idBO="BO{{$slika->id}}" idMP="MP{{$slika->id}}" idM="M{{$slika->id}}" />
     
      </div>
     
      </div>
      </a>

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
      