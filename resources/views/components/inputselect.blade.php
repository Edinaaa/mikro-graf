
<div {{ $attributes->merge(['class' => 'grid grid-cols-1']) }}>
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">{{$label}}</label>
      <label class="border-4 border-solid w-full h-28  border-primary-200">
      <img id="slika"  class="h-24 w-full pl-1 pt-1" src="{{asset('icona/1.png')}}"/>
      </label>

</div>
<script>

      function slika(){

            var sl="{{asset('icona/1.png')}}";

            if({{$value}}==9){sl="{{asset('icona/9.png')}}";}
            else if({{$value}}==2){sl="{{asset('icona/2.png')}}";}
            else if({{$value}}==3){sl="{{asset('icona/3.png')}}";}
            else if({{$value}}==4){sl="{{asset('icona/4.png')}}";}
            else if({{$value}}==5){sl="{{asset('icona/5.png')}}";}
            else if({{$value}}==6){sl="{{asset('icona/6.png')}}";}
            else if({{$value}}==7){sl="{{asset('icona/7.png')}}";}
            else if({{$value}}==8){sl="{{asset('icona/8.png')}}";}

            var img=document.getElementById("slika").src=sl;

      }
slika();
</script>
