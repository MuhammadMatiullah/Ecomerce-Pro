<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin1/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/admin1/assets/img/favicon.png')}}">
    <title>
        Add Category
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Category</li>
                    </ol>
                </nav>
                @include('admin.navbar')
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-2">

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">➕ Add New Category</h6>

                        </div>


                    </div>
                    <div class="container mt-5">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <!-- Product Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Category Name</label>
                                    <input type="text" name="name" class="form-control border-0 shadow-sm" placeholder="Enter Category name" required>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Slug</label>
                                    <input type="text" name="slug" class="form-control border-0 shadow-sm" placeholder="Auto-generated or enter manually" required>
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control border-0 shadow-sm" rows="4" placeholder="Write Category description..." required></textarea>
                                </div>

                                <!-- Image -->
                                <div class="col-12">
                                    <label class="form-label fw-bold">Product Image</label>
                                    <input type="file" name="image" class="form-control border-0 shadow-sm" required>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success px-4 shadow">
                                    <i class="fas fa-save me-1"></i> Save Category
                                </button>
                            </div>
                        </form>
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