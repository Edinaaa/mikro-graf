@props(['poruka'=>'$poruka'])
@if (auth()->id()==$poruka->posiljaoc_id)
<div class="w-full grid grid-cols-1 justify-items-end bg-gray-100  p-2">
<div class="flex flex-col  items-end text-xs text-gray-600 px-2">
        @if ($poruka->user)
            <p class="text-gray-800 font-semibold">{{$poruka->user->lastname}} {{$poruka->user->name}}</p> 
        @else 
            <p class="text-gray-800 font-semibold">{{$poruka->email}} </p> 
        @endif
       <p > {{$poruka->created_at->diffForHumans()}}</p>

   </div>
    <div class="rounded-lg rounded-tl-none bg-gray-400">
         <p class="p-4 ">{{$poruka->sadrzaj}}</p>
    </div>
</div>
@else
<div class="w-full grid grid-cols-1 justify-items-start bg-gray-100  p-2">
    <div class="flex flex-col items-start text-xs text-gray-600 px-2">
       
        @if ($poruka->user)
            <p class="text-gray-800 font-semibold">{{$poruka->user->lastname}} {{$poruka->user->name}}</p> 
        @else 
            <p class="text-gray-800 font-semibold">{{$poruka->email}} </p> 
        @endif
        <p > {{$poruka->created_at->diffForHumans()}}</p>

    </div>
    <div class="rounded-lg rounded-tr-none bg-primary-200">
         <p class="p-4 ">{{$poruka->sadrzaj}}</p>
    </div>
</div>
@endif
