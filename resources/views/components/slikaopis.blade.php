@props(['sadrzaj','naslov','slika'])
<div class=" flex-row md:flex items-start bg-gray-100 m-1 ">           
 <div class="flex-1 p-1 m-1  lg:p-4 md:m-4">
        <img class="rounded-lg shadow-md" src="{{$slika}}" alt="">
 </div>
 <div class="flex-1 p-1 m-1 lg:p-4 md:m-4 h-56">
 <p class="text-gray-900 font-semibold text-2xl pl-3">{{$naslov}}</p>
 <hr class=" border-primary-600 border-2 ">
 <p class="text-gray-700   text-lg mt-4 pl-3">
 {{$sadrzaj}}
 
 </p>

 </div>

</div>