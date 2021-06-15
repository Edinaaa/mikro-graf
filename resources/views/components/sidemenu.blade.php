
<div id="slider"  class=" z-10 absolute bg-gray-800 w-14   min-h-screen h-full">
<div >
     <button id="btn" onClick="sidemenu()" class=" absolute top-1  ml-2 h-8 w-8 rounded-full focus:outline-none hover:bg-gray-600">
         <img id="otvori"  class="h-6 pl-1 " src="{{asset('icona/outline_arrow_forward_ios_white_24dp.png')}}"/>
         <img id="zatvori" class="h-6 hidden" src="{{asset('icona/outline_arrow_back_ios_white_24dp.png')}}"/>
    </button>
</div>
<div id="menu" class="pt-10 hidden">
     <div class="flex flex-row  justify-between items-end text-gray-400 px-8 py-2">
          <a href="#" class="block text-gray-400 "  >{{ auth()->user()->name}}</a>
         <div class="flex flex-row justify-between ">
         <a href="{{route('user',auth()->id())}}" class="block rounded-lg  text-gray-400 pr-1  focus:outline-none hover:bg-gray-600"  >
               <img  class=" p-1 " src="{{asset('icona/outline_manage_accounts_white_24dp.png')}}"/>
          </a>
          <form action="{{route('logout')}}" method="post" class="inline pr-1">
               @csrf
               <button class="block rounded-lg text-gray-400 focus:outline-none hover:bg-gray-600" type="submit" >
                    <img  class="  p-1 " src="{{asset('icona/outline_logout_white_24dp.png')}}"/>
               </button>
          </form>
          <a href="{{route('razgovor')}}" class="block rounded-lg  text-gray-400 pr-1 focus:outline-none hover:bg-gray-600">
               <img  class="  p-1 " src="{{asset('icona/outline_chat_white_24dp.png')}}"/>
          </a>

         </div>
         
     </div>
    <a href="{{route('narudzba.narudzbe')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Narudzbe</a>
    <a href="{{route('galerija')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Galerija</a>
    <a href="{{route('proizvodi')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Proizvodi</a>
    <a href="{{route('font')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Font</a>
    <a href="{{route('oblik')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Oblik</a>
    <a href="{{route('materijal')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Materijal</a>
    <a href="{{route('artikal')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Artikal</a>
    <a href="{{route('stanje')}}" class="block text-gray-400 px-8 py-2 focus:outline-none hover:bg-gray-600">Stanje</a>
        
    
        
      
</div>

</div>
<script>
     function sidemenu(){
         var otvori=document.getElementById("otvori");
         var zatvori=document.getElementById("zatvori");
         var menu=document.getElementById("menu");

         var slider=document.getElementById("slider");
         var btn=document.getElementById("btn");
       
         if (otvori.classList.contains("block"))
          {
    
            zatvori.classList.remove('hidden');
            zatvori.classList.add('block');

            menu.classList.add('block');
            menu.classList.remove('hidden');

            slider.classList.add('w-60');
            slider.classList.remove('w-12');
            btn.classList.add('left-48');
          

            otvori.classList.add('hidden');
            otvori.classList.remove('block');

    
          }
         else{
            zatvori.classList.remove('block');
            zatvori.classList.add('hidden');

            menu.classList.add('hidden');
            menu.classList.remove('block');

            slider.classList.remove('w-60');
            slider.classList.add('w-12');
            btn.classList.remove('left-48');
        

            otvori.classList.add('block');
            otvori.classList.remove('hidden');
          }
     }
</script>