@extends('layouts.app')

@section('content')
<div class="container mx-auto  px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                        <form action="{{ route('stanje') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Novi stanje</h1>
                              </div>
                              </div>

                              <x-input id="naziv" label="Naziv artikal" value="{{ old('naziv')}}" class="mt-5 mx-7">
                              @error("naziv")
                              <div for="naziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              {{$message}}
                              </div>
                              @enderror
                              </x-input>

                              <x-input type="checkbox" checked="{{ old('aktivan')}}" id="aktivan[]" label="aktivan" class="mt-5 mx-7" value="{{ old('aktivan')}}"></x-input>
                              
                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
      @if ($stanja->count())
            <div class="w-full bg-gray-200  py-1 rounded-lg flex flex-col items-center">
                  @foreach($stanja as $stanje)
                        <x-oblikkartica :oblik="$stanje">
                        @can('update',$stanje)
                  
                  <a href=" {{route('stanje.show', $stanje)}}" class="flex justify-center items-center focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Izmjeni</a>

                  @endcan
                        </x-oblikkartica>
                  @endforeach
            </div>
                              
            {{$stanja->links()}}
      @else
            <p>Nema stanja.</p>
      @endif
               
</div>
@endsection