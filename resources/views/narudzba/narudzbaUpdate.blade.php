@extends('layouts.app')

@section('content')
<div class="container mx-auto   px-4"> 
<div class=" flex  w-full  bg-gray-200 items-center justify-center pt-8 ">
      @auth
            @if(auth()->user()->hasRole('admin'))
                  <div class="grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                  
            <form method="POST" action="{{ route('narudzba.update',$narudzba->id) }}">
                    @csrf
                    <div class="flex justify-center pt-4">
                              <div class="flex">
                                    <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Narudzba</h1>
                              </div>
                              </div>
                    <x-input id="cijena" label="cijena" value="{{ old('cijena')}}" class="mt-5 mx-7">
                    @error("cijena")
                              <div for="cijena" class=" flex items-center font-medium text-red-500 text-xs mt-1 ml-1" >
                              {{$message}}
                              </div>
                              @enderror
                    </x-input>
                  
                  <div class="col-span-6 sm:col-span-3 mt-5 mx-7">
                        <label for="stanjes_id" class="block text-sm font-medium text-gray-700">Stanje narudzbe</label>
                        <select id="stanjes_id" name="stanjes_id" autocomplete="stanjes_id" class="mt-1 block w-full py-2 px-3 border border-primary-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                              <option>Odaberi</option>
                              @foreach ($stanja as $stanje)
                              <option value="{{$stanje->id}}">{{$stanje->naziv}}</option>
                              @endforeach
                        </select>
                  </div>
                   
                   
                    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Izmjeni</button>
                    </div>
          </form>
                  
                  </div>
            @endif
      @endauth
</div>
            
    
               
</div>
@endsection