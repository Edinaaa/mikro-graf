@extends('layouts.app')

@section('content')
<div class=" flex h-full bg-gray-200 items-center justify-center my-10  ">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    <form action="{{ route('narudzba') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="flex justify-center pt-4">
        <div class="flex">
          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Narudzba</h1>
        </div>
      </div>

      <div  class="flex flex-row items-center w-full mt-5 mx-7">
        <div class=" w-2/3">
              <x-input id="artikal" label="artikal"  value="{{ old('artikal')}}"></x-input>
              <x-input class="hidden" id="artikal_id" label="artikal_id" value="{{ old('artikal_id')}}"></x-input>
        </div>

        <div class="w-1/3 ml-4 ">
          <button type="button" onClick="Show('BOartikal','MPartikal','Martikal')" 
          class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
          Artikal</button>
      
        </div>
      </div>

        
      <x-input id="tekst" label="tekst" value="{{ old('tekst')}}" class="mt-5 mx-7"></x-input>
      <x-input type="file" id="file" label="slika" value="{{ old('file')}}" class="mt-5 mx-7"></x-input>


      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <x-input id="visina" label="Visina u cm" value="{{ old('visina')}}"></x-input>
          <x-input id="sirina" label="Sirina u cm" value="{{ old('sirina')}}"></x-input>
      </div>
      
      <div  id="divOblik" class="hidden flex-row items-center w-full mt-5 mx-7">
          <div class=" w-2/3">
              <x-input id="oblik" label="Oblik" value="{{ old('oblik')}}"></x-input>
              <x-input class="hidden" id="oblik_id" label="oblik_id" value="{{ old('oblik_id')}}"></x-input>
          </div>

          <div class="w-1/3 ml-4 ">
            <button type="button" onClick="Show('BackgroundOverlay','ModalPanel','modal')"
            class='py-2 px-4 mt-5 flex items-center justify-center  bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl
              font-medium text-white '>
            Oblik</button>
        
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
          Font</button>
      
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
          Materijal</button>
      
        </div>
      </div>

      <div class="grid grid-cols-1 my-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Napomena</label>
        <textarea id="opis" class=" rounded-lg p-2 border-2 border-solid border-primary-300"
        name="opis"  rows="4" cols="50" placeholder="Ukoliko imate poseban zahtjev ili upit, ovdje ga mozete dostaviti."></textarea>
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
  @if ($artikli->count())
    <x-modal :obj="$artikli" idBO="BOartikal" idMP="MPartikal" idM="Martikal" idinputa="artikal_id" input="artikal" idoblik="divOblik" labela="artikal"/>
    @endif
    @if ($oblici->count())
    <x-modal :obj="$oblici" idBO="BackgroundOverlay" idMP="ModalPanel" idM="modal" idinputa="oblik_id" input="oblik" labela="oblik"/>
    @endif
    @if ($fontovi->count())
    <x-modal :obj="$fontovi" idBO="BOfont" idMP="MPfont" idM="Mfont" idinputa="font_id" input="font" labela="font"/>
    @endif
    @if ($materijali->count())
    <x-modal :obj="$materijali" idBO="BOmaterijal" idMP="MPmaterijal" idM="Mmaterijal" idinputa="materijal_id" input="materijal" labela="materijal"/>
    @endif
</div>
<script>
 
</script>
@endsection

