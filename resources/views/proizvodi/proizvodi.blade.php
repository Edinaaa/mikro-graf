@extends('layouts.app')

@section('content')
<div class="w-full bg-gray-200 pl-14 py-1 rounded-lg grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        
      <x-kartica Naslov="Vjesaloca za kljuceve" 
            Sadrzaj="Vjesalica za kljuceve je izradjena od drveta. Velicina xy xy. Nudimo vam da izaberete svoj dizajn i da nam predlozite putem narudzbe." 
            Popust="20"
            Cijena="20"
            Slika="https://placeimg.com/480/480/any">
      </x-kartica>
      <x-kartica Naslov="Plocica za vrata" 
            Sadrzaj="Plocica je izradjena od plastike. Velicina xy xy. Nudimo vam da izaberete svoj dizajn i da nam predlozite putem narudzbe." 
            Cijena="10"
            Popust="10"
            Slika="https://placeimg.com/480/480/any"
            >
      </x-kartica>   
      <x-kartica Naslov="Vjesaloca za kljuceve" 
            Sadrzaj="Vjesalica za kljuceve je izradjena od drveta. Velicina xy xy. Nudimo vam da izaberete svoj dizajn i da nam predlozite putem narudzbe." 
            Cijena="20"
            Novo=""
            Slika="https://placeimg.com/480/480/any"
            >
      </x-kartica>
      <x-kartica Naslov="Vjesaloca za kljuceve" 
            Sadrzaj="Vjesalica za kljuceve je izradjena od drveta. Velicina xy xy. Nudimo vam da izaberete svoj dizajn i da nam predlozite putem narudzbe." 
            Popust="20"
            Cijena="20"
            Slika="https://placeimg.com/480/480/any">
      </x-kartica>
      <x-kartica Naslov="Plocica za vrata" 
            Sadrzaj="Plocica je izradjena od plastike. Velicina xy xy. Nudimo vam da izaberete svoj dizajn i da nam predlozite putem narudzbe." 
            Cijena="10"
            Popust="10"
            Slika="https://placeimg.com/480/480/any"
            >
      </x-kartica>   
      <x-kartica Naslov="Vjesaloca za kljuceve" 
            Sadrzaj="Vjesalica za kljuceve je izradjena od drveta. Velicina xy xy. Nudimo vam da izaberete svoj dizajn i da nam predlozite putem narudzbe." 
            Cijena="20"
            Novo=""
            Slika="https://placeimg.com/480/480/any"
            >
      </x-kartica>
  

</div>
@endsection