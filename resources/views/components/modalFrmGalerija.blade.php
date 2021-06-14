@props(['galerija'=>'$galerija','idBO'=>$idBO, 'idMP'=>$idMP, 'idM'=>$idM])
<!-- This example requires Tailwind CSS v2.0+ -->
<div id="{{$idM}}" class="fixed z-10 block inset-0 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div id="{{$idBO}}" class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
   
 
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

    
    <div id="{{$idMP}}" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden  shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white text-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
         
          <form method="POST" action="{{ route('galerija.update',$galerija->id) }}" enctype="multipart/form-data">
                    @csrf
                  
                    <x-input id="name" label="Naziv slike" value="{{ $galerija->name}}" class="mt-5 mx-7"></x-input>
                    <x-input type="file" id="file"  label="slika" value="" class="mt-5 mx-7"></x-input>

                   
                    <div class='flex items-center justify-center  md:gap-8 gap-4 py-5'>
                        <button type="submit" onClick="Hide('{{$idBO}}', '{{$idMP}}', '{{$idM}}')"  class='w-auto bg-primary-600 hover:bg-primary-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Izmjeni</button>
                    </div>
          </form>
          
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