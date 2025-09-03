<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin1/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/admin1/assets/img/favicon.png')}}">
    <title>
       Sub-Category
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Sub_Category</li>
                    </ol>
                </nav>
                @include('admin.navbar')
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-2">
            <div class="d-flex justify-content-end mb-3 mt-4">
                <a href="{{ route('admin.subcategory.create') }}" class="btn btn-success btn-sm me-3">
                    <i class="fas fa-plus me-1"></i> Add Sub_Category
                </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Sub_Categories Table</h6>

                            </div>


                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>

                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Slug</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($subcategories as $subcategory)
                                        <tr>
                                            <!-- Subcategory name -->
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $subcategory->name }}</h6>
                                            </td>

                                            <!-- Subcategory description -->
                                            <td>
                                                <p class="text-xs text-secondary mb-0">{{ $subcategory->description }}</p>
                                            </td>

                                            <!-- Subcategory slug -->
                                            <td>
                                                <span class="badge bg-gradient-secondary">{{ $subcategory->slug }}</span>
                                            </td>

                                            <!-- Parent Category -->
                                            <td>
                                                <span class="badge bg-gradient-info">
                                                    {{ $subcategory->category ? $subcategory->category->name : 'No Category' }}
                                                </span>
                                            </td>

                                            <!-- Subcategory Image -->
                                            <td>
                                                @if($subcategory->image)
                                                <img src="{{ Storage::url($subcategory->image) }}"
                                                    class="avatar avatar-lg me-3 border-radius-lg"
                                                    alt="{{ $subcategory->name }}">
                                                @else
                                                <img src="{{ asset('assets/admin1/assets/img/default.png') }}"
                                                    class="avatar avatar-sm me-3 border-radius-lg"
                                                    alt="default">
                                                @endif
                                            </td>

                                            <!-- Actions -->
                                            <td class="align-middle text-center">
                                                <a href="{{ route('admin.subcategory.edit', $subcategory->id) }}" class="text-warning font-weight-bold text-xs me-2">Edit</a>
                                                <form action="{{ route('admin.subcategory.destroy', $subcategory->id) }}"
                                                    method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0 border-0 bg-transparent">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer py-4">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item"><a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a></li>
                                <li class="nav-item"><a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a></li>
                                <li class="nav-item"><a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a></li>
                                <li class="nav-item"><a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    @include('admin.plugin')
    @include('admin.js')
</body>

</html>