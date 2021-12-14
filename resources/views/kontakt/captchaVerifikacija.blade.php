@extends('layouts.app')
@section('title','Captcha')

@section('content')
<div class=" h-screen flex-col " >           
 
    <div class="flex items-center justify-center w-full mt-4 ">
        <div class="flex-col w-11/12 md:w-9/12 lg:w-1/2"> 
            <p class="flex-row text-gray-900 font-semibold text-2xl pl-3">Kontaktirajte nas</p>
            <hr class="flex-row border-primary-600 border-2 ">
           
        </div>
    </div>
   
    <div class=" flex  w-full  bg-gray-200 items-center justify-center mt-8 ">
        <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            

            <div class="flex justify-center pt-4">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Unesite captchu</h1>
                </div>
            </div>
            <form name="KontaktCaptchafrm"  action="{{route('kontaktCaptcha')}}" method="post">
                 @csrf

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 my-5 mx-7">
                                    <div  class="flex  flex-row justify-start items-end ">
                                        <span id="span">{!! captcha_img() !!}</span>
                                        <button type="button"  id="reload" class='w-auto py-2 px-4 mx-3 my-1 bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                            &#x21bb;
                                        </button>
                                    </div>
                                
                                <x-input id="captcha" label="captcha" value="" >
                                    @error("captcha")
                                            <div for="captcha" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                                                @if($message=="validation.captcha")
                                                    <p id="validacija">Netačan unos.</p>
                                                @else
                                                {{$message}}
                                                @endif
                                            </div>
                                    @enderror
                                    <div id="errorcaptcha" class="  flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                             
                             </div>
                                </x-input>
                            
                        </div>
            
                <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                    <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Pošalji</button>
                </div>
            </form>
        </div>
    </div>  
   
    
<div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

const spanelement = document.getElementById('span');
spanelement.children[0].classList.add("w-40");
   //https://www.positronx.io/laravel-captcha-tutorial-example/
   $('#reload').click(function Reload() {
        $.ajax({
            type: 'GET',
            url: '{{url("/reload-kontaktcaptcha")}}',
            success: function (data) {
                $("#span").html(data.captcha);
            }
        });
    } );
</script>

@endsection
@section('footer-scripts')
      @include('scripts.formValidacija')
@endsection