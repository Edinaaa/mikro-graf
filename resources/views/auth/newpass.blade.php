@extends('layouts.app')

@section('content')
<div class=" flex h-screen bg-gray-200 items-start justify-center my-40  md:my-32">
  <div class="grid bg-white rounded-lg shadow-xl  w-11/12 md:w-9/12 lg:w-1/2">
    

    <div class="flex justify-center pt-4">
      <div class="flex">
        <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Nova lozinka</h1>
      </div>
    </div>
    <form method="POST" action="{{ route('novalozinka') }}">
       @csrf
      <x-input id="email" type="email" label="email" value="{{$ResetPass->email}}"  class="hidden"></x-input>
      <x-input id="ResetPassId" label="ResetPassId" value="{{$ResetPass->id}}" class="hidden"></x-input>

       <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
      <x-input id="password" type="password" label="Lozinka" value="" ></x-input>
      <x-input id="password_confirmation" type="password" label="Lozinka potvrda" value="" ></x-input>
      @error("password")
        <div for="password" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
        {{$message}}
        </div>
        @enderror
      </div>
   
    

    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
      <button class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Snimi</button>
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
            url: '{{url("/reload-captcha")}}',
            success: function (data) {
                $("#span").html(data.captcha);
            }
        });
    } );
</script>
@endsection

