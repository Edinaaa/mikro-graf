@extends('layouts.app')

@section('content')

<div class=" flex  w-full  bg-gray-200 items-center justify-center mt-8 ">

        <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
            

            <div class="flex justify-center pt-4">
                <div class="flex">
                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Posaljite poruku</h1>
                </div>
            </div>
            <form action="{{ route('razgovor') }}" method="post" enctype="multipart/form-data">
                 @csrf
              
                 <div class="grid grid-cols-1 mt-5 mx-7">
      <label for="primaoc_id" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Primaoc</label>
      <select name="primaoc_id" id="primaoc_id" class="py-2 px-3 rounded-lg border-2 border-primary-200 mt-1 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
       
                <option value="0" selected>odaberite</option>

                @if($primaoci->count())
                    @foreach ($primaoci as $primaoc)
                        
                    <option value="{{$primaoc->id}}">{{$primaoc->name}} {{$primaoc->lastname}}</option>
                    @endforeach
                @endif
                </select> 
              </div>
                <x-input id="tema" label="Tema" value="" class="mt-5 mx-7"></x-input>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Sadrzaj</label>
                    <textarea id="sadrzaj" class=" rounded-lg p-2 border-2 border-solid border-primary-300"
                    name="sadrzaj" rows="4" cols="50"></textarea>
                </div>

                <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                    <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Posalji</button>
                </div>
            </form>
        </div>
    </div>
@endsection