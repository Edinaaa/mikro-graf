<div>
@auth
<header class="z-10 relative bg-gray-900 sm:flex sm:justify-around sm:items-center ">
     
     <div class="flex  items-center  justify-between ">
       
         <img  class=" h-14 " src="{{asset('icona/mikrograf logo-1.jpg')}}"/>

         <div class="sm:hidden">
             <button type="button" onClick="togglemenu()" class="text-gray-500 hover:text-white focus:text-white focus:outline-none pr-5 py-3 sm:p-0">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24"stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/> 
                 </svg>

             </button>

         </div>
     </div>
     <div id="navigacija" class=" px-5 pt-2 pb-4 hidden sm:flex sm:p-0">
        <a href="{{route('home')}}" class="flex flex-col items-start sm:items-center justify-start text-white font-semibold rounded hover:bg-gray-800 mt-2  py-1 px-5">Početna</a>

         <div  class="relative flex flex-col items-start sm:items-center justify-start  bg-gray-900   hover:bg-gray-800 sm:px-5  ">
                 
             <button onClick="Toggle('dropdown')" class="flex flex-col  focus:outline-none mt-1 px-2 py-1 text-white font-semibold rounded  sm:mt-0">
             <div class="flex flex-row items-end justify-end">
                <img  class="  p-1 " src="{{asset('icona/outline_arrow_drop_down_white_24dp.png')}}"/>
                Katalog
             </div>
           
             </button>
             <div id="dropdown" class="  flex-col z-30 relative sm:absolute sm:top-9 bg-gray-800 sm:bg-gray-900 p-4 rounded-lg hidden ">
                 <a href="{{route('proizvodi')}}"class="mt-2 px-2 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Proizvodi</a>
                 <a href="{{route('galerija')}}" class="mt-2 px-2 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Galerija</a>
                 <a href="{{route('narudzba.narudzbe')}}" class="mt-2 px-2 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Narudžbe</a>
             </div>
         </div> 
         
         <div  class="relative flex flex-col items-start sm:items-center justify-start bg-gray-900 hover:bg-gray-800 sm:px-5">
             <button onClick="Toggle('dropdownKontakt')" class=" flex flex-col focus:outline-none mt-1 px-2 py-1 text-white font-semibold rounded  sm:mt-0">
             <div class="flex flex-row items-end justify-end">
                <img  class="  p-1 " src="{{asset('icona/outline_arrow_drop_down_white_24dp.png')}}"/>
                 Opcije
             </div>
             </button>
             <div id="dropdownKontakt" class="z-30 p-4 flex-col sm:top-9 relative sm:absolute bg-gray-800 sm:bg-gray-900   rounded-lg hidden grid-cols-1">
                    <a href="{{route('font')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Font</a>
                    <a href="{{route('oblik')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Oblik</a>
                    <a href="{{route('materijal')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Materijal</a>
                    <a href="{{route('kategorija')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Kategorija</a>
                    <a href="{{route('stanje')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Stanje</a>
             </div>
         </div>

         <div class="relative flex flex-col items-start sm:items-center justify-start  bg-gray-900    hover:bg-gray-800 sm:px-5">
                <button onClick="Toggle('dropdownUser')"   class="flex flex-col  focus:outline-none mt-1 px-2 py-1 text-primary-400 font-semibold rounded  sm:mt-0">
                    <div class="flex flex-row items-end justify-end">
                        <img  class="  p-1 " src="{{asset('icona/outline_arrow_drop_down_white_24dp.png')}}"/>
                        {{ auth()->user()->name}}
                        <img  class="  px-2 " src="{{asset('icona/outline_person_white_24dp.png')}}"/>
                    </div>
                </button>
                 <div id="dropdownUser" class="z-30 relative p-4 flex-col sm:top-9   sm:absolute bg-gray-800 sm:bg-gray-900 rounded-lg hidden grid-cols-1">
                  <a href="{{route('user',auth()->id())}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0"> Postavke</a>
                  <a href="{{route('razgovor')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Poruke</a>
                    
                     <form action="{{route('logout')}}" method="post" class="inline">
                     @csrf
                         <button class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0" type="submit" >Logout</button>
                     </form>
                 </div>
             </div>
        
         
     </div>
 </header>
@endauth
    
</div>

<script>
    
    function togglemenu(){
         var nav=document.getElementById("navigacija");
         if (nav.classList.contains("block"))
        {
    
        nav.classList.remove('block');
        nav.classList.add('hidden');
    
        }
        else
        {
            nav.classList.remove('hidden');
            nav.classList.add('block');
        }
    }

     function Toggle(id){
         var dd=document.getElementById(id);
         if (dd.classList.contains("flex"))
        {
    
        dd.classList.remove('flex');
        dd.classList.add('hidden');
    
        }
        else
        {
            dd.classList.remove('hidden');
            dd.classList.add('flex');
        }
    }
</script>