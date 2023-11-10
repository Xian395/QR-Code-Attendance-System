
@include('layouts.styles')

@include('layouts.sidebar')
  <main id="main" class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg" >
    
@yield('content')
@include('layouts.footer')

 </main>


@include('layouts.rightsidebar')

@include('layouts.scripts')
