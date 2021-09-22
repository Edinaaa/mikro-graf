@props(['idBO', 'idMP', 'idM'])
<!-- This example requires Tailwind CSS v2.0+ -->
<div id="{{$idM}}" class="fixed z-10 block inset-0 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div id="{{$idBO}}" class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
   
 
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    
    <div id="{{$idMP}}" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden  shadow-xl transform transition-all  w-10/12 sm:my-8 sm:align-middle sm:max-w-2xl ">
    <div  class="flex-grow overflow-y-auto max-h-96 w-full">
        <div class=" flex flex-col justify-center items-center bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">

            <h3 class="text-primary-500 font-semibold py-4" >Detalji proizvoda</h3>
           
            <a id="aslika" data-lightbox="roadtrip"  class="flex flex-col items-center  justify-between  h-40"
      href="#"><img id="imgslika" class=" h-full  object-contain"  src="#"/></a>
    
            <h3 id="DNaziv">Naziv</h3>
            <div class=" w-2/3">
            <div class="flex flex-row justify-between items-start">
                <p>Tekst:</p>
                <p id="DTekst">-</p>

            </div>

            <div class="flex flex-row justify-between items-start">
                <p>Visina:</p>
                <div class=" flex flex-row">
                    <p id="DVisina">0</p>
                    <p> cm</p>
                </div>
                
            </div> 

            <div class="flex flex-row justify-between items-start">
                <p>Širina:</p>
                <div class=" flex flex-row">
                    <p id="DSirina">0</p>
                    <p> cm</p>
                </div>
                
            </div> 
                
            <div class="flex flex-row justify-between items-start">
                <p>Font:</p>
                <p id="DFont">-</p>

            </div> 

            <div class="flex flex-row justify-between items-start">
                <p>Materijal:</p>
                <p id="DMaterijal">-</p>

            </div> 

            <div class="flex flex-row justify-between items-start">
                <p>Oblik:</p>
                <p id="DOblik">-</p>

            </div> 

            <div class="flex flex-row justify-between items-start">
                <p>Popust:</p>
                <div class=" flex flex-row">
                    <p id="DPopust">0</p>
                    <p> %</p>
                </div>

            </div> 

            <div class="flex flex-row justify-between items-start">
                <p>Novo:</p>
                <p id="DNovo">Ne</p>

            </div> 

            <div class="flex flex-row justify-between items-start">
                <p>Dostupno:</p>
                <p id="DDostupno">Ne</p>

            </div> 
            <div class="flex flex-row justify-between items-start">
                <p>Cijena:</p>
                <div class=" flex flex-row">
                    <p id="DCijena">0</p>
                    <p> KM</p>
                </div>

            </div>
            </div>
                <div class=" px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onClick="Hide('{{$idBO}}', '{{$idMP}}', '{{$idM}}')" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Zatvori
                    </button>
                </div>
        </div>
        
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



  Hide('{{$idBO}}', '{{$idMP}}', '{{$idM}}')

 
 </script>