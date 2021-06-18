@props(['razgovor'=>'$razgovor'])

<div class="w-full flex flex-col xs:flex-row justify-start items-start xs:justify-between xs:items-center 
bg-white hover:bg-gray-200 border-primary-300  border-solid  border-2">
<a class="w-full" href="{{route('razgovor',$razgovor->id)}}">
<div class="w-full p-2 uppercase truncate">{{$razgovor->tema}} </div>
<div class="w-full flex flex-row justify-between items-center">
    @if($razgovor->posiljaoc_id==null)
        <h3 class="text-gray-900 ">{{$razgovor->email}}</h3>
    @elseif ($razgovor->posiljaoc_id==auth()->id())
        <h3 class="text-gray-900 ">{{$razgovor->primaoc->name}} {{$razgovor->primaoc->lastname}}</h3>
    @else
        <h3 class="text-gray-900 ">{{$razgovor->posiljaoc->name}} {{$razgovor->posiljaoc->lastname}}</h3>
    @endif
<p class="text-xs text-gray-600 px-4 py-2 xs:px-2 ">{{$razgovor->porukezadnje()->first()->created_at->diffForHumans()}} </p>
</div>
</a>
</div>