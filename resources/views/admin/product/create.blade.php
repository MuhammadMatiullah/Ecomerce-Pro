<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/admin1/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/admin1/assets/img/favicon.png')}}">
    <title>
        Add Product
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add Product</li>
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
                            <h6 class="text-white text-capitalize ps-3">➕ Add New Product</h6>

                        </div>


                    </div>
                    <div class="container mt-5">
                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <!-- Product Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Product Name</label>
                                    <input type="text" id="name" name="name" class="form-control border-0 shadow-sm" placeholder="Enter product name" required>
                                </div>

                               
                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Slug</label>
                                     <input type="text" id="slug" name="slug" class="form-control border-0 shadow-sm" readonly>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Category</label>
                                    <select name="category_id" class="form-control border-0 shadow-sm" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Subcategory -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Subcategory</label>
                                    <select name="subcategory_id" class="form-control border-0 shadow-sm" required>
                                        <option value="">-- Select Subcategory --</option>
                                        @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Price -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Price</label>
                                    <input type="number" name="price" class="form-control border-0 shadow-sm" step="0.01" placeholder="Enter price" required>
                                </div>

                                <!-- Discount -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Discount (%)</label>
                                    <input type="number" name="discount" class="form-control border-0 shadow-sm" step="0.01" placeholder="Enter discount">
                                </div>

                                <!-- Quantity -->
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <input type="number" name="quantity" class="form-control border-0 shadow-sm" placeholder="Enter stock quantity" required>
                                </div>

                                <!-- Size -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Size</label>
                                    <select id="size" name="size[]" class="form-control border-0 shadow-sm select2" multiple>
                                        <option value="S">Small</option>
                                        <option value="M">Medium</option>
                                        <option value="L">Large</option>
                                        <option value="XL">X-Large</option>
                                    </select>
                                </div>

                                <!-- Color -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Color</label>
                                    <select id="color" name="color[]" class="form-control border-0 shadow-sm select2" multiple>
                                        <option value="Red">Red</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Green">Green</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                    </select>
                                </div>


                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control border-0 shadow-sm" rows="4" placeholder="Write product description..." required></textarea>
                                </div>

                                <!-- Image -->
                                <div class="col-12">
                                    <label class="form-label fw-bold">Product Image</label>
                                    <input type="file" name="image" class="form-control border-0 shadow-sm" required>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mt-3">
                                <label class="form-label fw-bold">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                                    <label class="form-check-label" for="status">Active</label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success px-4 shadow">
                                    <i class="fas fa-save me-1"></i> Save Product
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
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                tags: true, // allows custom tags
                placeholder: "Select options",
                allowClear: true
            });
        });
    </script>

<script>
    let typingTimer;   // Timer holder
    let delay = 500;   // Delay in ms (0.5 seconds)

    $('#name').on('keyup', function () {
        clearTimeout(typingTimer); // Reset timer if user keeps typing

        let slug = $(this).val()
            .toLowerCase()
            .trim()
            .replace(/ /g, '-')       // replace spaces with -
            .replace(/[^\w-]+/g, ''); // remove special characters

        $('#slug').val(slug); // Show immediate slug

        // Start after delay (debounce)
        typingTimer = setTimeout(function () {
            $.ajax({
                url: "{{ route('admin.check.slug') }}",
                type: "GET",
                data: { slug: slug },
                success: function (data) {
                    $('#slug').val(data.slug); // Update only after server response
                }
            });
        }, delay);
    });
</script>
</body>

</html>