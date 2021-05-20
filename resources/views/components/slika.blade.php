@props(['naslov','slika'])
<div class="md:w-1/2 p-4 mb-8 md:mb-0 relative  ">
<img class="rounded shadow-md" src="{{$slika}}" alt="">
<div class="absolute bottom-0 right-4 left-4 bg-transparent overflow-hidden
 hover:bg-black hover:bg-opacity-70 text-transparent hover:text-gray-300 mb-4  p-4">
      <h3 class="text-xl font-semibold ">{{$naslov}}</h3>
   
  </div>

</div>


