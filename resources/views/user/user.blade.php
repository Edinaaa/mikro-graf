@extends('layouts.app')
@section('title','Postavke računa')

@section('content')
         
<div class=" flex h-screen bg-gray-200 items-start justify-center ">
  <div class="grid bg-white rounded-lg shadow-xl  my-10  w-11/12 md:w-9/12 lg:w-1/2">
    

    <div class="flex justify-center pt-4">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Postavke korisničkog računa</h1>
      </div>
    </div>
    <form name="userfrm" onsubmit="return validateUserForm('userfrm')"  method="POST" action="{{ route('user.update',$user->id) }}">
     @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
        <x-input id="name"  label="Ime"  value="{{ $user->name}}" >       
          @error("name")
            <div for="name" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
            {{$message}}
            </div>
          @enderror
          <div id="errorname" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
          </div>
        </x-input>
        <x-input id="lastname"  label="Prezime" value="{{  $user->lastname}}" >
          @error("lastname")
            <div for="lastname" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
            {{$message}}
            </div>
          @enderror
          <div id="errorlastname" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
          </div>
        </x-input>
      </div>
      <x-input id="telefon"  label="Telefon" value="{{  $user->telefon}}" class="mt-5 mx-7">
        @error("telefon")
        <div for="telefon" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        {{$message}}
        </div>
        @enderror
        <div id="errortelefon" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
        </div>
      </x-input>

      <x-input id="email" type="email" label="Email" value="{{  $user->email}}" class="mt-5 mx-7">
        @error("email")
        <div for="email" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        {{$message}}
        </div>
        @enderror
        <div id="erroremail" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
        </div>
      </x-input>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
        <x-input id="password" type="password" label="Lozinka" value="" >
          <div id="errorpassword" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              
          </div>
        </x-input>
        <x-input id="password_confirmation" type="password" label="Lozinka potvrda" value="" ></x-input>
        @error("password")
        <div for="password" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        {{$message}}
        </div>
        @enderror
        <div id="errorpassword_confirmation" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
        </div>
      </div>
   
      <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
        <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Snimi</button>
      </div>
    </form>
  </div>
</div>


@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection