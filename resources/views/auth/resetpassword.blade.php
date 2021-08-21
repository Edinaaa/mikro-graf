@extends('layouts.app')

@section('content')
<div class=" flex h-screen bg-gray-200 items-start justify-center my-40  md:my-32">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    

    <div class="flex justify-center pt-4">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Zaboravljena lozinka</h1>
      </div>
    </div>
    <form name="resetpassfrm" onsubmit="return validateResetPassForm('resetpassfrm')" method="POST" action="{{ route('resetpassword') }}">
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
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 my-5 mx-7">
      <div>
          <label  class="  text-xs text-gray-500 text-light font-semibold">Sadrzaj sa slike prepisite u captcha rubriku.</label>
          <div  class="flex  flex-row justify-start items-center">
              <span id="span">{!! captcha_img() !!}</span>
              <button type="button"  id="reload" class='w-auto mx-2 bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                  &#x21bb;
              </button>
          </div>
      </div>
      <x-input id="captcha" label="captcha" value="" >
          @error("captcha")
            <div for="captcha" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                @if($message=="validation.captcha")
                    <p id="validacija">Netacan unos.</p>
                @else
                {{$message}}
                @endif
            </div>
          @enderror
          <div id="errorcaptcha" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
          </div>
      </x-input>
                            
    </div>

    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
      <button class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dalje</button>
    </div>
    </form>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">

   //https://www.positronx.io/laravel-captcha-tutorial-example/
   $('#reload').click(function Reload() {
        $.ajax({
            type: 'GET',
            url: '{{url("/reloadcaptcha")}}',
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