@extends('layouts.app')

@section('content')
         
<div class=" flex h-screen bg-gray-200 items-start justify-center my-10">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    

    <div class="flex justify-center pt-4">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Registracija</h1>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
        <x-input id="ime"  label="Ime" value="" ></x-input>
        <x-input id="prezime"  label="Prezime" value="" ></x-input>
    </div>
    
    <x-input id="email" type="email" label="Email" value="" class="mt-5 mx-7"></x-input>

    <x-input id="password" type="password" label="Lozinka" value="" class="mt-5 mx-7"></x-input>
    <x-input id="passwordConfirmation" type="password" label="Lozinka potvrda" value="" class="mt-5 mx-7"></x-input>

    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
      <button class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Registruj se</button>
    </div>

  </div>
</div>

<script>
 
 

</script>
@endsection