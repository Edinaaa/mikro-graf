@extends('layouts.app')

@section('content')
<div class="container mx-auto   px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                        <form  name="stanjeupdatefrm" onsubmit="return validateStanjeForm('stanjeupdatefrm')" action="{{ route('stanje.update',$stanje->id) }}" method="post" >
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Stanje</h1>
                              </div>
                              </div>

                              <x-input id="naziv" label="Naziv stanje" value="{{ $stanje->naziv}}" class="mt-5 mx-7">
                              @error("naziv")
                              <div for="naziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              {{$message}}
                              </div>
                              @enderror
                              <div id="errornaziv" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
                             </div>
                              </x-input>
                              <x-input type="checkbox" checked="{{ $stanje->aktivan}}" id="aktivan[]" label="aktivan" class="mt-5 mx-7" value="{{ $stanje->aktivan}}"></x-input>

                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Snimi</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
    
               
</div>
@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection