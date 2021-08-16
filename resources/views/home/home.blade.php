@extends('layouts.app')

@section('content')
<div class=" absolute top-0 flex-col">
    <div class=" relative flex flex-row justify-items-center mt-12 h-60 md:m-0 md:h-screen  w-full object-fill">
        <img class=" shadow-2xl w-full"  src="{{asset('slike-stranica/pexels-cottonbro-7480234.jpg')}}">
       
        
        <div class=" absolute flex flex-col w-full justify-center items-start  bottom-2 md:bottom-10 pl-2 md:pl-8">
            <p class=" text-xl md:text-5xl  text-primary-600">Dobro došli,</p>
            <p class="text-gray-700 text-base md:text-2xl  leading-4">nadamo se da ćemo <br>ispuniti Vaša očekivanja.</p>
        </div>
    </div>


<div class="w-full flex flex-col md:flex-row  justify-center items-center bg-gray-100  ">           
    <div class=" w-11/12 md:w-1/2 flex items-center  justify-center p-1 m-1 lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="{{asset('slike-stranica/bihac.jpg')}}">
    </div>
    <div class="w-11/12 md:w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Odaberite i narucite neki od nasih proizvoda.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('proizvodi')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Odaberi</a>
         </div>

    </div>

</div>



<div class="w-full flex flex-col-reverse md:flex-row items-center bg-gray-100 m-1 ">           
    
    <div class=" w-11/12 md:w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Pregledajte slike proizvoda koje mi nudimo.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('galerija')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Prelgedaj</a>
         </div>

    </div>
    <div class="  w-11/12 md:w-1/2 flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="{{asset('slike-stranica/IMG_20190327_214938.jpg')}}">
    </div>

</div>
<div class="w-full  flex flex-col md:flex-row  items-center bg-gray-100 m-1 ">           
    <div class="  w-11/12 md:w-1/2  flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="{{asset('slike-stranica/jelovnici.jpg')}}">
    </div>
    <div class=" w-11/12 md:w-1/2    flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Zalite naruciti unikatan proizvod? </p>
        <p class="text-gray-900 text-2xl pl-3 pt-1">Ovdje mozete da navedete sve vase zahtjeve.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('narudzba')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Naruci</a>
         </div>

    </div>

</div>

<div class="w-full flex flex-col-reverse md:flex-row items-center bg-gray-100 m-1 ">           
    
    <div class=" w-11/12 md:w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Trebate vise informacija? Jevite nam se.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('kontakt')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Javi se</a>
         </div>

    </div>
    <div class="  w-11/12 md:w-1/2  flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="{{asset('slike-stranica/kontakt.jpg')}}">
    </div>

</div>

<div class="w-full  flex flex-col md:flex-row  items-center bg-gray-100 m-1 ">           
    <div class=" w-11/12 md:w-1/2  flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="{{asset('slike-stranica/5.jpg')}}">
    </div>
    <div class=" w-11/12 md:w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Saznajte nesto vise o nama.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('onama')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>O nama</a>
         </div>

    </div>

</div>

<div class="w-full flex flex-col-reverse md:flex-row items-center bg-gray-100 m-1 ">           
    
    <div class=" w-11/12 md:w-1/2   flex flex-col items-center justify-center  p-1 m-1 lg:p-4 md:m-4 ">
        <p class="text-gray-900 font-semibold  text-4xl pl-3">Registrujte se kod nas, kako bi imali vise uvida u nasu suradnju.</p>
        <div class='flex items-center justify-center   py-5'>
        <a href="{{route('register')}}" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Registruj se</a>
         </div>

    </div>
    <div class="  w-11/12 md:w-1/2  flex p-1 m-1  lg:p-4 md:m-4">
            <img class="rounded-lg shadow-md" src="{{asset('slike-stranica/register.jpeg')}}">
    </div>

</div>
</div>
@endsection
