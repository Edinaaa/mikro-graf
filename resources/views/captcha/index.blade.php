@extends('layouts.app')

@section('content')
<div class="container mx-auto pl-14  px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
     
        <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
        
              <form action="{{ route('captchaValidate') }}" method="post" >
                    <!-- Add CSRF Token -->
                    @csrf
                    <div class="flex justify-center pt-4">
                        <div class="flex">
                            <h1 class="text-gray-600 font-bold md:text-2xl text-xl">captcha</h1>
                        </div>
                    </div>
                    <x-input id="name" label="name" value="{{ old('name')}}" class="mt-5 mx-7"></x-input>
                    <x-input type="email" id="email" label="email" value="" class="mt-5 mx-7"></x-input>
                    <x-input id="username" label="username" value="" class="mt-5 mx-7"></x-input>
                   <div  class="flex justify-center">
                        <span id="span">{!! captcha_img() !!}</span>
                        <button type="button"  id="reload" class='w-auto bg-red-400 hover:bg-red-600 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                            &#x21bb;
                        </button>
                   </div>
                   <x-input id="captcha" label="captcha" value="" class="mt-5 mx-7">
                   @error("captcha")
        <div for="captcha" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
            @if($message=="validation.captcha")
                <p id="validacija">Netacan unos.</p>
            @else
            {{$message}}
            @endif
        </div>
        @enderror
                   </x-input>
                    
                    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                    </div>
              </form>         
        </div>
           
</div>
            
    @if ($errors->any())
        <div class="w-full text-red-500 bg-red-200 py-1 rounded-lg flex flex-col items-center">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
               
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

   //https://www.positronx.io/laravel-captcha-tutorial-example/
    function Reload() {
        $.ajax({
            type: 'GET',
            url: '{{url("/reload-captcha")}}',
            success: function (data) {
                $("#span").html(data.captcha);
            }
        });
    } 
   

    $('#reload').click(Reload());
</script>
@endsection