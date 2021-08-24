@props(['obj'=>'$oblici', 'idoblik'=>'','idBO', 'idMP', 'idM', 'idinputa','input','labela'])
<!-- This example requires Tailwind CSS v2.0+ -->
<div id="{{$idM}}" class="fixed z-10 block inset-0 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div id="{{$idBO}}" class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
   
 
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    
    <div id="{{$idMP}}" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden  shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
        <div class="sm:flex sm:items-start">
          
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
             Odaberite {{$labela}}
            </h3>
            <div class="mt-2">
            <div class="flex-grow overflow-y-auto max-h-96">
                <div class="w-full   rounded-lg flex flex-col ">
                
                    @foreach($obj as $objekat)
                      <div
                      onClick="
                      Odabrano('{{$objekat->id}}','{{$objekat->naziv}}','{{$input}}','{{$idinputa}}','{{$idoblik}}')
                      Hide('{{$idBO}}', '{{$idMP}}', '{{$idM}}')"
                       class=" flex flex-row justify-items-end items-center bg-gray-50 
                       border-primary-300 hover:bg-gray-200 hover:shadow-l  border-2 m-2 rounded-lg" >
                       @if($objekat->image==null)
                        <p class="w-full text-lg p-2 ">Naziv: {{$objekat->naziv}} </p>
                       
                        @endif
                       @isset($objekat->image)
                        <p class="w-2/3 text-lg pl-2 ">Naziv: {{$objekat->naziv}}</p>
                        <div class="p-1 rounded-xl " >
                        
                          <img  class="w-2/3 object-cover object-center" src="{{asset('images/'.$objekat->image->name)}}"/>
                        </div>
                          
                        @endisset
                      </div>

                    @endforeach
                </div>
                </div>
               
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" onClick="Hide('{{$idBO}}', '{{$idMP}}', '{{$idM}}')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
          Zatvori
        </button>
       
      </div>
    </div>
  </div>
</div>



<script>

  function Show(idBO, idMP, idM){
    var bo=document.getElementById(idBO);
    var mp=document.getElementById(idMP);
    var m=document.getElementById(idM);
  
    m.classList.add('block');
    m.classList.remove('hidden');

    m.classList.add('z-10');
    m.classList.remove('z-0');

    bo.classList.add('ease-out');
    bo.classList.add('duration-300');

    bo.classList.remove('opacity-0');
    bo.classList.add('opacity-100');

    mp.classList.add('ease-out');
    mp.classList.add('duration-300');
    mp.classList.remove('opacity-0');
    mp.classList.remove('translate-y-4');
    mp.classList.remove('sm:translate-y-0');
    mp.classList.remove('sm:scale-95');
    mp.classList.add('opacity-100');
    mp.classList.add('translate-y-0');
    mp.classList.add('sm:scale-100');

}

function Hide(idBO, idMP, idM){
    var bo=document.getElementById(idBO);
    var mp=document.getElementById(idMP);
    var m=document.getElementById(idM);

    m.classList.add('hidden');
    m.classList.remove('block');

    m.classList.add('z-0');
    m.classList.remove('z-10');

    bo.classList.remove('ease-out');
    bo.classList.remove('duration-300');

    bo.classList.add('opacity-0');
    bo.classList.remove('opacity-100');

    mp.classList.remove('ease-out');
    mp.classList.remove('duration-300');

    mp.classList.add('opacity-0');
    mp.classList.add('translate-y-4');
    mp.classList.add('sm:translate-y-0');
    mp.classList.add('sm:scale-95');

    mp.classList.remove('opacity-100');
    mp.classList.remove('translate-y-0');
    mp.classList.remove('sm:scale-100');

}

function Odabrano(id,naziv,input,hiden,idoblik){

  //  var img=document.getElementById(id).src=btn.src;
  var img=document.getElementById(input).value=naziv;//naziv;

    var input=document.getElementById(hiden).value=id;
    ToggleNarudzba(naziv,idoblik);


}
function ToggleNarudzba(kategorija,idoblik){
  var divOblik=document.getElementById(idoblik);
    if(divOblik!=null){
      
      if(kategorija!="Pločica za vrata" ){
        divOblik.classList.add("hidden");
        divOblik.classList.remove("flex");

      }
      else{
        divOblik.classList.remove("hidden");
        divOblik.classList.add("flex");

      }
    }
   
  }
 

  Hide('{{$idBO}}', '{{$idMP}}', '{{$idM}}')

 
 </script>