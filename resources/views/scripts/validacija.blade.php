<script>

//https://newbedev.com/laravel-right-way-to-import-javascript-into-blade-templates

function ObaveznoPolje(element,error,message="Ovo je obavezno polje.") {

    if (element.value == "") {
        error.innerHTML=message;
    return false;
    }
    else{
        error.innerHTML=error.innerHTML.replace(message,'');
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
function MinLenght(element,error, l) {

    if (element.value.length<l && element.value.length!=0) {
        error.innerHTML="Minimalan broj znakova je "+l+".";
        return false;
    }
    else{
        error.innerHTML=error.innerHTML.replace('Minimalan broj znakova je '+l+'.','');
        
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
    if((!objRegex.test(element.value) || element.value<0) &&  element.value!="") 
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
    if((!Number(n)  || n<0 )&& n!="") 
    {
        error.innerHTML=message;
        return false;
    }
    else{
    
    error.innerHTML=error.innerHTML.replace(message,'');

        return true;   
    }
} 
function NizIntVrijednost(element,error,message) {
    const niz=element.value.split(",");
    for (let i = 1; i < niz.length; i++) {
        var n=niz[i];
        if(!Number(n)  || n<0 ){ 
            error.innerHTML=message;
            return false;
        }
        else{
            error.innerHTML=error.innerHTML.replace(message,'');
            return true;   
        }
    } 
    return true;  
}   
function JednakeVrijednost(element1,element2,error,message) {
    if(element1.value!=element2.value) 
    {
        error.innerHTML=message;
        return false;
    }
    else{
    
    error.innerHTML=error.innerHTML.replace(message,'');

        return true;   
    }
} 
function PassVrijednost(element,error) {

    var objRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,100}$/;  
    if(element.value !="" ) {
        if(objRegex.test(element.value) ) 
        {
        error.innerHTML="";
            return true;
        }
        else{
            error.innerHTML="Lozinka treba sadržavati barem po jedno slovo, broj i znak @$!%*#?&.";
            return false;   
        }
    
    }
    return true;
}
function EmailVrijednost(element,error) {

    var objRegex = /\S+@\S+\.\S+/;  
    if(element.value !="" ) {
        if(objRegex.test(element.value) ) 
        {
            error.innerHTML=error.innerHTML.replace('Vaš email nije validan.','');
            return true;
        }
        else{
            error.innerHTML="Vaš email nije validan.";
            return false;   
        }

    }
    return true;
}
function CheckboxVrijednost(element,element2,error) {

    if(element.checked || element2.checked) {
        error.innerHTML=error.innerHTML.replace('Odaberite bar jedno od ponuđenog.','');
        
        return true;
    }
    else{
        error.innerHTML='Odaberite bar jedno od ponuđenog.';
        return false;   
    }


return true;
}
</script>