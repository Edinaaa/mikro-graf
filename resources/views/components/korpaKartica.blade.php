@props(['narudzba'=>'$narudzba'])

     <!-- Start of component -->
     <div class="max-w-xl  m-2 flex flex-col md:flex-row   bg-white border-2 border-gray-300 p-5 rounded-md tracking-wide shadow-lg">
     @isset($narudzba->image)

<div> <img class="flex flex-col  justify-between w-full 
      shadow-md  object-cover object-center"
      src="{{asset('images/'.$narudzba->image->name)}}"/></div>
@endisset
<div  class="flex justify-between  flex-col ml-5">
            <div>
               
               <h4  class=" uppercase text-primary-600 text-xl  my-4">{{$narudzba->artikal->naziv}}</h4>
               <p  class="text-gray-800 mt-2">Natpis {{$narudzba->tekst}},
                  @isset($narudzba->font)
                  font {{$narudzba->font->naziv}},
                  @endisset
                  dimenzije visina {{$narudzba->visina}}cm i sirina {{$narudzba->sirina}}cm, 
                  @isset($narudzba->oblik)
                  oblik {{$narudzba->oblik->naziv}}, 
                  @endisset
                  
                  materijal {{$narudzba->materijal->naziv}}.
               </p>

               @if ($narudzba->opis!="")
                  <p class="text-gray-800 mt-1"><span class="text-black text-lg">
                  Opis:</span>  {{$narudzba->opis}}
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
