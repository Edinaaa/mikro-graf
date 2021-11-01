@extends('layouts.app')
@section('title','O nama')

@section('content')
<div class="flex w-full justify-around items-center px-4">
    <div class="flex-col w-full  xs:w-3/4   sm:w-2/3 ">
        <x-slikaopis Naslov="O nama" Slika="{{asset('slike-stranica/6.jpg')}}">
            SZR 'Mikrograf' Bihać je osnovana 1996. godine i iza sebe ima dugogodišnje iskustvo u 
            izradi proizvoda i usluga rađenih tehnikom CNC graviranja, digitalnom štampom na sve vrste materijala,
            izrezivanja PVC samoljepljive folije i ostalim srodnim tehnikama.
        </x-slikaopis>
        <x-slikaopis Naslov="Neki od tih proizvoda su" Slika="{{asset('slike-stranica/4.jpg')}}">
            <ul><li>
            - unutrašnje i vanjske signalizacije objekata,  natpisne table,  putokazi, natpisi za kancelarije, stanove, natpisi za vozila, izloge, i sl.
            </li><li>
            - sportskih i drugih priznanja (plakete, zahvalnice, diplome, pehari...)
            </li><li>
            - dekoracije u drvetu, mramoru, kerrock-u (intarzije, graviranje, izrezivanje...)
            </li><li>
            - reklamni materijal sa graviranim ili kolor ispisom (olovke, upaljači, privjesci, suveniri, pokloni...)
            </li></ul>
        </x-slikaopis>
        <x-slikaopis Naslov="Firme i organizacije za koje smo do sada radili" Slika="{{asset('slike-stranica/1.jpg')}}">
            Vlada USK Bihać, Općina Bihać, Općina Ključ, Općina Cazin, Općina Bužim, Gradska galerija Bihać, Privredna komora unsko-sanskog kantona, Muzej Unako-sanskog kantona,
            Elektroprijenos Bihać, Elektrodistribucija Bihać, Univerzitet u Bihaću, Inter-butan Ostrožac, Varteks Zenica, Benzinska pumpa Irfan Kadić Bosanska Krupa, Euroing 4D Bihać,
            EUFOR, Camelija osiguranje Bihać, Kantonalna bolnica 'Dr. Irfan Ljubijankić' Bihać, Una-farmacija Bihać, Apoteka Kovačević, Apoteke Europharm, Apoteka Pharmacia, Dom zdravlja Bihać,
            Hotel Park, Hotel Ada, Hotel Sedra, Hotel Paviljon,
            razne advokatski, notarski, prevodilački uredi, te druge firme i organizacije.
        </x-slikaopis>
    </div>
</div>
@endsection
