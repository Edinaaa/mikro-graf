<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="{{asset('js/app.js')}}"></script>
        <link rel="stylesheet" href= "{{asset('css/app.css')}}">
      
<title>Prva</title>
    </head>
<body class="relative bg-gray-200 w-screen h-full min-h-screen overflow-x-hidden">
@auth
    @if(auth()->user()->hasRole('admin'))
    <x-adminNavBar></x-adminNavBar>

    @endif
    @if(auth()->user()->hasRole('kupac'))
        <x-navbar></x-navbar>

    @endif
@endauth
@guest
    <x-navbar></x-navbar>
    
@endguest
<div>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
    <x-modalMessage message="{{ Session::get('alert-' . $msg) }}"   idBO="BOmessage" idMP="MPmessage" idM="Mmessage"/>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->  
    @yield('content')
    @yield('footer-scripts')
</body>
</html>