@extends('layouts.app')

@section('content')
<div class=" flex h-screen bg-gray-200 items-center justify-center my-40  md:my-32">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    <form action="{{ route('narudzba') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="flex justify-center pt-4">
        <div class="flex">
          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Narudzba</h1>
        </div>
      </div>

      <div class="grid grid-cols-1 mt-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Naziv</label>
        <input list="Proizvodi" onchange="ToggleNarudzba()" id="naziv" name="naziv" class="py-2 px-3 rounded-lg border-2 border-primary-200 mt-1 
        focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent" 
        type="text"  value="{{ old('naziv')}}" placeholder="naziv" />
        
        <datalist class="bg-primary-600" id="Proizvodi">
          <option  value="Plocica za vrata">
          <option value="Vjesalica za kljuceve">
          <option value="Zahvalnica">
          <option value="Reklama">
          <option value="Meni">
        </datalist>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <x-input id="visina" label="Visina" value="{{ old('visina')}}"></x-input>
          <x-input id="sirina" label="Sirina" value="{{ old('sirina')}}"></x-input>
      </div>
      
      <div  id="divOblik" class="flex flex-row items-center w-full mt-5 mx-7">
          <div class=" w-2/3">
              <x-input id="oblik" label="Oblik" value="{{ old('oblik')}}"></x-input>
              <x-input class="hidden" id="oblik_id" label="oblik_id" value="{{ old('oblik_id')}}"></x-input>
          </div>

          <div class="w-1/3 ml-4 ">
            <button type="button" onClick="Show('BackgroundOverlay','ModalPanel','modal')"
            class='py-2 px-4 mt-5 flex items-center justify-center  bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl
              font-medium text-white '>
            Odaberi oblik</button>
        
          </div>
      </div>

      <div  class="flex flex-row items-center w-full mt-5 mx-7">
        <div class=" w-2/3">
              <x-input id="font" label="Font" value="{{ old('font')}}"></x-input>
              <x-input class="hidden" id="font_id" label="font_id" value="{{ old('font_id')}}"></x-input>
        </div>

        <div class="w-1/3 ml-4 ">
          <button type="button" onClick="Show('BOfont','MPfont','Mfont')" 
          class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
          Odaberi font</button>
      
        </div>
      </div>

      <div  class="flex flex-row items-center w-full  mt-5 mx-7">
        <div class="w-2/3">
              <x-input id="materijal" label="Materijal" value="{{ old('materijal')}}"></x-input>
              <x-input class="hidden" id="materijal_id" label="materijal_id" value="{{ old('materijal_id')}}"></x-input>
        </div>

        <div class="w-1/3 ml-4">
          <button type="button" onClick="Show('BOmaterijal','MPmaterijal','Mmaterijal')" 
          class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
          Odaberi materijal</button>
      
        </div>
      </div>

      <div class="grid grid-cols-1 my-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Opis</label>
        <textarea id="opis" class=" rounded-lg p-2 border-2 border-solid border-primary-300"
        name="opis"  rows="4" cols="50" placeholder="Zelim da boja slova bude crna, a pozadina ..."></textarea>
      </div>
      @guest
        <label class="  mx-7 uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Kontakt podatci</label>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8  mx-7">
            <x-input id="telefon" label="telefon" value="{{ old('telefon')}}"></x-input>
            <x-input type="email" id="email" label="email" value="{{ old('email')}}"></x-input>
        </div>
      @endguest
      

      <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
        <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</button>
      </div>
    </form>
  </div>
@if ($oblici->count())
<x-modal :obj="$oblici" idBO="BackgroundOverlay" idMP="ModalPanel" idM="modal" idinputa="oblik_id" input="oblik" labela="oblik"/>
@endif
@if ($fontovi->count())
<x-modal :obj="$fontovi" idBO="BOfont" idMP="MPfont" idM="Mfont" idinputa="font_id" input="font" labela="font"/>
@endif

@if ($materijali->count())
<x-modal :obj="$materijali" idBO="BOmaterijal" idMP="MPmaterijal" idM="Mmaterijal" idinputa="materijal_id" input="materijal" labela="materijal"/>
@endif
<script>
  function ToggleNarudzba(){

    var naziv=document.getElementById("naziv");
    var divOblik=document.getElementById("divOblik");
   // divOblik.classList.add("hidden");

    if(naziv.value!="Plocica za vrata" ){
      divOblik.classList.add("hidden");
      divOblik.classList.remove("block");

    }
    else{
      divOblik.classList.remove("hidden");
      divOblik.classList.add("block");

    }
  }
  ToggleNarudzba()
</script>
@endsection

