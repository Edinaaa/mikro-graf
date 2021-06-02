@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 "> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center  ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2 mt-8">
                  
                        <form action="{{ route('galerija') }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Nova slika</h1>
                              </div>
                              </div>

                              <x-input id="galerijaName" label="Naziv slike" value="" class="mt-5 mx-7"></x-input>
                              <x-input type="file" id="file" label="slika" value="" class="mt-5 mx-7"></x-input>

                              
                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Dodaj</button>
                              </div>
                        </form>         
                  </div>
            @endif
      @endauth
</div>
            
      @if ($slike->count())
            <div class="w-full bg-gray-200 pl-14 py-1 rounded-lg grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 ">
                  @foreach($slike as $slika)
                        <x-slika :slika="$slika"/>
                  @endforeach
            </div>
                              
            {{$slike->links()}}<!--paging koristeci tailwind-->
      @else
            <p>Galerija je prazna.</p>
      @endif
               
</div>
@endsection