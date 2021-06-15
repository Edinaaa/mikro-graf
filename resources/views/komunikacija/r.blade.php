@extends('layouts.app')

@section('content')
<div class=" absolute top-0 w-full pt-14 flex flex-row justify-between items-start h-screen max-h-screen">
@auth

<div id="poruke"   class=" relative sm:w-2/3 w-full    flex flex-col h-full  bg-gray-200    ">
         @if (auth()->user()->hasRole('admin'))
    <div  class=" pl-14 ">
        @else
        <div>
        @endif
    
        @isset($odabraniRazgovor)
            <div   class=" absolute top-0 w-full flex flex-row justify-between items-center p-4 min-h-1/12 bg-primary-300">
                @if ($odabraniRazgovor->posiljaoc_id!=auth()->id())
                <h3 class="text-gray-900 ">{{$odabraniRazgovor->posiljaoc->name}} {{$odabraniRazgovor->posiljaoc->lastname}}</h3>

                @else
                <h3 class="text-gray-900 ">{{$odabraniRazgovor->primaoc->name}} {{$odabraniRazgovor->primaoc->lastname}}</h3>

                @endif

                <h3 class="text-gray-700 uppercase">{{$odabraniRazgovor->tema}}</h3>
                <div class="sm:hidden">
                    <button id="OtvoriRazgovor" onClick="toggleRazgovor()" class='flex justify-center items-center bg-primary-300 hover:bg-primary-500  
                        mx-2 h-8 w-8 rounded-full focus:outline-none '>
                        <img  class="h-6  " src="{{asset('icona/outline_arrow_forward_ios_white_24dp.png')}}"/>
                    </button>
                  </div>
               
            </div>
                <div class="absolute bottom-0 top-14  flex  flex-col items-end w-full">
                    <div class=" w-full flex flex-col h-full bg-gray-100 ">

                        @if ($odabraniRazgovor->poruke->count())
                        <div class=" w-full h-full min-h-5/12 flex-grow  overflow-y-auto ">
                                    @foreach($odabraniRazgovor->poruke as $poruka)
                                    <x-poruka :poruka="$poruka"></x-poruka>

                                    @endforeach
                        </div> 
                                                
                            
                        @else
                                <p>Nema poruka.</p>
                        @endif 
                    </div>
                    <div class="w-full">
                    <form action="{{ route('poruka') }}"  method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="  w-full flex flex-row justify-between items-center bg-white 
                            border-2 border-solid border-primary-200 hover:border-primary-300">
                            <x-input  id="posiljaoc_id" label="" value="auth()->id()" class="hidden"></x-input>
                            <x-input  id="razgovor_id" label="" value="{{$odabraniRazgovor->id}}" class="hidden"></x-input>

                                <textarea id="sadrzaj" class="px-2 pt-3 w-11/12 bg-primary-50 border-none resize-none focus:outline-none"
                                name="sadrzaj" rows="1" placeholder="poruka" ></textarea>

                                <button type="submit" class='flex justify-center items-center bg-primary-300 hover:bg-primary-500  shadow-xl 
                                mx-2 h-9 w-9 xs:h-11  xs:w-11  rounded-full focus:outline-none '>
                                <img  class="h-6  " src="{{asset('icona/outline_send_white_24dp.png')}}"/>

                                </button>
                        </div>
                    </form>
                    </div>
                </div>
                
            
        @endisset
    </div> 
       

</div>  
<div id="divZatvori" class="hidden w-1/12 h-full bg-primary-300">
    <button id="ZatvoriRazgovor" onClick="toggleRazgovor()" class='hidden justify-center items-center bg-primary-300 hover:bg-primary-500  
    mx-2 h-8 w-8 rounded-full focus:outline-none '>
        <img  class="h-6  " src="{{asset('icona/outline_arrow_back_ios_white_24dp.png')}}"/>
    </button>
</div>
    <div id="razgovori" class="h-full bg-primary-200 hidden w-2/5 sm:flex flex-col flex-grow overflow-x-auto max-h-screen ">
            @if ($razgovori->count())
                <div class="w-full ">
                    @foreach($razgovori as $razgovor)
                    <x-razgovor :razgovor="$razgovor"/>

                    @endforeach
                </div>
                                
            
            @else
                <p>Nema razgovora.</p>
            @endif  
    </div>
         
@endauth

</div>
<script>
     function toggleRazgovor(){
        var otvori=document.getElementById("OtvoriRazgovor");
        var zatvori=document.getElementById("ZatvoriRazgovor");
        var razgovori=document.getElementById("razgovori");
        var poruke=document.getElementById("poruke");
        var divZatvori=document.getElementById("divZatvori");

       
         if (otvori.classList.contains("flex"))
          {
    
            zatvori.classList.remove('hidden');
            zatvori.classList.add('flex');

            divZatvori.classList.remove('hidden');
            divZatvori.classList.add('flex');

            razgovori.classList.remove('hidden');
            razgovori.classList.add('flex');


            poruke.classList.add('hidden');
        
            otvori.classList.add('hidden');
            otvori.classList.remove('flex');


    
          }
         else{
            zatvori.classList.remove('flex');
            zatvori.classList.add('hidden');


            divZatvori.classList.remove('flex');
            divZatvori.classList.add('hidden');

            poruke.classList.remove('hidden');

            razgovori.classList.add('hidden');
            razgovori.classList.remove('felx');
           
            otvori.classList.remove('hidden');
            otvori.classList.add('flex');
          }
     }
</script>
@endsection