@extends('layouts.app')

@section('content')
<div class="container mx-auto   px-4"> 
<div class=" flex flex-col  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                        <form action="{{ route('artikal') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Novi Artikal</h1>
                              </div>
                              </div>

                              <x-input id="naziv" label="Naziv artikal" value="{{ old('naziv')}}" class="mt-5 mx-7">
                              @error("naziv")
                              <div for="naziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              {{$message}}
                              </div>
                              @enderror
                              </x-input>
                              <div class="col-span-6 sm:col-span-3 mt-5 mx-7">
                                    <label for="materials" class="block text-sm font-medium text-gray-700">Materijali za artikal</label>
                                    <div class="flex-grow overflow-y-auto max-h-40">
                                          <div class="w-full   rounded-lg flex flex-col ">
                                          
                                                @foreach($materijali as $objekat)
                                          
                                                <div id="{{$objekat->id}}" onClick="Select('{{$objekat->id}}')" class=" flex flex-col items-start justify-center bg-gray-50 
                                                border-primary-300 hover:bg-gray-200 hover:shadow-l focus:bg-primary-200 border-2 m-2 rounded-lg" >
                                                      <p  class="w-2/3 text-lg pl-2 ">Naziv: {{$objekat->naziv}}</p>
                                                      @if ($objekat->visina!=0 || $objekat->sirina!=0)

                                                      <div class="w-2/3 text-lg pl-2 ">Dimenzije: 
                                                            @if($objekat->visina!=0)
                                                            <p>   v{{$objekat->visina}}cm</p> 
                                                            @endif
                                                            @if($objekat->sirina!=0)
                                                            <p>   s{{$objekat->sirina}}cm</p> 

                                                            @endif
                                                      </div>
                                                      @endif
                                                      
                                                      
                                                
                                                </div>
                                                
                                                @endforeach
                                          </div>
                                    </div>
                              </div>
              
                              <x-input type="checkbox" checked="{{ old('aktivan')}}" id="aktivan" label="aktivan" class="mt-5 mx-7" value="{{ old('aktivan')}}"></x-input>
                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
      @if ($artikli->count())
            <div class="w-full bg-gray-200  py-1 rounded-lg flex flex-col items-center">
                  @foreach($artikli as $artikal)
                        <x-oblikkartica :oblik="$artikal">
                        @can('update',$artikal)
                  
                  <a href=" {{route('artikal.show', $artikal)}}" class="flex justify-center items-center focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Izmjeni</a>

                  @endcan
                        </x-oblikkartica>
                  @endforeach
            </div>
                              
            {{$artikli->links()}}
      @else
            <p>Nema artikala.</p>
      @endif
    
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">


   function Select(id) {
     var e= document.getElementById(id);
     var pronaden=false;
        $.ajax({
            type: 'GET',
            url:"{{ url('/materijalselect') }}",
            data: { materijalId: id },
            success: function (data) {
                var  ms= data;

                ms.forEach(function(element) {
                        if(element==id)
                        {pronaden=true;} 
                  }

                  if(pronaden){
                  e.classList.add('bg-primary-200');
                  e.classList.remove('bg-gray-50');}
                  else{
                  e.classList.remove('bg-primary-200');
                  e.classList.add('bg-gray-50');
                  }
            }
        });
      
    } 
</script>
@endsection