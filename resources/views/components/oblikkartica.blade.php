@props(['oblik'=>$oblik])
<div   class="w-1/2 bg-gray-100  flex justify-center items-center m-2 rounded-md overflow-hidden">

  <img class="flex flex-col  justify-between w-1/2 
      shadow-md  object-cover object-center p-4"
      src="{{asset('images/'.$oblik->image->name)}}"
     />
    
      <div class="flex flex-col  w-1/2   text-gray-700 p-4 ">
      <div class="flex justify-between w-full">
      <p class="text-xl   ">Naziv: {{$oblik->naziv}}</p>
      {{$slot}}
   
      </div>
     
      </div>


</div>