<script>

//https://newbedev.com/laravel-right-way-to-import-javascript-into-blade-templates

function ObaveznoPolje(element,error) {

    if (element.value == "") {
        error.innerHTML="Ovo je obavezno polje.";
    return false;
    }
    else{
        error.innerHTML=error.innerHTML.replace('Ovo je obavezno polje.','');
    return true;   
    }
}    
function MaxLenght(element,error, l) {

    if (element.value.length>l) {
          error.innerHTML="Maksimalan broj znakova je "+l+".";
          return false;
    }
    else{
          error.innerHTML=error.innerHTML.replace('Maksimalan broj znakova je '+l+'.','');
          
          return true;   
    }
}  
function fileValidan(element,error) {

    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.bmp)$/i;
    if (!allowedExtensions.exec(element.value) && element.value!='') {
        element.value = '';
        error.innerHTML="Tip file-a nije podržan.";
    return false;
    }
    else{
        error.innerHTML=error.innerHTML.replace('Tip file-a nije podržan.','');
    return true;   
    }
}  
function FloatVrijednost(element,error) {

    var objRegex = /^-?\d{1,4}(?:[.]\d{0,2}?)?$/;  
  
        //check for numeric characters  
    if(!objRegex.test(element.value) || element.value<0) 
    {
        error.innerHTML="Možete unjeti četverocifrene vrijednosti sa 2 decimalna mjesta.";
        return false;
    }
    else{
       error.innerHTML=error.innerHTML.replace('Možete unjeti četverocifrene vrijednosti sa 2 decimalna mjesta.','');
        return true;   
    }
}  
function IntVrijednost(element,error,message) {
var n=element.value.replace(',','');
if(!Number(n)  || n<0 && n!="") 
{
    error.innerHTML=message;
    return false;
}
else{
   
   error.innerHTML=error.innerHTML.replace(message,'');

    return true;   
}
}  
</script>