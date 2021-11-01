@extends('layouts.app')
@section('title','Izmjena kategorije')

@section('content')
<div class="container mx-auto   px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                        <form name="kategorijaupdatefrm" onsubmit="return validateKategorijaForm('kategorijaupdatefrm')" action="{{ route('kategorija.update',$kategorija->id) }}" method="post" >
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Kategorija</h1>
                              </div>
                              </div>

                              <x-input id="naziv" label="Naziv kategorija" value="{{ $kategorija->naziv}}" class="mt-5 mx-7">
                              @error("naziv")
                              <div for="naziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              {{$message}}
                              </div>
                              @enderror
                              <div id="errornaziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
                             </div>
                              </x-input>
                              
                              <div class="col-span-6 sm:col-span-3 mt-5 mx-7">
                                    <label for="materials" class="block text-sm font-medium text-gray-700">Materijali za kategoriju</label>
                                    <div id="divMaterijala" class="flex-grow overflow-y-auto max-h-40 hidden">
                                          <div class="w-full   rounded-lg flex flex-col ">
                                          
                                                @foreach($materijali as $objekat)
                                          
                                                <div id="{{$objekat->id}}" onClick="Select('{{$objekat->id}}')" class=" flex flex-col items-start justify-center bg-gray-50 
                                                border-primary-300 hover:bg-gray-200 hover:shadow-l focus:bg-primary-200 border-2 m-2 rounded-lg" >
                                                      <p  class="w-2/3 text-lg pl-2 ">Naziv: {{$objekat->naziv}}</p>
                                                      @if ($objekat->visina!=0 || $objekat->sirina!=0)

                                                      <div class="w-2/3 text-lg pl-2 ">Dimenzije: 
                                                            @if($objekat->visina!=0)
                                                            <p>   v{{$objekat->visina}}cm</p> 
                                                            @endif
                                                            @if($objekat->sirina!=0)
                                                            <p>   s{{$objekat->sirina}}cm</p> 

                                                            @endif
                                                      </div>
                                                      @endif
                                                
                                                </div>
                                                
                                                @endforeach
                                          </div>
                                  
                                    </div>
                              <div class='flex items-start justify-start  md:gap-8 gap-4 py-5'>
                                    <button id="button" type="button"  onClick="Selektovani()" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Izmjeni</button>
                              </div>
                              <div id="errormaterijali" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
                             </div>
                              </div>
                              <x-input type="text"   id="selecMaterijali" label="selecMaterijali" class="mt-5 mx-7 hidden " value="{{$selecMaterijali}}"></x-input>
              
                              <x-input type="checkbox" checked="{{ $kategorija->aktivan}}" id="aktivan[]" label="aktivan" class="mt-5 mx-7" value="{{ $kategorija->aktivan}}"></x-input>

                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Snimi</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
    
               
</div>
<script type="text/javascript">

function Selektovani() {
      divMaterijala=document.getElementById("divMaterijala");
      divMaterijala.classList.remove('hidden');
      button=document.getElementById("button");
      button.classList.add('hidden');

     let s= document.getElementById("selecMaterijali").value;
      const niz=s.split(",");
      
            for (let i = 0; i < niz.length; i++) {
                 
               var e= document.getElementById(niz[i]);
               if(e!=null){
                  e.classList.add('bg-primary-200');
                  e.classList.remove('bg-gray-50');
               }
                  
            } 
      

     
     
} 
   function Select(id) {
     var e= document.getElementById(id);
     var pronaden=-1;

     let s= document.getElementById("selecMaterijali").value;
      const niz=s.split(",");

      for (let i = 0; i < niz.length; i++) {
            if(niz[i]==id)
            { pronaden=i;}
      } 
      if(pronaden==-1)
      {
           niz.push(id);  

            e.classList.add('bg-primary-200');
            e.classList.remove('bg-gray-50');
      }
      else{
            //delete niz[pronaden];
            niz.splice(pronaden, 1);
            e.classList.remove('bg-primary-200');
            e.classList.add('bg-gray-50');
      }
      document.getElementById("selecMaterijali").value=niz;
} 

</script>
@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection