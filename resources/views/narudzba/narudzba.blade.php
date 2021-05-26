@extends('layouts.app')

@section('content')
<div class=" flex h-screen bg-gray-200 items-center justify-center my-40  md:my-32">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    

    <div class="flex justify-center pt-4">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Narudzba</h1>
      </div>
    </div>

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
        <x-input id="visina" label="Visina" value="15 cm"></x-input>
        <x-input id="sirina" label="Sirina" value="30 cm"></x-input>
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
      <x-input id="font" label="Naziv"  value="font" ></x-input>
      
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

    <div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Opis</label>
      <textarea id="opis" class=" rounded-lg p-2 border-2 border-solid border-primary-300"
       name="opis" rows="4" cols="50" placeholder="Zelim da boja slova bude crna, a pozadina ..."></textarea>
    </div>


    <!---div class="grid grid-cols-1 mt-5 mx-7">
      <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Pozadina</label>
        <div class='flex items-center justify-center w-full'>
            <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-200 hover:border-primary-300 group'>
                <div class='flex flex-col items-center justify-center pt-7'>
                  <svg class="w-10 h-10 text-primary-400 group-hover:text-promary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                  <p class='lowercase text-sm text-gray-400 group-hover:text-primary-400 pt-1 tracking-wider'>Odaberite sliku</p>
                </div>
              <input type='file' class="hidden" />
            </label>
        </div>
    </div--->

    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
      <button class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Ponisti</button>
      <button class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</button>
    </div>

  </div>
</div>
<!-- This example requires Tailwind CSS v2.0+ -->
<div id="modal" class="fixed z-10 block inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div id="BackgroundOverlay" class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
   
 
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    
    <div id="ModalPanel" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
             Odaberite oblik
            </h3>
            <div class="mt-2">
          
            <button id="btn" onClick="Odabrano('1')" ><img class="h-16 pl-1" src="{{asset('icona/1.png')}}"/></button>
            <button id="btn" onClick="Odabrano('2')" ><img class="h-16 pl-1" src="{{asset('icona/2.png')}}"/></button>
            <button id="btn" onClick="Odabrano('3')" ><img class="h-16 pl-1" src="{{asset('icona/3.png')}}"/></button>
            <button id="btn" onClick="Odabrano('4')" ><img class="h-16 pl-1" src="{{asset('icona/4.png')}}"/></button>
            <button id="btn" onClick="Odabrano('5')" ><img class="h-16 pl-1" src="{{asset('icona/5.png')}}"/></button>
            <button id="btn" onClick="Odabrano('6')" ><img class="h-16 pl-1" src="{{asset('icona/6.png')}}"/></button>


            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" onClick="Hide('oblik')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
          Zatvori
        </button>
        <!--button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Cancel
        </button--->
      </div>
    </div>
  </div>
</div>
<div id="modalFont" class="fixed z-10 block inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div id="BackgroundOverlayFont" class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
   
 
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    
    <div id="ModalPanelFont" class="inline-block align-bottom bg-white 
    rounded-lg text-left overflow-hidden 
    shadow-xl transform transition-all sm:my-8 sm:align-middle w-52">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
             Odaberite font
            </h3>
            <div class="mt-2">
          <div class="grid grid-cols-1 ">
            
              <button id="btn" class="text-lg font-sans" onClick="OdabarnoFont('font-sans')" >Font sans</button>
              <button id="btn" class="text-lg font-serif" onClick="OdabarnoFont('font-serif')" >Font-serif </button>
              <button id="btn" class="text-lg font-mono" onClick="OdabarnoFont('font-mono')" >Font-mono </button>
              <button id="btn" class="text-lg font-cursive" onClick="OdabarnoFont('font-cursive')" >Font-cursive </button>
            
           
          </div>
         
        
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:items-center sm:justify-center">
        <button type="button" onClick="Hide('font')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500  sm:w-auto sm:text-sm">
          Zatvori
        </button>
        <!--button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Cancel
        </button--->
      </div>
    </div>
  </div>
</div>

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
 
  function Show(modal){
    var bo=document.getElementById("BackgroundOverlay");
    var mp=document.getElementById("ModalPanel");
    var m=document.getElementById("modal");
    if(modal=="oblik"){
      bo=document.getElementById("BackgroundOverlay");
      mp=document.getElementById("ModalPanel");
      m=document.getElementById("modal");
    }
    else if (modal=="font")
     {
      bo=document.getElementById("BackgroundOverlayFont");
      mp=document.getElementById("ModalPanelFont");
      m=document.getElementById("modalFont");
     }
    m.classList.add('block');
    m.classList.remove('hidden');

    m.classList.add('z-10');
    m.classList.remove('z-0');

    bo.classList.add('ease-out');
    bo.classList.add('duration-300');

    bo.classList.remove('opacity-0');
    bo.classList.add('opacity-100');

    mp.classList.add('ease-out');
    mp.classList.add('duration-300');
    mp.classList.remove('opacity-0');
    mp.classList.remove('translate-y-4');
    mp.classList.remove('sm:translate-y-0');
    mp.classList.remove('sm:scale-95');
    mp.classList.add('opacity-100');
    mp.classList.add('translate-y-0');
    mp.classList.add('sm:scale-100');

  }
  function Hide(modal){

    var bo=document.getElementById("BackgroundOverlay");
    var mp=document.getElementById("ModalPanel");
    var m=document.getElementById("modal");
    if(modal=="oblik"){
      bo=document.getElementById("BackgroundOverlay");
      mp=document.getElementById("ModalPanel");
      m=document.getElementById("modal");
    }
    else if (modal=="font")
     {
      bo=document.getElementById("BackgroundOverlayFont");
      mp=document.getElementById("ModalPanelFont");
      m=document.getElementById("modalFont");
     }
    m.classList.add('hidden');
    m.classList.remove('block');

    m.classList.add('z-0');
    m.classList.remove('z-10');

    bo.classList.remove('ease-out');
    bo.classList.remove('duration-300');

    bo.classList.add('opacity-0');
    bo.classList.remove('opacity-100');

    mp.classList.remove('ease-out');
    mp.classList.remove('duration-300');

    mp.classList.add('opacity-0');
    mp.classList.add('translate-y-4');
    mp.classList.add('sm:translate-y-0');
    mp.classList.add('sm:scale-95');

    mp.classList.remove('opacity-100');
    mp.classList.remove('translate-y-0');
    mp.classList.remove('sm:scale-100');

  }
  function Odabrano(i){

    Hide('oblik');
    //  var oblik= document.getElementById("in").value=id;
   
    var sl="{{asset('icona/1.png')}}";

    if(i==9){sl="{{asset('icona/9.png')}}";}
    else if(i==2){sl="{{asset('icona/2.png')}}";}
    else if(i==3){sl="{{asset('icona/3.png')}}";}
    else if(i==4){sl="{{asset('icona/4.png')}}";}
    else if(i==5){sl="{{asset('icona/5.png')}}";}
    else if(i==6){sl="{{asset('icona/6.png')}}";}
    else if(i==7){sl="{{asset('icona/7.png')}}";}
    else if(i==8){sl="{{asset('icona/8.png')}}";}

    var img=document.getElementById("slika").src=sl;



  }
 
  function OdabarnoFont(i){

    Hide('font');
    var f=document.getElementById("font");
 
   
    if( f.classList.contains("font-sans")){
      f.classList.remove('font-sans');
    // f.classList.remove('font-sans');
    }
    else if( f.classList.contains("font-serif")){
      f.classList.remove('font-serif');
      
    }
    else if(f.classList.contains("font-mono")){
      f.classList.remove('font-mono');
      
    }
    else if(f.classList.contains("font-cursive")){
      f.classList.remove('font-cursive');
      
    }
    f.classList.add(i);
    f.value=i;
  }
  Hide('oblik');
  Hide('font');
  ToggleNarudzba()
</script>
@endsection

