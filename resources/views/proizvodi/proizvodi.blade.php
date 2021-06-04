@extends('layouts.app')

@section('content')
<div class="container mx-auto  pl-16  px-4"> 
<div class="flex w-full bg-whiteitems-center justify-center ">

      @auth
            @if(auth()->user()->hasRole('admin'))
            <div id="dodajBtn"  class='flex flex-row h-auto pt-3 items-end justify-end  w-full'>
                                    <button onClick="ToggleForma()" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
            <div id="dodajFoma" class="hidden bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2 mt-8">
                  
                        <form action="{{ route('proizvodi') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Novi proizvod</h1>
                              </div>
                              </div>
                         
                              <div class="grid grid-cols-1 mt-5 mx-7">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Naziv</label>
                                    <input list="ProizvodNaziv" onchange="ToggleNarudzba()" id="naziv" name="naziv"
                                    type="text"  value="" placeholder="naziv" 
                                    class="py-2 px-3 rounded-lg border-2 border-primary-200 mt-1 
                                    focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent" />
                                    
                                    <datalist class="bg-primary-600" id="ProizvodNaziv">
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
                              
                              <div  id="divOblik" class="flex flex-row justify-start items-center w-full  mt-5 mx-7">
                                    <div class=" w-3/5 ">
                                          <x-input id="oblik" label="Oblik" value="{{ old('oblik')}}"></x-input>
                                          <x-input class="hidden" id="oblik_id" label="oblik_id" value="{{ old('oblik_id')}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4 ">
                                          <button type="button" onClick="Show('BackgroundOverlay','ModalPanel','modal')"
                                          class='py-2 px-4 mt-5 flex items-center justify-center  bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl
                                          font-medium text-white '>
                                          Oblik</button>
                                    
                                    </div>
                              </div>

                              <div  class="flex flex-row items-center justify-start w-full  mt-5 mx-7">
                                    <div class=" w-3/5">
                                          <x-input id="font" label="Font" value="{{ old('font')}}"></x-input>
                                          <x-input class="hidden" id="font_id" label="font_id" value="{{ old('font_id')}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOfont','MPfont','Mfont')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Font</button>
                                    
                                    </div>
                              </div>

                              <div  class="flex flex-row items-center justify-start w-full pr-4 mt-5 mx-7">
                                    <div class="w-3/5">
                                          <x-input id="materijal" label="Materijal" value="{{ old('materijal')}}"></x-input>
                                          <x-input class="hidden" id="materijal_id" label="materijal_id" value="{{ old('materijal_id')}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOmaterijal','MPmaterijal','Mmaterijal')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Materijal</button>
                                    
                                    </div>
                              </div>


                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8  mt-5   mx-7">
                                    <x-input id="popust" label="Popust" value="{{ old('popust')}}"></x-input>
                                     <x-input  id="novo" label="novo" value="{{ old('novo')}}"></x-input>
                              </div>
                        
                              <x-input id="cijena" label="cijena" value="{{ old('cijena')}}" class="mt-5 mx-7"></x-input>
                              <x-input type="file" id="file" label="slika" value="{{ old('file')}}" class="mt-5 mx-7"></x-input>


                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button onCilck="ToggleForma()" class='w-auto text-primary-600 hover:bg-primary-200 rounded-lg shadow-xl font-medium  px-4 py-2'>Odustani</button>
                                   
                                    <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                             
                              </div>
                        </form>
            </div>
            @endif
      @endauth
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
<div class=" flex flex-col  w-full  bg-gray-200 items-center justify-center pt-8 ">
            
      @if ($proizvodi->count())
            <div class="w-full bg-gray-200  py-1 rounded-lg grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 ">
                  @foreach($proizvodi as $proizvod)
                  <x-kartica :proizvod="$proizvod"/>
                  @endforeach
            </div>
                              
            {{$proizvodi->links()}}
      @else
            <p>Nema proizvoda.</p>
      @endif
           
</div>     
      

<script>
      function ToggleForma(){
            var btn=document.getElementById("dodajBtn");
            var forma=document.getElementById("dodajFoma");

            
            if (btn.classList.contains("flex"))
            {
                  btn.classList.remove('flex');
                  btn.classList.add('hidden');

                  forma.classList.add('grid');
                  forma.classList.remove('hidden');
                  
            }
            else
            {
                  btn.classList.remove('hidden');
                  btn.classList.add('flex');

                  forma.classList.add('hidden');
                  forma.classList.remove('grid');
                 
            }
      }
      function ToggleNarudzba(){


}
  ToggleNarudzba()
</script>
@endsection