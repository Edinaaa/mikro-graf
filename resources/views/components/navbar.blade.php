<div>
    <header class=" bg-gray-900 sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">
     
        <div class="flex  items-center  justify-between px-4 py-3 sm:p-0">
            <div class=" text-gray-100 font-semibold text-2xl">
                <p  >MIKRO-<span class=" text-primary-600">GRAF</span></p>
            </div>
            <div class="sm:hidden">
                <button type="button" onClick="togglemenu()" class="text-gray-500 hover:text-white focus:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-current" viewBox="0 0 24 24"stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/> 
                    </svg>

                </button>

            </div>
        </div>
        <div id="navigacija" class="px-2 pt-2 pb-4 block sm:flex sm:p-0">
            <a href="#" class=" block    px-2 py-1 text-white font-semibold rounded hover:bg-gray-800">Pocetna</a>
            <div class="relative bg-gray-800 sm:bg-gray-900   hover:bg-gray-800">
                    
                <button onClick="ProizvodiToggle()" class=" focus:outline-none mt-1 px-2 py-1 text-white font-semibold rounded  sm:mt-0">Proizvodi</button>
                <div id="dropdown" class="z-10 relative sm:absolute bg-gray-800 sm:bg-gray-900  w-40 rounded-lg hidden grid-cols-1">
                    <a href="{{route('proizvodi')}}"class="mt-2 px-4 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Proizvodi</a>
                    <a href="{{route('galerija')}}" class="mt-2 px-4 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Galerija</a>
                    <a href="{{route('narudzbe')}}" class="mt-2 px-4 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Narudzbe</a>
                    <a href="{{route('narudzba')}}" class="mt-2 px-4 py-1 text-white font-semibold rounded  hover:bg-gray-900 sm:hover:bg-gray-800 sm:mt-0">Nova narudzba</a>
                </div>
            </div> 
            
            <a href="{{route('onama')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0">O nama</a>
            <a href="{{route('kontakt')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0">Kontakt</a>
            <a href="{{route('login')}}" class="block mt-1 px-2 py-1 text-white font-semibold rounded hover:bg-gray-800 sm:mt-0">Login</a>

        </div>
    </header>
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

     function ProizvodiToggle(){
         var dd=document.getElementById("dropdown");
         if (dd.classList.contains("grid"))
        {
    
        dd.classList.remove('grid');
        dd.classList.add('hidden');
    
        }
        else
        {
            dd.classList.remove('hidden');
            dd.classList.add('grid');
        }
    }
</script>