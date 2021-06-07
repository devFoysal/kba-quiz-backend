  @include('backend.templates.header')
  @include('backend.templates.sidemenu')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  @include('backend.templates.footer')