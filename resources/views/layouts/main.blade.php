
@include('layouts.all-blade.styles')

@include('layouts.all-blade.sidebar')
  <main id="main" class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg" >
    
@yield('content')
@include('layouts.all-blade.footer')

 </main>


@include('layouts.all-blade.rightsidebar')

@include('layouts.all-blade.scripts')
