@props(['type'=>'text','id','label', 'value'=>'','checked'=>''])
<div 
{{ $attributes->merge(['class' => 'grid grid-cols-1']) }}>
      <label for="{{$id}}" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">{{$label}}</label>
     @if ($checked)
     <input class="py-2 px-3 rounded-lg border-2 border-primary-200 mt-1
       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent"
       checked type="{{$type}}" name="{{$id}}" id="{{$id}}" value="{{$value}}" placeholder="{{$label}}" />
     @else
     <input class="py-2 px-3 rounded-lg border-2 border-primary-200 mt-1
       focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent"
       type="{{$type}}" name="{{$id}}" id="{{$id}}" value="{{$value}}" placeholder="{{$label}}" />
  
     @endif
     {{$slot}}
</div>