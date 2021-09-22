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
        NizIntVrijednost(selecMaterijali,errormaterijali,'Odaberite neke od ponuđenih materijala.'))
        {
            return true;
        }
     return false;
       
    }
    function validateUserForm(form) {
        let forma = document.forms[form];
        var name = forma["name"];
        var errorname=document.getElementById("errorname");
        var lastname = forma["lastname"];
        var errorlastname=document.getElementById("errorlastname");
        var telefon = forma["telefon"];
        var errortelefon=document.getElementById("errortelefon");
        var email = forma["email"];
        var erroremail=document.getElementById("erroremail");
        var password = forma["password"];
        var errorpassword=document.getElementById("errorpassword");
        var password_confirmation = forma["password_confirmation"];
        var errorpassword_confirmation=document.getElementById("errorpassword_confirmation");
       
        if( ObaveznoPolje(name,errorname) &&
        MaxLenght(name,errorname,15) &&
        ObaveznoPolje(lastname,errorlastname) &&
        MaxLenght(lastname,errorlastname,20) &&
        ObaveznoPolje(telefon,errortelefon) &&
        MaxLenght(telefon,errortelefon,15) &&
        IntVrijednost(telefon,errortelefon,'Broj telefona može sadržavati samo brojeve.') &&
        BorjMobitelaVrijednost(telefon,errortelefon,'Broj mobitela mora poceti sa 00387.') &&
        ObaveznoPolje(email,erroremail) &&
        MaxLenght(email,erroremail,191) &&
        MaxLenght(password,errorpassword,100) &&
        MinLenght(password,errorpassword,8) &&
        PassVrijednost(password,errorpassword) &&
        JednakeVrijednost(password,password_confirmation,errorpassword_confirmation,'Lozinke se ne podudaraju.') )
        {
            return true;
        }
     return false;
       
    }
    function validateRegisterForm(form) {
        let forma = document.forms[form];
        var password = forma["password"];
        var errorpassword=document.getElementById("errorpassword");
      
        if( validateUserForm(form) &&
        ObaveznoPolje(password,errorpassword) )
        {
            return true;
        }
     return false;
       
    }
    function validateNewPassForm(form) {
        let forma = document.forms[form];
        
        var email = forma["email"];
        var ResetPassId = forma["ResetPassId"];
        var password = forma["password"];
        var errorpassword=document.getElementById("errorpassword");
        var password_confirmation = forma["password_confirmation"];
        var errorpassword_confirmation=document.getElementById("errorpassword_confirmation");
       
        if(ObaveznoPolje(email,errorpassword,'Desila se greška, pokušajte ponovo.') &&
        ObaveznoPolje(ResetPassId,errorpassword,'Desila se greška, pokušajte ponovo.') &&
        IntVrijednost(ResetPassId,errorpassword,'Desila se greška, pokušajte ponovo.') &&
        EmailVrijednost(email,errorpassword) &&
        ObaveznoPolje(password,errorpassword) &&
        MaxLenght(password,errorpassword,100) &&
        MinLenght(password,errorpassword,8) &&
        PassVrijednost(password,errorpassword) &&
        JednakeVrijednost(password,password_confirmation,errorpassword_confirmation,'Lozinke se ne podudaraju.') )
        {
            return true;
        }
     return false;
       
    }
    function validateResetPassForm(form) {
        let forma = document.forms[form];
        
        var email = forma["email"];
        var erroremail=document.getElementById("erroremail");

        var captcha = forma["captcha"];
        var errorcaptcha=document.getElementById("errorcaptcha");
       
        if(ObaveznoPolje(email,erroremail) &&
        MaxLenght(email,erroremail,191) &&
        EmailVrijednost(email,erroremail) &&
        ObaveznoPolje(captcha,errorcaptcha) &&
        MaxLenght(captcha,errorcaptcha,100)){
            return true;
        }
     return false;
       
    }
    function validateLoginForm(form) {
        let forma = document.forms[form];
        
        var email = forma["email"];
        var erroremail=document.getElementById("erroremail");

        var password = forma["password"];
        var errorpassword=document.getElementById("errorpassword");
       
        if(ObaveznoPolje(email,erroremail) &&
        MaxLenght(email,erroremail,191) &&
        EmailVrijednost(email,erroremail) &&
        ObaveznoPolje(password,errorpassword) &&
        MaxLenght(password,errorpassword,100) &&
        MinLenght(password,errorpassword,8) &&
        PassVrijednost(password,errorpassword)){
            return true;
        }
     return false;
       
    }
    function validateKontaktPadaciForm(form) {
        let forma = document.forms[form];
        
        var telefon = forma["telefon"];
        var errortelefon=document.getElementById("errortelefon");
        
       
        if(validateResetPassForm(form) &&
        ObaveznoPolje(telefon,errortelefon) &&
        MaxLenght(telefon,errortelefon,15) &&
        IntVrijednost(telefon,errortelefon,'Broj telefona može sadržavati samo brojeve.') &&
        BorjMobitelaVrijednost(telefon,errortelefon,'Broj mobitela mora poceti sa 00387.')){
            return true;
        }
     return false;
       
    }
    function validateTelefonKoodForm(form) {
        let forma = document.forms[form];
        
        var verifikacioni_code = forma["verifikacioni_code"];
        var errorverifikacioni_code=document.getElementById("errorverifikacioni_code");
        
       
        if(ObaveznoPolje(verifikacioni_code,errorverifikacioni_code) &&
        MaxLenght(verifikacioni_code,errorverifikacioni_code,4) &&
        IntVrijednost(verifikacioni_code,errorverifikacioni_code,'Verifinacijski kood može sadržavati samo brojeve.')){
            return true;
        }
     return false;
       
    }
    function validatePorukeForm(form) {
        let forma = document.forms[form];
        

        var primaoc_id = forma["primaoc_id"];
        var errorprimaoc_id=document.getElementById("errorprimaoc_id");
        var primaoc=true;
        if(primaoc_id!= null){
            primaoc=IntVrijednost(primaoc_id,errorprimaoc,'Odaberite primaoca iz liste.');
        }
        var tema = forma["tema"];
        var errortema=document.getElementById("errortema");

        var sadrzaj = forma["sadrzaj"];
        var errorsadrzaj=document.getElementById("errorsadrzaj");
       
        if(ObaveznoPolje(tema,errortema) &&
        MaxLenght(tema,errortema,100) &&
        ObaveznoPolje(sadrzaj,errorsadrzaj) &&
        MaxLenght(sadrzaj,errorsadrzaj,200)){
            return true;
        }
     return false;
       
    }
    function validateKontaktPorukaForm(form) {
        let forma = document.forms[form];
        
        var email = forma["email"];
        var erroremail=document.getElementById("erroremail");

        
        if(validatePorukeForm(form) &&
        MaxLenght(email,erroremail,191) &&
        EmailVrijednost(email,erroremail)){
            return true;
        }
     return false;
       
    }
    function validatePorukaForm(form) {
        let forma = document.forms[form];
        

        var posiljaoc_id = forma["posiljaoc_id"];
        var razgovor_id = forma["razgovor_id"];

        var sadrzaj = forma["sadržaj"];
        var errorsadrzaj=document.getElementById("errorsadrzaj");
       
        if(ObaveznoPolje(posiljaoc_id,errorsadrzaj,'Desila se greška pokušajte ponovo.') &&
        IntVrijednost(posiljaoc_id,errorsadrzaj,'Desila se greška pokušajte ponovo.') &&
        ObaveznoPolje(razgovor_id,errorsadrzaj,'Desila se greška pokušajte ponovo.') &&
        IntVrijednost(razgovor_id,errorsadrzaj,'Desila se greška pokušajte ponovo.') &&
        ObaveznoPolje(sadrzaj,errorsadrzaj) &&
        MaxLenght(sadrzaj,errorsadrzaj,200)){
            return true;
        }
     return false;
       
    }
    function validateProizvodForm(form) {
        let forma = document.forms[form];
        var tekst = forma["tekst"];
        var errortekst=document.getElementById("errortekst");
        var visina = forma["visina"];
        var errorvisina=document.getElementById("errorvisina");
        var sirina = forma["sirina"];
        var errorsirina=document.getElementById("errorsirina");
        var popust = forma["popust"];
        var errorpopust=document.getElementById("errorpopust");
        var file = forma["file"];
        var errorfile=document.getElementById("errorfile");
        var cijena = forma["cijena"];
        var errorcijena=document.getElementById("errorcijena");
        var kategorija_id = forma["kategorija_id"];
        var errorkategorija=document.getElementById("errorkategorija");
        var font_id = forma["font_id"];
        var errorfont=document.getElementById("errorfont");
        var materijal_id = forma["materijal_id"];
        var errormaterijal=document.getElementById("errormaterijal");
        var oblik_id = forma["oblik_id"];
        var erroroblik=document.getElementById("erroroblik");
        if(
        ObaveznoPolje(sirina,errorsirina) &&
        ObaveznoPolje(visina,errorvisina) &&
        ObaveznoPolje(file, errorfile) &&
        ObaveznoPolje(kategorija_id,errorkategorija,'Odaberite neki od ponuđenih kategorija.') &&
        ObaveznoPolje(materijal_id,errormaterijal,'Odaberite neki od ponuđenih materijala.') &&
        ObaveznoPolje(cijena,errorcijena) &&
        IntVrijednost(font_id,errorfont,'Odaberite neki od ponuđenih fontova.') &&
        IntVrijednost(kategorija_id,errorkategorija,'Odaberite neki od ponuđenih kategorija.') &&
        IntVrijednost(materijal_id,errormaterijal,'Odaberite neki od ponuđenih materijala.') &&
        IntVrijednost(oblik_id,erroroblik,'Odaberite neki od ponuđenih oblika.') &&
        IntVrijednost(popust,errorpopust,'Popust možete izraziti kao cijeli borj (10%).') &&
        FloatVrijednost(sirina, errorsirina) &&
        FloatVrijednost(visina, errorvisina) &&
        FloatVrijednost(cijena, errorcijena) &&
        fileValidan(file, errorfile) &&
        MaxLenght(tekst,errortekst,200)){
            return true;
        }
     return false;
       
    }
    function validateProizvodUForm(form) {
        let forma = document.forms[form];
        var tekst = forma["tekst"];
        var errortekst=document.getElementById("errortekst");
        var visina = forma["visina"];
        var errorvisina=document.getElementById("errorvisina");
        var sirina = forma["sirina"];
        var errorsirina=document.getElementById("errorsirina");
        var popust = forma["popust"];
        var errorpopust=document.getElementById("errorpopust");
        var file = forma["file"];
        var errorfile=document.getElementById("errorfile");
        var cijena = forma["cijena"];
        var errorcijena=document.getElementById("errorcijena");
        var kategorija_id = forma["kategorija_id"];
        var errorkategorija=document.getElementById("errorkategorija");
        var font_id = forma["font_id"];
        var errorfont=document.getElementById("errorfont");
        var materijal_id = forma["materijal_id"];
        var errormaterijal=document.getElementById("errormaterijal");
        var oblik_id = forma["oblik_id"];
        var erroroblik=document.getElementById("erroroblik");
        var oblik=true;
        if(oblik_id!= null){
            oblik=IntVrijednost(oblik_id,erroroblik,'Odaberite neki od ponuđenih oblika.');
        }
        if(
        ObaveznoPolje(sirina,errorsirina) &&
        ObaveznoPolje(visina,errorvisina) &&
        ObaveznoPolje(kategorija_id,errorkategorija,'Odaberite neki od ponuđenih kategorija.') &&
        ObaveznoPolje(materijal_id,errormaterijal,'Odaberite neki od ponuđenih materijala.') &&
        ObaveznoPolje(cijena,errorcijena) &&
        IntVrijednost(font_id,errorfont,'Odaberite neki od ponuđenih fontova.') &&
        IntVrijednost(kategorija_id,errorkategorija,'Odaberite neki od ponuđenih kategorija.') &&
        IntVrijednost(materijal_id,errormaterijal,'Odaberite neki od ponuđenih materijala.') &&
        oblik &&
        IntVrijednost(popust,errorpopust,'Popust možete izraziti kao cijeli borj (10%).') &&
        FloatVrijednost(sirina, errorsirina) &&
        FloatVrijednost(visina, errorvisina) &&
        FloatVrijednost(cijena, errorcijena) &&
         MaxLenght(tekst,errortekst,200)&&
        fileValidan(file, errorfile)){
            return true;
        }
     return false;
    }
    function validateNarudzbaForm(form) {
        let forma = document.forms[form];
        var tekst = forma["tekst"];
        var errortekst=document.getElementById("errortekst");
        var visina = forma["visina"];
        var errorvisina=document.getElementById("errorvisina");
        var sirina = forma["sirina"];
        var errorsirina=document.getElementById("errorsirina");
        var opis = forma["opis"];
        var erroropis=document.getElementById("erroropis");
        var file = forma["file"];
        var errorfile=document.getElementById("errorfile");
        var kategorija_id = forma["kategorija_id"];
        var errorkategorija=document.getElementById("errorkategorija_id");
        var font_id = forma["font_id"];
        var errorfont=document.getElementById("errorfont");
        var materijal_id = forma["materijal_id"];
        var errormaterijal=document.getElementById("errormaterijal");
        var oblik_id = forma["oblik_id"];
        var erroroblik=document.getElementById("erroroblik");
        if(
        ObaveznoPolje(kategorija_id,errorkategorija,'Odaberite neki od ponuđenih kategorija.') &&
        ObaveznoPolje(materijal_id,errormaterijal,'Odaberite neki od ponuđenih materijala.') &&
        IntVrijednost(font_id,errorfont,'Odaberite neki od ponuđenih fontova.') &&
        IntVrijednost(kategorija_id,errorkategorija,'Odaberite neki od ponuđenih kategorija.') &&
        IntVrijednost(materijal_id,errormaterijal,'Odaberite neki od ponuđenih materijala.') &&
        IntVrijednost(oblik_id,erroroblik,'Odaberite neki od ponuđenih oblika.') &&
        FloatVrijednost(sirina, errorsirina) &&
        FloatVrijednost(visina, errorvisina) &&
        fileValidan(file, errorfile) &&
        MaxLenght(tekst,errortekst,200) &&
        MaxLenght(opis,erroropis,200)){
            return true;
        }
     return false;
       
    }
    function validateNarudzbaUForm(form) {
        let forma = document.forms[form];
       
        var cijena = forma["cijena"];
        var errorcijena=document.getElementById("errorcijena");
        var stanjes_id = forma["stanjes_id"];
        var errorstanjes_id=document.getElementById("errorstanjes_id");
        var email = forma["email[]"];
        var sms = forma["sms[]"];
        var errorcheckbox=document.getElementById("errorcheckbox");

        
        if(ObaveznoPolje(cijena,errorcijena) &&
            ObaveznoPolje(stanjes_id,errorstanjes_id) &&
        IntVrijednost(stanjes_id,errorstanjes_id,'Odaberite neki od ponuđenih stanja.') &&
        CheckboxVrijednost(email,sms,errorcheckbox) &&
        FloatVrijednost(cijena, errorcijena) ){
            return true;
        }
     return false;
       
    }
</script>
  @endsection
