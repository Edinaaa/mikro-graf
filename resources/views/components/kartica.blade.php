@props(['proizvod'=>'$proizvod'])
<div id="kartica" class=" w-96 bg-gray-400 relative flex justify-center items-center m-2 rounded-md overflow-hidden">

      <img class="flex flex-col  justify-between w-full h-96 
      shadow-md  object-cover object-center"
      src="{{asset('thumb/'.$proizvod->image->name)}}"/>
     @if($proizvod->popust!=0)
      <div  class="absolute top-0  w-full flex justify-between items-center ml-4 pr-8">
         
         <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Popust</div>
         <div  class="bg-primary-600 w-10 h-12 shadow flex flex-col-reverse pb-4 text-center font-bold text-white rounded-b-full">{{$proizvod->popust}}%</div>

         </div> 
     @endif
     
     @if ($proizvod->novo)
         <div  class=" absolute top-0 w-full flex justify-between items-center mt-3 ml-4 pr-8">
          <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Novo</div>
        </div>
     @endif
     @if (!$proizvod->aktivan)
          <div  class=" absolute top-0 w-full flex justify-between items-center mt-3 ml-4 pr-8">
          <div class="bg-primary-600 text-white bg-opacity-95 shadow px-2 py-1 flex items-center font-bold text-xs rounded">Nedostupan</div>
        </div>
     @endif

   <div class=" w-full absolute bottom-0 bg-white bg-opacity-95 shadow-md rounded-l-md flex flex-col  p-4 ">
     
   <div class=" flex items-center flex-row justify-between">
         <h3 class="text-xl font-bold pb-2">{{$proizvod->kategorija->naziv}}</h3>
         <div class=" flex flex-row items-center ">
         @auth
            @if (auth()->user()->hasRole('admin'))
               <a href="{{route('proizvodi.show', $proizvod)}}" class='flex justify-center items-center bg-primary-400 hover:bg-primary-500  
               mx-2 h-8 w-8 rounded-full focus:outline-none ' >
               <img src="{{asset('icona/edit_white_24dp.svg')}}"/></a>
                                         
            @else 
               <a href="{{route('korpa.SelektAdd', $proizvod->id)}}" class='flex justify-center items-center bg-primary-400 hover:bg-primary-500  
               mx-2 h-8 w-8 rounded-full focus:outline-none ' >
               <img src="{{asset('icona/add_shopping_cart_white_24dp.svg')}}"/></a>
            @endif
         @endauth
         @guest
            <a href="{{route('korpa.SelektAdd', $proizvod->id)}}" class='flex justify-center items-center bg-primary-400 hover:bg-primary-500  
            mx-2 h-8 w-8 rounded-full focus:outline-none ' >
            <img src="{{asset('icona/add_shopping_cart_white_24dp.svg')}}"/></a>
         @endguest
            <a href="#" onClick="DetaljiProizvoda('{{$proizvod}}')" class='flex justify-center items-center bg-primary-400 hover:bg-primary-500  
                        mx-2 h-8 w-8 rounded-full focus:outline-none ' ><img src="{{asset('icona/article_white_24dp.svg')}}"/></a>
         </div>     
      </div> 
         
         <p class="truncate text-gray-500 text-sm">
            @if ($proizvod->tekst!="")
               natpis {{$proizvod->tekst}},
            @endif
            visina {{$proizvod->visina}} cm,
            širina {{$proizvod->sirina}} cm,
            @isset($proizvod->font)
               font {{$proizvod->font->naziv}},
            @endisset
            materijal {{$proizvod->materijal->naziv}}
            @isset($proizvod->oblik)
               , oblik {{$proizvod->oblik->naziv}}
            @endisset
            .
         </p>
         <span class="pt-2 text-primary-600 font-semibold text-right  text-lg">Cijena: 
    
         {{$proizvod->cijena}} KM</span>
      
   </div>

   
  
</div>
<script>

function DetaljiProizvoda(proizvod){
   var aslika=document.getElementById("aslika");
   var imgslika=document.getElementById("imgslika");


   var naziv=document.getElementById("DNaziv");
   var t=document.getElementById("DTekst");
   var v=document.getElementById("DVisina");
   var sirina=document.getElementById("DSirina");
   var f=document.getElementById("DFont");
   var m=document.getElementById("DMaterijal");
   var o=document.getElementById("DOblik");
   var novo=document.getElementById("DNovo");
   var p=document.getElementById("DPopust");
   var d=document.getElementById("DDostupno");
   var c=document.getElementById("DCijena");
   var obj=JSON.parse(proizvod);
   //alert(obj.visina);
   var name=obj.image.name;
   ///alert(name);
   var s='{{ URL::asset('thumb') }}'+'/'+name;
   var hrf='{{ URL::asset('slike') }}'+'/'+name;

  aslika.href=hrf;
  imgslika.src=s;


   if(obj.tekst!=""){
      t.innerHTML=obj.tekst;
   }
   if(obj.visina!=""){
      v.innerHTML=obj.visina;
   }
   if(obj.sirina!=""){
      sirina.innerHTML=obj.sirina;
   }
   if(obj.kategorija.naziv!=""){
      naziv.innerHTML=obj.kategorija.naziv;
   }
   if(obj.fonts_id!=null){
      f.innerHTML=obj.font.naziv;
   }
   if(obj.materijals_id!=null){
      m.innerHTML=obj.materijal.naziv;
   }
   if(obj.obliks_id!=null){
      o.innerHTML=obj.oblik.naziv;
   }
   if(obj.novo){
      novo.innerHTML="Da";
   }
   if(obj.aktivan){
      d.innerHTML="Da";
   }
   p.innerHTML=obj.popust; 
   c.innerHTML=obj.cijena; 

   Show("BODetalji" ,"MPDetalji","MDetalji");
}


</script>