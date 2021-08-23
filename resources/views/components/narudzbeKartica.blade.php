@props(['narudzba'=>'$narudzba','stavke'=>'$stavke'])

     <!-- Start of component -->
<div class="max-w-xl  m-2 flex flex-col   bg-white border-2 border-gray-300 hover:bg-primary-200 p-5 rounded-md tracking-wide shadow-lg">
@auth
               

    <a href="{{route('stavke', $narudzba->id)}}">
        <div class=" font-semibold text-gray-700 w-full flex flex-col md:flex-row justify-between items-start">
           
            @isset($narudzba->user)
            <p class="px-2">Naručilac: {{$narudzba->user->name}} {{$narudzba->user->lastname}}</p>
            @endisset
            
            @isset($narudzba->email)
            <div class="flex flex-col">
                <p class="px-2">Naručilac: {{$narudzba->email}}  </p>
                
                <p class="px-2">Telefon: {{$narudzba->telefon}}</p>
            </div>
            @endisset
            <p class="text-primary-500 text-lg px-2">Cijena: {{$narudzba->cijena}} KM</p>
        </div>
  
        <div class="pt-2 w-full flex flex-col md:flex-row justify-between items-center">
          
               <p class="px-2"><span class="font-semibold"> Nardžba:</span>  
                     @foreach ($stavke as $stavka)
                        @if ($stavka->narudzbas_id==$narudzba->id)
                        @if (auth()->user()->hasRole('admin'))
                        {{$stavka->kolicina}}x {{$stavka->kategorija->naziv}},

                        @else
                        {{$stavka->kolicina}}x {{$stavka->naziv}},

                        @endif
                        @endif
                    @endforeach
                </p>
              
           
        </div>
   
       
        <div  class="pt-4 text-gray-600 text-sm w-full flex flex-col md:flex-row justify-between items-center">
            
            <p class="px-2">Stanje: {{$narudzba->stanje->naziv}}</p>
            <p class="px-2">Naručeno prije: {{$narudzba->created_at->diffForHumans()}}</p>
        </div>
    </a>
    @endauth
</div>