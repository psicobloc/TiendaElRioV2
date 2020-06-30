<!DOCTYPE html>
<html lang="en">

     <head>
       @include('partials.head')
       @include('partials.materialscss')
     </head>

     <body>
    @include('partials.nav')
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    @include('partials.footer-scripts')
     </body>

</html>
