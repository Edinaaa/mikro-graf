@extends('layouts.app')

@section('content')
<div class="w-full h-full flex flex-col justify-items-center items-center py-10">
<div  class=" grid bg-white mb-4 rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2 mt-8">
                
<form action="{{ route('proizvod.update',$proizvod->id) }}" method="post" enctype="multipart/form-data">
                              <!-- Add CSRF Token -->
                              @csrf
                              <div class="flex justify-center pt-4">
                                    <div class="flex">
                                          <h1 class="text-gray-600 font-bold md:text-2xl text-xl">Proizvod</h1>
                                    </div>
                              </div>
                         
                              <x-input id="tekst" label="tekst" value="{{$proizvod->tekst}}" class="mt-5 mx-7"></x-input>

                               <div  class="flex flex-row items-center justify-start w-full  mt-5 mx-7">
                                    <div class=" w-3/5">
                                          <x-input id="artikal" label="artikal" value="{{$proizvod->artikal->naziv}}"></x-input>
                                          <x-input class="hidden" id="artikal_id" label="artikal_id" value="{{$proizvod->artikal->id}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOartikal','MPartikal','Martikal')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Artikal</button>
                                    
                                    </div>
                              </div>
                              
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                                    <x-input id="visina" label="Visina" value="{{$proizvod->visina}}"></x-input>
                                    <x-input id="sirina" label="Sirina" value="{{$proizvod->sirina}}"></x-input>
                              </div>
                              @isset($proizvod->oblik)
                              <div  id="divOblik" class="flex flex-row justify-start items-center w-full  mt-5 mx-7">
                                    <div class=" w-3/5 ">
                                          <x-input id="oblik" label="Oblik" value="{{$proizvod->oblik->naziv}}"></x-input>
                                          <x-input class="hidden" id="oblik_id" label="oblik_id" value="{{$proizvod->oblik_id}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4 ">
                                          <button type="button" onClick="Show('BackgroundOverlay','ModalPanel','modal')"
                                          class='py-2 px-4 mt-5 flex items-center justify-center  bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl
                                          font-medium text-white '>
                                          Oblik</button>
                                    
                                    </div>
                              </div>
                              @endisset 
                              
                            

                              <div  class="flex flex-row items-center justify-start w-full  mt-5 mx-7">
                                    <div class=" w-3/5">
                                          <x-input id="font" label="Font" value="{{$proizvod->font->naziv}}"></x-input>
                                          <x-input class="hidden" id="font_id" label="font_id" value="{{$proizvod->font->id}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOfont','MPfont','Mfont')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Font</button>
                                    
                                    </div>
                              </div>

                              <div  class="flex flex-row items-center justify-start w-full pr-4 mt-5 mx-7">
                                    <div class="w-3/5">
                                          <x-input id="materijal" label="Materijal" value="{{$proizvod->materijal->naziv}}"></x-input>
                                          <x-input class="hidden" id="materijal_id" label="materijal_id" value="{{$proizvod->materijal->id}}"></x-input>
                                    </div>

                                    <div class="w-1/4 ml-4">
                                    <button type="button" onClick="Show('BOmaterijal','MPmaterijal','Mmaterijal')" 
                                    class='py-2 px-4 mt-5 flex items-center justify-center   bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white '>
                                    Materijal</button>
                                    
                                    </div>
                              </div>


                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8  mt-5   mx-7">
                                    <x-input id="popust" label="Popust" value="{{ $proizvod->popust}}"></x-input>
                                     <x-input  id="cijena" label="cijena" value="{{ $proizvod->cijena}}"></x-input>
                              </div>

                              <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8  mt-5   mx-7">

                                    <x-input type="checkbox" checked="{{ $proizvod->aktivan}}" id="aktivan[]" label="aktivan" value="{{ $proizvod->aktivan}}"></x-input>
                                     <x-input type="checkbox" id="novo[]" label="novo" value="{{ $proizvod->novo}}"></x-input>
                              </div> 
                              <x-input type="file" id="file" label="slika" value="{{ old('file')}}" class="mt-5 mx-7"></x-input>


                              <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                              
                                   
                                    <button type="submit" class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Izmjeni</button>
                             
                              </div>
                        </form>
</div>  
</div>    
<script>
   
</script>
@endsection
