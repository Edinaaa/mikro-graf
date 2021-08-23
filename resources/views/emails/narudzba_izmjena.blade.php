<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href= "{{asset('css/app.css')}}">
      
<title>narudžba</title>
    </head>
<body style="padding:10px;">


  <h1> Vaša narudžba je <span style="text-transform: lowercase;">{{$narudzba->stanje->naziv}}.</span></h1>  

    @if($korpa->count())
    <h2>Stavke narudžbe:</h2>

      @foreach($korpa as $stavka)
        <div style="padding:10px; background-color: rgb(253, 241, 219); border-radius: 10px;">
            <h4>{{$stavka->kategorija->naziv}}</h4>
            <p>Natpis {{$stavka->tekst}},
                  @isset($stavka->font)
                  font {{$stavka->font->naziv}},
                  @endisset
                  dimenzije visina {{$stavka->visina}}cm i širina {{$stavka->sirina}}cm, 
                  @isset($stavka->oblik)
                  oblik {{$stavka->oblik->naziv}}, 
                  @endisset
                  materijal {{$stavka->materijal->naziv}}.
            </p>
               @if ($narudzba->opis!="")
                  <p > Opis: {{$narudzba->opis}} </p> 
               @endif
        </div>

      @endforeach
   
    @endif

    @isset($narudzba->cijena)
          <p style="color:rgb(247, 116, 43);" > Cijena narudžbe: {{$narudzba->cijena}} KM</p>  

          @endisset
    <p >Naručeno   {{$narudzba->created_at->diffForHumans()}}</p>

</div>





</body>
</html>