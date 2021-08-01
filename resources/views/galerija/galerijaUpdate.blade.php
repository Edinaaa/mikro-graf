@extends('layouts.app')

@section('content')
<div class="container mx-auto   px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
                  <form method="POST" action="{{ route('galerija.update',$galerija->id) }}" enctype="multipart/form-data">
                    @csrf
                  
                    <x-input id="name" label="Naziv slike" value="{{ $galerija->name}}" class="mt-5 mx-7">
                    @error("name")
                    <div for="name" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                    {{$message}}
                    </div>
                    @enderror
                    </x-input>
                    <x-input type="file" id="file"  label="slika" value="" class="mt-5 mx-7"></x-input>

                   
                    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <button type="submit"  class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Snimi</button>
                    </div>
                 </form>
                
                  </div>
            @endif
      @endauth
</div>
            
    
               
</div>
@endsection