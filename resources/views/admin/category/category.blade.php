<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin1/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/admin1/assets/img/favicon.png')}}">
    <title>
        Category
    </title>
    @include('admin.css')
    <style>
        .modal-body {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Category</li>
                    </ol>
                </nav>
                @include('admin.navbar')
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-2">
            <div class="d-flex justify-content-end mb-3 mt-4">
                <a href="{{ route('admin.category.create')}}" class="btn btn-success btn-sm me-3">
                    <i class="fas fa-plus me-1"></i> Add Category
                </a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Categories Table</h6>

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
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm">{{ $category->description }}</h6>
                                            </td>
                                            <!-- <td>
                                                @php
                                                $shortDesc = Str::limit($category->description, 50); // show only first 50 chars
                                                @endphp

                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $shortDesc }}
                                                    @if(strlen($category->description) > 50)
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#descModal{{ $category->id }}" class="text-primary ms-1">View More</a>
                                                    @endif
                                                </p>

                                                Modal
                                                <div class="modal fade" id="descModal{{ $category->id }}" tabindex="-1" aria-labelledby="descModalLabel{{ $category->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="descModalLabel{{ $category->id }}">Category Description</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-secondary">{{ $category->description }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> -->

                                            <td>
                                                <span class="badge bg-gradient-secondary">{{ $category->slug }}</span>
                                            </td>
                                            <td>
                                                @if($category->image)
                                                <img src="{{ Storage::url($category->image) }}"
                                                    class="avatar avatar-lg me-3 border-radius-lg"
                                                    alt="{{ $category->name }}">
                                                @else
                                                <img src="{{ asset('assets/admin1/assets/img/default.png') }}"
                                                    class="avatar avatar-sm me-3 border-radius-lg"
                                                    alt="default">
                                                @endif

                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                    method="POST"
                                                    style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
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

            @include('admin.footer')
        </div>
    </main>
    @include('admin.plugin')
    @include('admin.js')
</body>

</html>