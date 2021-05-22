@props(['naslov','slika'])
<div class="md:w-1/2 p-4 mb-8 md:mb-0 relative  ">
  <img class="   rounded shadow-md" src="{{$slika}}" alt="">
  <div class="absolute flex justify-between bottom-0 right-4 left-4 bg-transparent overflow-hidden
  hover:bg-black hover:bg-opacity-70 text-transparent hover:text-gray-300 mb-4  p-4">
        <h3 class="text-xl font-semibold ">{{$naslov}}</h3>
    <div id="div"></div>

    <button onClick="Brisi()">B</button>

  </div>
  <div id="potvrda" class="flex absolute w-11/12 h-full overflow-hidden top-4 mb-4 left-4  bg-opacity-95  flex-col text-lg uppercase text-gray-300 " >
      <p>Da li ste sigurni?</p>
    <div class="flex justify-around " >
    <button calss="m-4">Da</button>
      <button calss="m-4">Ne</button>
    </div> 

  </div>
</div>

<script>
    function Opcije(){
        var brisi=document.getElementById("brisi");
        brisi.classList.add("block");
        brisi.classList.remove("hidden");


    }
    function Brisi(){
        var potvrda=document.getElementById("potvrda");
        potvrda.classList.add("flex");
        potvrda.classList.remove("hidden");
        var img=document.getElementById("img");
        

    }
</script>


