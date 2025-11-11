<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @include('admin.css')
</head>
<style>
.modal-xl {
  max-width: 97% !important; 
}

.table td {
  white-space: normal !important; /* allow text to wrap */
  word-wrap: break-word;          /* break long words */
  max-width: 250px;               /* prevent extra-wide cells */
  vertical-align: middle;         /* center vertically */
}
</style>
<body class="g-sidenav-show bg-gray-100">
    @include('admin.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Order Table</li>
                    </ol>
                </nav>
                @include('admin.navbar')
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 mt-n4 mx-3 z-index-2 position-relative">
                            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Orders Table</h6>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Orders</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Amount</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Latest Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $groupedOrders = $orders->groupBy('user_id');
                                        @endphp

                                        @foreach($groupedOrders as $userId => $userOrders)
                                            @php
                                                $user = $userOrders->first()->user;
                                                $totalAmount = $userOrders->sum('total');
                                                $latestStatus = $userOrders->last()->status ?? 'N/A';
                                            @endphp

                                            <tr>
                                                <td><h6 class="mb-0 ms-4 text-sm">{{ $user->name ?? 'N/A' }}</h6></td>
                                                <td><p class="text-xs ms-4  text-secondary mb-0">{{ $userId }}</p></td>
                                                <td><span class="badge ms-4  bg-gradient-info">{{ $userOrders->count() }}</span></td>
                                                <td><span class="badge ms-2  bg-gradient-success">Rs. {{ number_format($totalAmount, 2) }}</span></td>

                                                <td>
                                                    @if($latestStatus === 'pending')
                                                        <span class="badge ms-4  bg-gradient-warning">Pending</span>
                                                    @elseif($latestStatus === 'confirmed')
                                                        <span class="badge ms-4  bg-gradient-info">Confirmed</span>
                                                    @elseif($latestStatus === 'shipped')
                                                        <span class="badge ms-4  bg-gradient-success">Shipped</span>
                                                    @else
                                                        <span class="badge ms-4  bg-gradient-secondary">{{ ucfirst($latestStatus) }}</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-dark view-details-btn mt-3" 
                                                        data-user-id="{{ $userId }}">
                                                        View Details
                                                    </button>
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

    <!-- ✅ Reusable Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header d-flex align-items-center justify-content-between" style="padding: 1rem 1.5rem;">
    <h5 class="modal-title mb-0">Order Details</h5>
    <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close"
        style="border:none; background:none; font-size:24px; line-height:1;">
        <i class="bi bi-x-lg"></i>
    </button>
</div>

          <div class="modal-body" id="detailsModalBody">
            <p class="text-center">Loading...</p>
          </div>
        </div>
      </div>
    </div>


<!-- Model for comment -->
<div class="modal fade" id="commentModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Full Comment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="commentModalBody"></div>
    </div>
  </div>
</div>

<!-- Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Full Description</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="descriptionModalBody"></div>
    </div>
  </div>
</div>
<!-- Description Model Script -->
<script>
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('view-description-btn')) {
        const description = e.target.dataset.description;
        document.getElementById('descriptionModalBody').textContent = description;
        const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
        modal.show();
    }
});
</script>
<!-- comment model script -->
<script>
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('view-comment-btn')) {
        const comment = e.target.dataset.comment;
        document.getElementById('commentModalBody').textContent = comment;
        const modal = new bootstrap.Modal(document.getElementById('commentModal'));
        modal.show();
    }
});
</script>



    <!-- ✅ JavaScript for Dynamic Loading -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.view-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const modalBody = document.getElementById('detailsModalBody');
                const modal = new bootstrap.Modal(document.getElementById('detailsModal'));

                modalBody.innerHTML = '<p class="text-center">Loading...</p>';
                modal.show();

                fetch(`/admin/order/details/${userId}`)
                    .then(response => response.text())
                    .then(html => {
                        modalBody.innerHTML = html;
                    })
                    .catch(error => {
                        modalBody.innerHTML = '<p class="text-danger text-center">Error loading details.</p>';
                        console.error(error);
                    });
            });
        });
    });
    </script>
<!-- sidebar close script -->
    <script>
    // When any modal is opened
    $(document).on('show.bs.modal', function () {
        $('.g-sidenav-show .sidenav').hide(); // hide sidebar
    });

    // When modal is closed
    $(document).on('hidden.bs.modal', function () {
      if ($('.modal.show').length === 0) {
        $('.g-sidenav-show .sidenav').show();
    }
    });
</script>

</body>
</html>
