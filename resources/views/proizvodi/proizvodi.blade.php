@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                        <form action="{{ route('proizvodi') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Novi proizvod</h1>
                              </div>
                              </div>
                              <!--
                                    'nazivProizvoda'
                'visina'=>$request->get('visina'),
                'sirina'=>$request->get('sirina'),
                'cijena'=>$request->get('cijena'),
                'popust'=>$request->get('popust'),
                'novo'=>$request->get('novo'),
                'obliks_id'=>$request->get('obliks_id'),
                'fonts_id'=>$request->get('fonts_id'),
                'materijals_id'=>$request->get('materijals_id'),
                              -->
                          
    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Naziv</label>
      <input list="Proizvodi" onchange="ToggleNarudzba()" id="naziv" name="naziv" class="py-2 px-3 rounded-lg border-2 border-primary-200 mt-1 
      focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent" 
      type="text"  value="" placeholder="naziv" />
      
      <datalist class="bg-primary-600" id="Proizvodi">
        <option  value="Plocica za vrata">
        <option value="Vjesalica za kljuceve">
        <option value="Zahvalnica">
        <option value="Reklama">
        <option value="Meni">
      </datalist>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
        <x-input id="visina" label="Visina" value=""></x-input>
        <x-input id="sirina" label="Sirina" value=""></x-input>
    </div>
    
    <div id="divOblik" class="grid grid-cols-2 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
      <div class="grid grid-cols-1">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Oblik</label>
          <label class="border-4 border-solid w-full h-28  border-primary-200">
            <img id="slika"  class="h-24 w-full pl-1 pt-1" src="{{asset('icona/1.png')}}"/>
          </label>

      </div>

      <div class="grid grid-cols-1 m-0 p-0">
        <button type="button" onClick="Show('oblik')" class='flex items-center justify-center w-24 h-10 mt-14 mb-10 bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
        Odaberi</button>
    
      </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7 ">
      <x-input id="font" label="Font"  value="font" ></x-input>
      
      <div class="grid grid-cols-1   ">
        <button type="button" onClick="Show('font')" class='flex items-center justify-center
         w-24 h-10 mt-6
         bg-primary-600 hover:bg-primary-700 
         rounded-lg shadow-xl font-medium 
         text-white '>
        Odaberi
        </button>
    
      </div>
    </div>

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Materijal</label>
      <select class="py-2 px-3 rounded-lg border-2 border-primary-300 mt-1 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent">
        <option>Drvo</option>
        <option>Ploca</option>
        <option>Drvo</option>
        <option>Ploca</option>

      </select>
    </div>

    

                              <x-input type="file" id="file" label="slika" value="" class="mt-5 mx-7"></x-input>

                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
      @if ($proizvodi->count())
            <div class="w-full bg-gray-200 pl-14 py-1 rounded-lg grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 ">
                  @foreach($proizvodi as $proizvod)
                        <x-kartica :proizvod="$proizvod"/>
                  @endforeach
            </div>
                              
            {{$proizvodi->links()}}
      @else
            <p>Nema proizvoda.</p>
      @endif
               
</div>     
      
 
@endsection