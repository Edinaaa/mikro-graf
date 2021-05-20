@extends('layouts.app')

@section('content')
<div class="flex-col">
<x-slikaopis Naslov="O nama" 
    Sadrzaj="Neki textPoceli smo sa radom te i te godine. najvise radimo to i to." 
    Slika="https://source.unsplash.com/random/1280x720">
</x-slikaopis>
<x-slikaopis Naslov="Radimo sa masinama" 
    Sadrzaj="Neki textPoceli smo sa radom te i te godine. najvise radimo to i to." 
    Slika="https://source.unsplash.com/random/1280x720">
</x-slikaopis>
<x-slikaopis Naslov="Radimo sa materijalima" 
    Sadrzaj="Neki textPoceli smo sa radom te i te godine. najvise radimo to i to." 
    Slika="https://source.unsplash.com/random/1280x720">
</x-slikaopis>
</div>
@endsection
