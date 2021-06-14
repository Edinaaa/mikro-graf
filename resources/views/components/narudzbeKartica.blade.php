@props(['narudzba'=>'$narudzba','korpe'=>'$korpe'])

     <!-- Start of component -->
<div class="max-w-xl  m-2 flex flex-col   bg-white border-2 border-gray-300 hover:bg-primary-200 p-5 rounded-md tracking-wide shadow-lg">
@auth
               

    <a href="{{route('korpa', $narudzba->id)}}">
        <div class=" font-semibold text-gray-700 w-full flex flex-col md:flex-row justify-between items-center">
           
            @isset($narudzba->user)
            <p>Narucilac: {{$narudzba->user->name}} {{$narudzba->user->lastname}}</p>
            @endisset
            
            @isset($narudzba->email)
            <div class="flex flex-col">
            <p>Narucilac: {{$narudzba->email}} <span>tel: {{$narudzba->telefon}}</span> </p>

            </div>
            @endisset
            <p class="text-primary-500 text-lg">Cijena: {{$narudzba->cijena}} KM</p>
        </div>
  
        <div class="pt-2 w-full flex flex-col md:flex-row justify-between items-center">
           @auth
               <p><span class="font-semibold"> Nardzba:</span>   @foreach ($korpe as $korpa)
                        @if ($korpa->narudzbas_id==$narudzba->id)
                        {{$korpa->kolicina}}x {{$korpa->artikal->naziv}},
                        @endif
                        @endforeach
                </p>
              
           @endauth
           
        </div>
   
       
        <div  class="pt-4 text-gray-600 text-sm w-full flex flex-col md:flex-row justify-between items-center">
            
            <p>Stanje: {{$narudzba->stanje->naziv}}</p>
            <p>Naruceno prije: {{$narudzba->created_at->diffForHumans()}}</p>
        </div>
    </a>
    @endauth
</div>