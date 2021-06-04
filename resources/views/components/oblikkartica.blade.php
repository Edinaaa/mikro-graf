@props(['oblik'=>$oblik])
<div   class="w-11/12 md:w-9/12 lg:w-1/2 bg-gray-100  flex justify-center items-center m-2 rounded-md overflow-hidden">

  <img class="flex flex-col  justify-between w-1/2 
      shadow-md  object-cover object-center p-4"
      src="{{asset('images/'.$oblik->image->name)}}"
     />
    
      <div class="flex  w-1/2   text-gray-700 p-4 ">
      <div class="flex sm:flex-row flex-col  justify-between w-full">
      <p class=" text-base sx:text-xl   ">Naziv: {{$oblik->naziv}}</p>
      {{$slot}}
   
      </div>
     
      </div>


</div>