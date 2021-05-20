@extends('layouts.app')

@section('content')
<div class=" h-screen flex-col " >           
    <!--div class=" flex-row   md:flex items-start  m-1 md:p-2 h-4/5 xs:h-5/6 md:h-4/6 ">           
    
        <div class="flex-1 p-1 sm:m-1">
            <p class="text-gray-900 font-semibold text-2xl pl-3">Kontaktirajte nas</p>
            <hr class=" border-primary-600 border-2 ">
           
            <ul class="list-disc text-gray-700 text-md leading-tight xs:leading-snug md:leading-normal lg:text-lg mt-4 pl-8">
                <li>Kontaktirati nas mozete porukom putem nase web stranice.</li>
                <li>Javite nam se putem email-a na nasu email adresu edi@nesto.com.</li>
                <li>Mozete nas potraziti u nasoj poslovnic mikro-graf na lokaciji prikazanoj na mapi.</li>
                <li>Mozete nam se javiti na borj telefona 061 240 862 ,te putem drustenih mreza.</li>
                <li>Posjetite nas na nasoj facebook stranici <a class="text-primary-600 hover:bg-primary-200 p-1 rounded-md " target="_blank" href="https://www.facebook.com/mikrograf1/">mikrograf.</a></li>
            </ul> 
        </div>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1415.1514610675677!2d15.863238571983452!3d44.815393069301884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47614181b439707f%3A0xf23701fe07b59cab!2sMikroGraf!5e0!3m2!1sbs!2sba!4v1620781472858!5m2!1sbs!2sba"
            class=" rounded-xl lg:rounded-md h-2/5 xs:h-1/2 sm:h-3/5 md:h-full w-full flex-1 px-2 lg:p-0 mt-4 sx:mt-2 md:mt-0" allowfullscreen="" loading="lazy">
        </iframe>

    </div-->
    <div class="flex items-center justify-center w-full mt-4 ">
        <div class="flex-col w-11/12 md:w-9/12 lg:w-1/2"> 
            <p class="flex-row text-gray-900 font-semibold text-2xl pl-3">Kontaktirajte nas</p>
            <hr class="flex-row border-primary-600 border-2 ">
        
            <ul class="flex-row list-disc text-gray-700 text-md leading-tight xs:leading-snug md:leading-normal lg:text-lg mt-4 pl-8">
                <li>Kontaktirati nas mozete porukom putem nase web stranice.</li>
                <li>Javite nam se putem email-a na nasu email adresu edi@nesto.com.</li>
                <li>Mozete nas potraziti u nasoj poslovnic mikro-graf na lokaciji prikazanoj na mapi.</li>
                <li>Mozete nam se javiti na borj telefona 061 240 862 ,te putem drustenih mreza.</li>
                <li>Posjetite nas na nasoj facebook stranici <a class="text-primary-600 hover:bg-primary-200 p-1 rounded-md " target="_blank" href="https://www.facebook.com/mikrograf1/">mikrograf.</a></li>
            </ul> 
        
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1415.1514610675677!2d15.863238571983452!3d44.815393069301884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47614181b439707f%3A0xf23701fe07b59cab!2sMikroGraf!5e0!3m2!1sbs!2sba!4v1620781472858!5m2!1sbs!2sba"
                class="flex-row rounded-xl lg:rounded-md h-56 w-full mt-4 " allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
    <div class=" flex  w-full  bg-gray-200 items-center justify-center mt-8 ">
        <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            

            <div class="flex justify-center pt-4">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Posaljite poruku</h1>
                </div>
            </div>

            <x-input id="email" label="Email" value="" class="mt-5 mx-7"></x-input>

            <x-input id="naslov" label="Naslov" value="" class="mt-5 mx-7"></x-input>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Sadrzaj</label>
                <textarea id="sadrzaj" class=" rounded-lg p-2 border-2 border-solid border-primary-300"
                 name="sadrzaj" rows="4" cols="50"></textarea>
            </div>

        

            <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                <button class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Posalji</button>
            </div>

        </div>
    </div>
<div>

@endsection
