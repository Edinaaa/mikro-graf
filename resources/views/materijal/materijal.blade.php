@extends('layouts.app')

@section('content')
<div class="container mx-auto   px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                        <form action="{{ route('materijal') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Novi materijal</h1>
                              </div>
                              </div>

                              <x-input id="naziv" label="Naziv materijala" value="{{ old('naziv')}}" class="mt-5 mx-7">
                              @error("naziv")
                              <div for="naziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              {{$message}}
                              </div>
                              @enderror
                              </x-input>
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                                    <x-input id="visina" label="Visina u cm" value="{{ old('visina')}}">
                                    @error("visina")
                                    <div for="visina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    {{$message}}
                                    </div>
                                    @enderror
                                    </x-input>
                                    <x-input id="sirina" label="Sirina u cm" value="{{ old('sirina')}}">
                                    @error("sirina")
                                    <div for="sirina" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                    {{$message}}
                                    </div>
                                    @enderror
                                    </x-input>
                              </div>
                              <x-input type="checkbox" id="aktivan[]" label="aktivan" class="mt-5 mx-7" value="{{ old('aktivan[]')}}"></x-input>

                              <x-input type="file" id="file" label="slika" value="" class="mt-5 mx-7"></x-input>

                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
      @if ($materijali->count())
            <div class="w-full bg-gray-200  py-1 rounded-lg flex flex-col items-center">
                  @foreach($materijali as $materijal)
                  <x-oblikkartica :oblik="$materijal">
                  @can('update',$materijal)
                  
                  <a href=" {{route('materijal.show', $materijal)}}" class="flex justify-center items-center focus:outline-none font-semibold focus:bg-primary-600 focus:text-gray-200 px-4 rounded-md hover:text-primary-600">Izmjeni</a>

                  @endcan
                        </x-oblikkartica>
                  @endforeach
            </div>
                              
            {{$materijali->links()}}
      @else
            <p>Nema materijala.</p>
      @endif
               
</div>
@endsection