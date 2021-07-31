@extends('layouts.app')

@section('content')
<div class=" absolute top-0 flex-col">
    <div class=" relative flex flex-row justify-items-center h-screen  w-full object-fill">
        <img class=" shadow-2xl w-full" src="https://source.unsplash.com/random/1280x720" alt="">
        
        <div class=" absolute flex flex-row w-full justify-center items-center bottom-10 text-5xl  text-primary-600">
            <p class="flex justify-center">Dobro dosli</p>
        </div>
    </div>

<div class="w-full flex-row md:flex items-center bg-gray-100 m-1 ">           
    <div class=" w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="https://source.unsplash.com/random/1280x720" alt="">
    </div>
    <div class="w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Odaberite i narucite neki od nasih proizvoda.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('proizvodi')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Odaberi</a>
         </div>

    </div>

</div>

<div class="w-full flex-row md:flex items-center bg-gray-100 m-1 ">           
    
    <div class="w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Pregledajte slike proizvoda koje mi nudimo.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('galerija')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Prelgedaj</a>
         </div>

    </div>
    <div class=" w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="https://source.unsplash.com/random/1280x720" alt="">
    </div>

</div>
<div class="w-full flex-row md:flex items-center bg-gray-100 m-1 ">           
    <div class=" w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="https://source.unsplash.com/random/1280x720" alt="">
    </div>
    <div class="w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Zalite naruciti unikatan proizvod? </p>
        <p class="text-gray-900 text-2xl">Ovdje mozete da navedete sve vase zahtjeve.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('narudzba')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</a>
         </div>

    </div>

</div>

<div class="w-full flex-row md:flex items-center bg-gray-100 m-1 ">           
    
    <div class="w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Trebate vise informacija? Jevite nam se.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('kontakt')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Javi se</a>
         </div>

    </div>
    <div class=" w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="https://source.unsplash.com/random/1280x720" alt="">
    </div>

</div>

<div class="w-full flex-row md:flex items-center bg-gray-100 m-1 ">           
    <div class=" w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="https://source.unsplash.com/random/1280x720" alt="">
    </div>
    <div class="w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Saznajte nesto vise o nama.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('onama')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>O nama</a>
         </div>

    </div>

</div>

<div class="w-full flex-row md:flex items-center bg-gray-100 m-1 ">           
    
    <div class="w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Registrujte se kod nas, kako bi imali vise uvida u nasu suradnju.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('register')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Registruj se</a>
         </div>

    </div>
    <div class=" w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="https://source.unsplash.com/random/1280x720" alt="">
    </div>

</div>
</div>
@endsection
