<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin1/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/admin1/assets/img/favicon.png')}}">
  <title>
    Material Dashboard 3 by Creative Tim
  </title>
@include('admin.css')
</head>
<body class="g-sidenav-show  bg-gray-100">
  @include('admin.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>

      @include('admin.navbar')
      </div>
    </nav>
    <!-- End Navbar -->
  @include('admin.body')
  </main>
  @include('admin.plugin')
@include('admin.js')
</body>

</html>