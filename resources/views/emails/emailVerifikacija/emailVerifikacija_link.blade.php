
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href= "{{asset('css/app.css')}}">
      
<title>Email verifikacija</title>
    </head>
<body style="padding:10px; width:100%">

<h1 style="width:40%; margin:auto;padding:20px 0px;text-align: center;">Email verifikacija</h1>

<p style="width:80%; margin:auto;  text-align: justify;">Potrebno je da verifikujete vaš email, 
    kako bi ste se osigurali da niste unijeli pogrešan ili tuđi email.
 Klikom na dugme ispod izvršite verifikaciju vašeg emaila 
 i završite registraciju na web stranici miko-graf zanatske rednje. </p>

 <div style="width:25%; margin:auto; padding:20px">
<a href="{{$link}}" style="text-decoration:none;background-color: rgb(247, 116, 43);
border-radius: 7px;padding:5px; color: white;font-weight: bold; margin:auto" > 
Verifikuj email </a>
</div>

<h5> S poštovanjem,
    <br> Mikro-Graf
   <br>  <a href="{{route('home')}}">www.mikro-graf.com</a>
  <br>   Mob: +387 61 240 862
   <br>   Adresa: Alekse Šantića 7, Bihać</h5>
  
</body>
</html>