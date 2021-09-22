@extends('layouts.app')

@section('content')
<div class="container mx-auto   px-4"> 
<div class="flex w-full bg-whiteitems-center justify-center ">

      @auth
            @if(auth()->user()->hasRole('admin'))

            <div id="dodajBtn"  class='flex flex-row h-auto pt-3 items-end justify-end  w-full'>
                   <button onClick="ToggleForma()" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
            
            </div>
            <div id="dodajFoma" class="hidden bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2 mt-8">
                  
                        <form name="proizvodfrm" onsubmit="return validateProizvodForm('proizvodfrm')" action="{{ route('proizvodi') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                                    <div class="flex">
                                          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Novi proizvod</h1>
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

                               <div  class="flex flex-row items-center justify-start w-full  mt-5 mx-7">
                                    <div class=" w-3/5">
                                          <x-input id="kategorija" label="kategorija"  value="{{ old('kategorija')}}"></x-input>
                                          <x-input class="hidden" id="kategorija_id" label="kategorija_id" value="{{ old('kategorija_id')}}"></x-input>
                                          @error("kategorija_id")
                                                <div for="kategorija_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                           @enderror
                                          <div id="errorkategorija" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOkategorija','MPkategorija','Mkategorija')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Kategorija</button>
                                    
                                    </div>
                              </div>
                              
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                                    <x-input id="visina" label="Visina" value="{{ old('visina')}}">
                                           @error("visina")
                                                <div for="visina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                           @enderror
                                          <div id="errorvisina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
                                    </x-input>
                                    <x-input id="sirina" label="Širina" value="{{ old('sirina')}}">
                                           @error("sirina")
                                                <div for="sirina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                           @enderror
                                          <div id="errorsirina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
                                    </x-input>
                              </div>
                              <div  id="divOblik" class="hidden flex-row justify-start items-center w-full  mt-5 mx-7">
                                    <div class=" w-3/5 ">
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
                                          @error("font_id")
                                                <div for="font_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                           @enderror
                                          <div id="errorfont" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
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
                                          @error("materijal_id")
                                                <div for="materijal_id" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                           @enderror
                                          <div id="errormaterijal" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOmaterijal','MPmaterijal','Mmaterijal')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Materijal</button>
                                    
                                    </div>
                              </div>

                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8  mt-5   mx-7">
                                    <x-input id="popust" label="Popust" value="{{ old('popust')}}">
                                          @error("popust")
                                                <div for="popust" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                           @enderror
                                          <div id="errorpopust" class=" flex items-center font-medium text-gerrn-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
                                    </x-input>
                                     <x-input  id="cijena" label="cijena" value="{{ old('cijena')}}">
                                          @error("cijena")
                                                <div for="cijena" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                {{$message}}
                                                </div>
                                          @enderror
                                          <div id="errorcijena" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    
                                          </div>
                                     </x-input>
                              </div>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8  mt-5   mx-7">
                                    <x-input type="checkbox" id="aktivan[]" label="aktivan" value="{{ old('aktivan[]')}}"></x-input>
                                     <x-input type="checkbox" id="novo[]" label="novo" value="{{ old('novo')}}"></x-input>
                              </div>
                             <x-input type="file" id="file" label="slika" value="{{ old('file')}}" class="mt-5 mx-7">
                                    @error("file")
                                          <div for="file" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                          {{$message}}
                                          </div>
                                     @enderror
                                    <div id="errorfile" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              
                                    </div>
                             </x-input>


                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                                    <button onCilck="ToggleForma()" class='w-auto text-primary-600 hover:bg-primary-200 rounded-lg shadow-xl font-medium  px-4 py-2'>Odustani</button>
                                    <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
                        </form>
            </div>
            @endif
      @endauth
</div>  

      @if ($kategorije->count())
      <x-modal :obj="$kategorije"  idBO="BOkategorija" idMP="MPkategorija" idM="Mkategorija" idinputa="kategorija_id" input="kategorija" idoblik="divOblik" labela="kategorija"/>
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
   <x-modalDetalji id="Detalji"  idBO="BODetalji" idMP="MPDetalji" idM="MDetalji"/>

      <div class="  flex flex-col  w-full  bg-gray-200 items-center justify-center pt-8 ">
            
            @if ($proizvodi->count())
                  <div class="w-full bg-gray-200  py-1  rounded-lg flex justify-center  ">
                        <div class=" w-full sm:w-2/3 place-items-center py-1 grid grid-cols-1 xl:grid-cols-2">
                              @foreach($proizvodi as $proizvod)
                             <x-kartica :proizvod="$proizvod" />
                                   
                              
                        
                              @endforeach
                        </div>
                  </div>
                                    
                  {{$proizvodi->links()}}
            @else
                  <p>Nema proizvoda.</p>
            @endif

            @auth
                 
                  @if(!auth()->user()->hasRole('admin'))
                        <div class="p-2  fixed bottom-10 right-10">
                              <a href="{{route('korpa.cart')}}" class="bg-transparent">
                                    <div class="flex flex-row items-start">
                                          <div class=" bg-primary-500 shadow-md rounded-full focus:outline-none hover:bg-primary-700">
                                          <img  class="p-3 " src="{{asset('icona/outline_shopping_cart_white_24pt_1x.png')}}"/>
                                          
                                          </div>

                                          @if (Session::has('cart') )

                                          <div class="py-1 px-2 text-xs font-semibold text-white  bg-primary-500 rounded-full  ">
                                          
                                                {{Session::get('cart')->totalqty}}
                                          </div>
                                          @endif
                                    </div>
                              </a>
                        </div>
                  @endif
            @endauth
            @guest
            <div class="p-2  fixed bottom-10 right-10">
                              <a href="{{route('korpa.cart')}}" class="bg-transparent">
                                    <div class="flex flex-row items-start">
                                          <div class=" bg-primary-500 shadow-md rounded-full focus:outline-none hover:bg-primary-700">
                                          <img  class="p-3 " src="{{asset('icona/outline_shopping_cart_white_24pt_1x.png')}}"/>
                                          
                                          </div>

                                          @if (Session::has('cart') )

                                          <div class="py-1 px-2 text-xs font-semibold text-white  bg-primary-500 rounded-full  ">
                                          
                                                {{Session::get('cart')->totalqty}}
                                          </div>
                                          @endif
                                    </div>
                              </a>
                        </div>
            @endguest
      </div>     
</div>     
<link href="{{asset('css/lightbox.css')}}" rel="stylesheet" />
<script src="{{asset('js/lightbox-plus-jquery.js')}}"></script>
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
    
</script>
@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection