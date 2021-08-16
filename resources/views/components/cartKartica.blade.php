@props(['stavka'=>'$stavka'])

     <!-- Start of component -->
     <div class="max-w-xl  m-2 flex flex-col md:flex-row  bg-white border-2 border-gray-300 p-5 rounded-md tracking-wide shadow-lg">
     @isset($stavka['item']->image)

<div> <img class="flex flex-col  justify-between w-full  
      shadow-md  object-cover object-center"
      src="{{asset('images/'.$stavka['item']->image->name)}}"/></div>
@endisset
<div  class="flex justify-between  flex-col ml-5">
            <div>
               
               <h4  class=" uppercase text-primary-600 text-xl  mb-2">{{$stavka['item']->kategorija->naziv}}</h4>
               <p  class="text-gray-800 mt-2">Natpis {{$stavka['item']->tekst}},
                  @isset($stavka['item']->font)
                  font {{$stavka['item']->font->naziv}},
                  @endisset
                  dimenzije visina {{$stavka['item']->visina}} i sirina {{$stavka['item']->sirina}}, 
                  @isset($stavka['item']->oblik)
                  oblik {{$stavka['item']->oblik->naziv}}, 
                  @endisset
                  
                  materijal {{$stavka['item']->materijal->naziv}}.
               </p>

               @if ($stavka['item']->opis!="")
                  <p class="text-gray-800 mt-1"><span class="text-black text-lg">Opis:</span> 
                   {{$stavka['item']->opis}}
                     
                  </p>
                   
               @endif
            </div>
            
            <div class="flex  justify-between flex-col sx:flex-row sm:flex-row  lg:flex-col xl:flex-row  mt-5">
               <p class="">Kolicina  {{$stavka['qty']}}</p>
               <p class="text-primary-600 font-semibold text-lg">
               Cijena {{$stavka['price']}} KM
              </p>

            </div>
         </div>  

       
     
     
      </div>
   
   <!-- End of component -->
