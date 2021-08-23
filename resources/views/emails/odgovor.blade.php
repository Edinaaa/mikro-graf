<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href= "{{asset('css/app.css')}}">
      
<title>narudžba</title>
    </head>
<body style="padding:10px;">

        @foreach($razgovor->poruke as $odgovor)
            <div style="padding:10px; background-color: rgb(253, 241, 219); border-radius: 10px;">
                
                @isset($odgovor->email)
                <p>Poslao: {{$odgovor->email}}</p>
                    
                @endisset
             <h4>{{$odgovor->sadrzaj}}</h4>
             <p>{{$odgovor->created_at->diffForHumans()}}</p>

             
            </div>
        @endforeach

<p> {{$poruka->sadrzaj}}</p>
<h6> Lp, hvala na javljanju, Mikro-graf.</h6>
  
</body>
</html>