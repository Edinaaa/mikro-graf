@props(['poruka'=>'$poruka'])
@if (auth()->id()==$poruka->posiljaoc_id)
<div class="w-full grid grid-cols-1 justify-items-start bg-gray-100  p-2">
    <p class="text-xs text-gray-600 px-2">{{$poruka->created_at->diffForHumans()}} </p>
    <div class="rounded-lg rounded-tl-none bg-gray-400">
         <p class="p-4 ">{{$poruka->sadrzaj}}</p>
    </div>
</div>
@else
<div class="w-full grid grid-cols-1 justify-items-end bg-gray-100  p-2">
    <p class="text-xs text-gray-600 px-2">{{$poruka->created_at->diffForHumans()}}</p>
    <div class="rounded-lg rounded-tr-none bg-primary-200">
         <p class="p-4 ">{{$poruka->sadrzaj}}</p>
    </div>
</div>
@endif
