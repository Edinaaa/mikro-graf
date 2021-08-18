@section('footer-scripts')
      @include('scripts.validacija')
<script >
  
    function validateForm(form) {
        let forma = document.forms[form];
        var naziv = forma["naziv"];
        var errornaziv=document.getElementById("errornaziv");

        var file = forma["file"];
        var errorfile=document.getElementById("errorfile");
      
        if(ObaveznoPolje(naziv,errornaziv) &&
        MaxLenght(naziv,errornaziv,30) &&
        ObaveznoPolje(file, errorfile) &&
        fileValidan(file, errorfile) )
        {
            return true;
        }
     return false;
       
    }
    function validateUpdateForm(form) {
        let forma = document.forms[form];
        var naziv = forma["naziv"];
        var errornaziv=document.getElementById("errornaziv");

        var file = forma["file"];
        var errorfile=document.getElementById("errorfile");
      
        if(ObaveznoPolje(naziv,errornaziv) &&
        MaxLenght(naziv,errornaziv,30) &&
        fileValidan(file, errorfile) )
        {
            return true;
        }
     return false;
       
    }

    function validateMaterijalForm(form) {
        let forma = document.forms[form];
        var visina = forma["visina"];
        var errorvisina=document.getElementById("errorvisina");

        var sirina = forma["sirina"];
        var errorsirina=document.getElementById("errorsirina");
      
        if(validateForm(form) &&
        ObaveznoPolje(sirina, errorsirina) &&
        ObaveznoPolje(visina, errorvisina) &&
        FloatVrijednost(sirina, errorsirina) &&
        FloatVrijednost(visina, errorvisina) )
        {
            return true;
        }
     return false;
       
    }
    function validateMaterijalUpdateForm(form) {
        let forma = document.forms[form];
        var visina = forma["visina"];
        var errorvisina=document.getElementById("errorvisina");

        var sirina = forma["sirina"];
        var errorsirina=document.getElementById("errorsirina");
      
        if(validateUpdateForm(form) &&
        ObaveznoPolje(sirina, errorsirina) &&
        ObaveznoPolje(visina, errorvisina) &&
        FloatVrijednost(sirina, errorsirina) &&
        FloatVrijednost(visina, errorvisina) )
        {
            return true;
        }
     return false;
       
    }
    function validateStanjeForm(form) {
        let forma = document.forms[form];
        var naziv = forma["naziv"];
        var errornaziv=document.getElementById("errornaziv");

      
        if(ObaveznoPolje(naziv,errornaziv) &&
        MaxLenght(naziv,errornaziv,30))
        {
            return true;
        }
     return false;
       
    }
    function validateKategorijaForm(form) {
        let forma = document.forms[form];
        var naziv = forma["naziv"];
        var errornaziv=document.getElementById("errornaziv");
        var selecMaterijali = forma["selecMaterijali"];
        var errormaterijali=document.getElementById("errormaterijali");
      
        if(ObaveznoPolje(naziv,errornaziv) &&
        MaxLenght(naziv,errornaziv,30) &&
        IntVrijednost(selecMaterijali,errormaterijali,'Odaberite neke od ponuđenih materijala.'))
        {
            return true;
        }
     return false;
       
    }
</script>
  @endsection
