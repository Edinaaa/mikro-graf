<div class="col-span-6 sm:col-span-3 mt-5 mx-7">
                              <label for="materials" class="block text-sm font-medium text-gray-700">Materijali za kategoriju</label>
                              <div class="flex-grow overflow-y-auto max-h-40">
                                    <div class="w-full   rounded-lg flex flex-col ">
                                    
                                          @foreach($materijali as $objekat)
                                          <a href="{{route('materijal.SelektAdd', $objekat->id)}}">
                                          <div class=" flex flex-col items-start justify-center bg-gray-50 
                                          border-primary-300 hover:bg-gray-200 hover:shadow-l focus:bg-primary-200 border-2 m-2 rounded-lg" >
                                                <p  class="w-2/3 text-lg pl-2 ">Naziv: {{$objekat->naziv}}</p>
                                                @if ($objekat->visina!=0 || $objekat->sirina!=0)

                                                <div class="w-2/3 text-lg pl-2 ">Dimenzije: 
                                                      @if($objekat->visina!=0)
                                                      <p>   v{{$objekat->visina}}cm</p> 
                                                      @endif
                                                      @if($objekat->sirina!=0)
                                                      <p>   š{{$objekat->sirina}}cm</p> 

                                                      @endif
                                                </div>
                                                @endif
                                                
                                                
                                          
                                          </div>
                                          </a>
                                          @endforeach
                                    </div>
                              </div>
              