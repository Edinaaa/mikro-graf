@extends('layouts.app')
@section('title','Verifikacija broja mobitela')

@section('content')
<div class="container mx-auto  px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
     
        <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
        
              <form name="telefonfrm" onsubmit="return validateTelefonKoodForm('telefonfrm')" action="{{ route('TelefonVerifikacija') }}" method="post" >
                    <!-- Add CSRF Token -->
                    @csrf
                    <div class="flex justify-center pt-4">
                        <div class="flex">
                            <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Verifikacija broja mobitela</h1>
                        </div>
                    </div>
                    
                    <label  class=" my-5  mx-7  text-xs text-gray-500 text-light font-semibold">Ukoliko ste unijeli ispravne podatke, dobiti ćete poruku sa koodom na vaš broj mobitela.</label>
          
            <x-input id="verifikacioni_code" label="Unesite kood" class=" my-5  mx-7" value="{{ old('verifikacioni_code')}}">
                @error("verifikacioni_code")
                <div for="verifikacioni_code" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                    {{$message}}
                </div>
           
                @enderror
                <div id="errorverifikacioni_code" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
                </div>
            </x-input>

       
                    
                    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <button type="submit"  class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Završi</button>
                    </div>
              </form>         
        </div>
       
           
</div>
   
               
</div>

@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection