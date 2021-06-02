@extends('layouts.app')

@section('content')
<div class="w-full h-full flex flex-col justify-items-center items-center py-10">
    <div class="relative h-1/2 flex w-11/12 sm:w-2/3  flex-col md:w-11/12 md:flex-row bg-white rounded-lg items-center justify-center overflow-hidden ">
    
        <div class="flex w-full  md:w-2/3 justify-center items-center ">
            <img src="{{ asset('images/'.$proizvod->image->name)}}"
            class="w-full h-96   object-cover object-center "/>  

        </div>
        <div class="flex flex-col md:w-1/3 justify-center items-center w-full p-4">
            <div class="flex md:flex-col-reverse md:items-start md:justify-items-start  w-full justify-between items-center pt-2">
                
            <h3 class="text-xl font-bold ">{{$proizvod->naziv}}</h3>
            @if ($proizvod->novo!='ne')
                
                <p class=" text-white text-base  px-2 bg-primary-500 rounded-lg">novo</p>

            @endif
            </div>
            <div class="flex  w-full justify-between items-center pt-2">

                <p class=" text-gray-700 text-lg">Visina {{$proizvod->visina}}, sirina {{$proizvod->sirina}}, font {{$proizvod->font->naziv}},
                @isset($proizvod->oblik)
                    oblik {{$proizvod->oblik->naziv}},
                @endisset
                materijal {{$proizvod->materijal->naziv}}.</p>
            </div>
            <div class="flex flex-row-reverse md:justify-items-start md:items-start  md:flex-col lg:flex-row-reverse  w-full justify-between items-center pt-2">
                <p class=" text-primary-600 font-semibold text-right  text-lg">Cijena: {{$proizvod->cijena}} KM</p>
                
                @if ($proizvod->popust!='0%')
                
                    <p class="text-primary-600  font-bold text-lg ">Popust {{$proizvod->popust}}%</p>

                @endif
                

            </div>
        </div>

    <div class="absolute top-0 right-0 p-4">
                    @guest
                    <button onClick="fomraToggle()" class="bg-primary-500 text-white rounded-lg py-1 px-2" >Naruci</button>
                        
                    @endguest
                    @auth
                        <form action="{{route('narudzba.proizvod',$proizvod)}}" method="post" enctype="multipart/form-data">
                             @csrf

                            <button type="submit" class="bg-primary-500 text-white rounded-lg py-1 px-2" >Naruci</button>
                        </form>
                        
                    @endauth
    </div>

    </div>  

    <div id="forma" class="hidden mt-10 pt-5  w-11/12 sm:w-2/3   md:w-11/12  bg-white rounded-lg items-center justify-center overflow-hidden ">
        <form action="{{route('narudzba.proizvod',$proizvod)}}" method="post" enctype="multipart/form-data">
            @csrf
            @guest
                <label class="my-5  uppercase md:text-sm text-lg text-gray-500 text-light font-semibold">Unesite vase kontakt podatke</label>

                <div class="flex  md:flex-row flex-col w-full my-5" >
                    <x-input id="telefon" label="telefon" value="{{ old('telefon')}}" class="m-2 "></x-input>
                    <x-input type="email" id="email" label="email" value="{{ old('email')}}" class="m-2"></x-input>
                </div>
                <div class='flex items-center justify-center my-5'>
                <button type="submit" 
                class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl
                font-medium text-white px-4 py-2'>Naruci</button>
            </div>
            @endguest
            
        </form>
    </div>
</div>      
<script>
    function fomraToggle(){

        var frm=document.getElementById("forma");

        if(frm.classList.contains("flex")){  
            frm.classList.add("hidden");
            frm.classList.remove("flex");

        }
        else{
            frm.classList.remove("hidden");
            frm.classList.add("flex");

        }
    } 
</script>
@endsection
