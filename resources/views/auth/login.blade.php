@extends('layouts.app')
@section('title','Login')

@section('content')
<div class=" flex h-screen bg-gray-200 items-start justify-center my-40  md:my-32">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    

    <div class="flex justify-center pt-4">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Login</h1>
      </div>
    </div>
    <form name="loginfrm" onsubmit="return validateLoginForm('loginfrm')" method="POST" action="{{ route('login') }}">
          @csrf
        <x-input id="email" type="email" label="Email" value="" class="mt-5 mx-7">
        @error("email")
        <div for="email" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        {{$message}}
        </div>
        @enderror
        <div id="erroremail" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
                             </div>
        </x-input>
        <x-input id="password" type="password" label="Lozinka" value="" class="mt-5 mx-7">
        @error("password")
        <div for="password" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        {{$message}}
        </div>
        @enderror
        <div id="errorpassword" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
        </div>
        </x-input>

        <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
          <a class='w-auto bg-white hover:bg-primary-300 rounded-lg shadow-xl font-medium text-primary-600 px-4 py-2' href="{{route('register')}}">Registuj se</a>
          <button class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Login</button>
        </div>
    </form>
    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
          <a class='w-auto bg-white hover:bg-primary-300 rounded-lg shadow-xl font-medium text-primary-600 px-4 py-2' href="{{route('resetpassword')}}">Zaboravili ste lozinku?</a>
    </div>
  </div>
</div>

<script>
 
 

</script>
@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection