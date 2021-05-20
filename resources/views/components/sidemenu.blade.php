
<div id="slider"  class=" z-40 absolute bg-gray-800 w-12 h-screen">
<div >
     <button id="btn" onClick="sidemenu()" class=" absolute top-1  ml-2 h-8 w-8 rounded-full focus:outline-none focus:bg-gray-600">
         <img id="otvori"  class="h-6 pl-1 " src="{{asset('icona/outline_arrow_forward_ios_white_24dp.png')}}"/>
         <img id="zatvori" class="h-6 hidden" src="{{asset('icona/outline_arrow_back_ios_white_24dp.png')}}"/>
    </button>
</div>
<div id="menu" class="pt-8 hidden">
    <a href="#" class="block text-gray-400 px-8 py-4">Narudzbe</a>
    <a href="#" class="block text-gray-400 px-8 py-4">Galerija</a>
    <a href="#" class="block text-gray-400 px-8 py-4">Proizvodi</a>
    <a href="#" class="block text-gray-400 px-8 py-4">Logout</a>
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