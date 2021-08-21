@extends('layouts.app')

@section('content')
<div class=" flex h-full bg-gray-200 items-center justify-center my-10  ">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    <form  name="narudzbafrm" onsubmit="return validateNarudzbaForm('narudzbafrm')" action="{{ route('narudzba') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="flex justify-center pt-4">
        <div class="flex">
          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Narudzba</h1>
        </div>
      </div>

      <div  class="flex flex-row items-center w-full mt-5 mx-7">
        <div class=" w-2/3">
              <x-input id="kategorija" label="kategorija"  value="{{ old('kategorija')}}"></x-input>
              <x-input class="hidden" onChange="kategorija('$kategorija_materijals', '$materijali', 'kategorija_id')" id="kategorija_id" label="kategorija_id" value="{{ old('kategorija_id')}}"></x-input>
              @error("kategorija_id")
                  <div for="kategorija_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                  {{$message}}
                  </div>
               @enderror
              <div id="errorkategorija" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        
              </div>
            </div>

        <div class="w-1/3 ml-4 ">
          <button type="button" onClick="Show('BOkategorija','MPkategorija','Mkategorija')" 
          class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
          Kategorija</button>
      
        </div>
      </div>

        
      <x-input id="tekst" label="tekst" value="{{ old('tekst')}}" class="mt-5 mx-7">
        @error("tekst")
            <div for="tekst" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
            {{$message}}
            </div>
         @enderror
        <div id="errortekst" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
  
        </div>
      </x-input>
      <x-input type="file" id="file" label="slika" value="{{ old('file')}}" class="mt-5 mx-7">
          @error("file")
            <div for="file" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
            {{$message}}
            </div>
         @enderror
        <div id="errorfile" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
  
        </div>
      </x-input>


      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
          <x-input id="visina" label="Visina u cm" value="{{ old('visina')}}">
            @error("visina")
              <div for="visina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
              {{$message}}
              </div>
            @enderror
            <div id="errorvisina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
      
            </div>
          </x-input>
          <x-input id="sirina" label="Sirina u cm" value="{{ old('sirina')}}">
            @error("sirina")
              <div for="sirina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
              {{$message}}
              </div>
            @enderror
            <div id="errorsirina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
      
            </div>
          </x-input>
      </div>
      
      <div  id="divOblik" class="hidden flex-row items-center w-full mt-5 mx-7">
          <div class=" w-2/3">
              <x-input id="oblik" label="Oblik" value="{{ old('oblik')}}"></x-input>
              <x-input class="hidden" id="oblik_id" label="oblik_id" value="{{ old('oblik_id')}}"></x-input>
              @error("oblik_id")
              <div for="oblik_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
              {{$message}}
              </div>
            @enderror
            <div id="erroroblik" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
      
            </div>
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
              @error("font_id")
              <div for="font_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
              {{$message}}
              </div>
              @enderror
              <div id="errorfont" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        
              </div>
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
              @error("materijal_id")
              <div for="materijal_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
              {{$message}}
              </div>
              @enderror
              <div id="errormaterijal" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        
              </div>
        </div>

        <div class="w-1/3 ml-4">
          <button type="button" onClick="ShowM('BOmaterijal','MPmaterijal','Mmaterijal')" 
          class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
          Materijal</button>
      
        </div>
      </div>

      <div class="grid grid-cols-1 my-5 mx-7">
        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Napomena</label>
        <textarea id="opis" class=" rounded-lg p-2 border-2 border-solid border-primary-300"
        name="opis"  rows="4" cols="50" placeholder="Ukoliko imate poseban zahtjev ili upit, ovdje ga mozete dostaviti."></textarea>
        @error("opis")
              <div for="opis" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
              {{$message}}
              </div>
              @enderror
              <div id="erroropis" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        
              </div>
      </div>
  
      

      <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
        <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</button>
      </div>
    </form>
  </div>
  @if ($kategorije->count())
    <x-modal :obj="$kategorije" idBO="BOkategorija" idMP="MPkategorija" idM="Mkategorija" idinputa="kategorija_id" input="kategorija" idoblik="divOblik" labela="kategorija"/>
    @endif
    @if ($oblici->count())
    <x-modal :obj="$oblici" idBO="BackgroundOverlay" idMP="ModalPanel" idM="modal" idinputa="oblik_id" input="oblik" labela="oblik"/>
    @endif
    @if ($fontovi->count())
    <x-modal :obj="$fontovi" idBO="BOfont" idMP="MPfont" idM="Mfont" idinputa="font_id" input="font" labela="font"/>
    @endif
    @if ($materijali->count())
    <x-modalMaterijali :obj="$materijali" :ams="$kategorija_materijals" idkategorija="kategorija_id" idBO="BOmaterijal" idMP="MPmaterijal" idM="Mmaterijal" idinputa="materijal_id" input="materijal" labela="materijal"/>
    @endif
</div>
<script>
 
</script>
@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection

