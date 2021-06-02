@props(['narudzba'=>'$narudzba'])

     <!-- Start of component -->
     <div class="max-w-xl  m-2  bg-white border-2 border-gray-300 p-5 rounded-md tracking-wide shadow-lg">
      
         <div  class="flex justify-between  flex-col ml-5">
            <div>
               <h4  class=" uppercase text-primary-600 text-xl  mb-2">{{$narudzba->naziv}}</h4>
               <p  class="text-gray-800 mt-2">Natpis fali, font {{$narudzba->font->naziv}},
                  dimenzije visina {{$narudzba->visina}} i sirina {{$narudzba->visina}}, 
                  @isset($narudzba->oblik)
                  oblik {{$narudzba->oblik->naziv}}, 
                  @endisset
                  
                  materijal {{$narudzba->font->naziv}}.
               </p>

               @if ($narudzba->opis!="")
                  <p class="text-gray-800 mt-1"><span class="text-black text-lg">Opis:</span>  {{$narudzba->opis}}
                     kkkkkkkkkkkk kkkkmaaaaaaaaaa aaaaaaa aaaaaaaaaapo dddddvdd 
                     dddddddddddddd ddooooooooo  ooooodddd   ddddddd ddddddddd  dddiiiiiii iiiiiiiiiii 
                     dddddddddd
                  </p>
                   
               @endif
            </div>
            
            <div class="flex  justify-between flex-col sx:flex-row sm:flex-row  lg:flex-col xl:flex-row  mt-5">
               <p class="">Naruceno   {{$narudzba->created_at->diffForHumans()}}</p>
               <p class="text-primary-600 font-semibold text-lg">Cijena 
               @if ($narudzba->cijena!='0')
               {{$narudzba->cijena}} KM
               @else
               nije odredena.
               @endif
            
              </p>

            </div>
         </div>
      </div>
   
   <!-- End of component -->
