@extends('layouts.app')

@section('content')
@auth
    

<div class=" absolute top-0 w-full pt-14 flex flex-row justify-between items-start h-screen max-h-screen">

<div id="poruke"   class=" relative sm:w-2/3 w-full pt-14   flex flex-col h-full  bg-gray-200    ">
     
    
        @isset($odabraniRazgovor)
            <div   class="  absolute top-0 w-full flex flex-row justify-between items-center p-4 min-h-1/12 bg-primary-300">
                @if($odabraniRazgovor->posiljaoc_id==null)
                    <h3 class="text-gray-900 ">{{$odabraniRazgovor->email}}</h3>
                @elseif ($odabraniRazgovor->posiljaoc_id==auth()->id())
                    <h3 class="text-gray-900 ">{{$odabraniRazgovor->primaoc->name}} {{$odabraniRazgovor->primaoc->lastname}}</h3>
                @else
                    <h3 class="text-gray-900 ">{{$odabraniRazgovor->posiljaoc->name}} {{$odabraniRazgovor->posiljaoc->lastname}}</h3>
                @endif

                <h3 class="text-gray-700 uppercase truncate">{{$odabraniRazgovor->tema}}</h3>
               <div class="flex flex-row justify-end">
               <a href="{{route('poruke')}}"  class='flex justify-center items-center bg-primary-400 hover:bg-primary-500  
                        mx-2 h-8 w-8 rounded-full focus:outline-none '>
                        <img  class="h-6  " src="{{asset('icona/baseline_add_white_24pt_1x.png')}}"/>
                    </a>
               <div class="sm:hidden">
                    <button id="OtvoriRazgovor" onClick="toggleRazgovor()" class='flex justify-center items-center bg-primary-400 hover:bg-primary-500  
                        mx-2 h-8 w-8 rounded-full focus:outline-none '>
                        <img  class="h-6  " src="{{asset('icona/outline_arrow_forward_ios_white_24dp.png')}}"/>
                    </button>
                  </div>
               </div>
               
               
            </div>
                <div class="absolute bottom-14  top-14 pb-1  flex  flex-col items-end w-full">
                    <div class=" w-full flex flex-col   h-full bg-gray-100 ">

                        @if ($odabraniRazgovor->poruke->count())
                            <div class=" w-full  h-full  flex-grow  overflow-y-auto ">
                                        @foreach($odabraniRazgovor->poruke as $poruka)
                                        <x-poruka :poruka="$poruka"></x-poruka>

                                        @endforeach
                            </div> 
                                                    
                            
                        @else
                                <p>Nema poruka.</p>
                        @endif 
                    </div>
                </div>
                <div class="absolute bottom-0  flex  flex-col items-end w-full">
                
                    <div class="w-full">
                    <form name="porukafrm" onsubmit="return validatePorukaForm('porukafrm')" action="{{ route('poruka') }}"  method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="errorsadrzaj" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                
                        </div>
                        <div class="  w-full flex flex-row justify-between items-center bg-white 
                            border-2 border-solid border-primary-200 hover:border-primary-300">
                            <x-input  id="posiljaoc_id" label="" value="{{auth()->id()}}" class="hidden"></x-input>
                            <x-input  id="razgovor_id" label="" value="{{$odabraniRazgovor->id}}" class="hidden"></x-input>

                                <textarea id="sadrzaj" class="px-2 pt-3 w-11/12 bg-primary-50 border-none resize-none focus:outline-none"
                                name="sadržaj" rows="1" placeholder="poruka" ></textarea>

                                <button type="submit" class='flex justify-center items-center bg-primary-300 hover:bg-primary-500  shadow-xl 
                                m-2 h-11  w-11  rounded-full focus:outline-none '>
                                <img  class="h-6  " src="{{asset('icona/outline_send_white_24dp.png')}}"/>

                                </button>
                        </div>
                    </form>
                    </div>
                </div>
                
            
        @endisset
    
       

</div>  

    <div id="razgovori" class="pt-12 sm:pt-0 relative h-full bg-primary-200 hidden w-2/5 sm:flex flex-col flex-grow overflow-x-auto max-h-screen ">
        <div id="divZatvori" class=" absolute top-0 hidden px-3 pb-2  pt-3 min-h-1/12 w-full  bg-primary-300">
            <button id="ZatvoriRazgovor" onClick="toggleRazgovor()" 
            class='hidden justify-center items-center bg-primary-400 hover:bg-primary-500  
            mx-2 h-8 w-8 rounded-full focus:outline-none '>
                <img  class="h-6  " src="{{asset('icona/outline_arrow_back_ios_white_24dp.png')}}"/>
            </button>
        </div>
            @if ($razgovori->count())
                <div class=" w-full h-full min-h-5/12 flex-grow  overflow-y-auto">
                    @foreach($razgovori as $razgovor)
                    <x-razgovor :razgovor="$razgovor" />

                    @endforeach
                </div>
                                
            
            @else
            <div class="p-4">
                <a href="{{route('poruke')}}" class=" w-min bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2">Novi razgovor</a>
             </div>
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
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection