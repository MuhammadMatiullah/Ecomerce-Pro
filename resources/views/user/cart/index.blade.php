<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Shopping cart | Metronic Shop UI</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="favicon.ico">

  @include('user.css')
</head>
<!-- Head END -->

<!-- Body BEGIN -->

<body class="ecommerce">
  @include('user.header')

  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>Shopping cart</h1>
          <div class="goods-page">
            <div class="goods-data clearfix">

              <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Description</th>
                    <th class="goods-page-ref-no">Ref No</th>
                    <th class="goods-page-quantity">Quantity</th>
                    <th class="goods-page-price">Unit price</th>
                    <th class="goods-page-total" colspan="2">Total</th>
                  </tr>
                  @foreach($cartItems as $caritem)
                  <tr>
                    <td class="goods-page-image">
                      <a href="javascript:;"><img src="{{ asset('uploads/products/' . $caritem->product->image) }}" alt="Berry Lace Dress"></a>
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="javascript:;">{{$caritem->product->name}}</a></h3>
                      <p>{{$caritem->product->description}}</p>

                    </td>
                    <td class="goods-page-ref-no">
                      {{$caritem->product->slug}}
                    </td>
                    <!-- Quantity input -->
                    <td class="goods-page-quantity">
                      <div class="product-quantity">
                        <input type="number"
                          value="{{ $caritem->quantity }}"
                          min="1"
                          class="form-control input-sm qty-input"
                          data-price="{{ $caritem->product->price }}">
                      </div>
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>{{$caritem->product->price}}</strong>
                    </td>
                    <td class="goods-page-total">
                      <strong><span>$</span><span class="row-total">{{ $caritem->product->price * $caritem->quantity }}</span></strong>
                    </td>
                    <td class="del-goods-col">
                      <a class="del-goods" href="javascript:;" data-id="{{ $caritem->id }}">&nbsp;</a>
                    </td>

                  </tr>
                  @endforeach

                </table>
              </div>

              <div class="shopping-total">
                <ul>
                  <li>
                    <em>Sub total</em>
                    <strong class="price"><span>$</span><span id="sub-total">
                        {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}
                      </span></strong>
                  </li>
                  <li>
                    <em>Shipping cost</em>
                    <strong class="price"><span>$</span><span id="shipping-cost">3.00</span></strong>
                  </li>
                  <li class="shopping-total-price">
                    <em>Total</em>
                    <strong class="price"><span>$</span><span id="grand-total">
                        {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 3 }}
                      </span></strong>
                  </li>
                </ul>
              </div>




            </div>
            <a href="{{ route('frontend.index') }}" class="btn btn-default">
              Continue shopping <i class="fa fa-shopping-cart"></i>
            </a>

            <button class="btn btn-primary" type="submit">Checkout <i class="fa fa-check"></i></button>
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->

      <!-- BEGIN SIMILAR PRODUCTS -->
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-sm-12">
          <h2>Most popular products</h2>
          <div class="owl-carousel owl-carousel4">
            <div>
              <div class="product-item">
                <div class="pi-img-wrapper">
                  <img src="{{asset('assets/user1/theme/assets/pages/img/products/k1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  <div>
                    <a href="{{asset('assets/user1/theme/assets/pages/img/products/k1.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                  </div>
                </div>
                <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                <div class="pi-price">$29.00</div>
                <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                <div class="sticker sticker-new"></div>
              </div>
            </div>
            <div>
              <div class="product-item">
                <div class="pi-img-wrapper">
                  <img src="{{asset('assets/user1/theme/assets/pages/img/products/k2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  <div>
                    <a href="{{asset('assets/user1/theme/assets/pages/img/products/k2.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                  </div>
                </div>
                <h3><a href="shop-item.html">Berry Lace Dress2</a></h3>
                <div class="pi-price">$29.00</div>
                <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
              </div>
            </div>
            <div>
              <div class="product-item">
                <div class="pi-img-wrapper">
                  <img src="{{asset('assets/user1/theme/assets/pages/img/products/k3.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  <div>
                    <a href="{{asset('assets/user1/theme/assets/pages/img/products/k3.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                  </div>
                </div>
                <h3><a href="shop-item.html">Berry Lace Dress3</a></h3>
                <div class="pi-price">$29.00</div>
                <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
              </div>
            </div>
            <div>
              <div class="product-item">
                <div class="pi-img-wrapper">
                  <img src="{{asset('assets/user1/theme/assets/pages/img/products/k4.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  <div>
                    <a href="{{asset('assets/user1/theme/assets/pages/img/products/k4.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                  </div>
                </div>
                <h3><a href="shop-item.html">Berry Lace Dress4</a></h3>
                <div class="pi-price">$29.00</div>
                <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                <div class="sticker sticker-sale"></div>
              </div>
            </div>
            <div>
              <div class="product-item">
                <div class="pi-img-wrapper">
                  <img src="{{asset('assets/user1/theme/assets/pages/img/products/k1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  <div>
                    <a href="{{asset('assets/user1/theme/assets/pages/img/products/k1.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                  </div>
                </div>
                <h3><a href="shop-item.html">Berry Lace Dress5</a></h3>
                <div class="pi-price">$29.00</div>
                <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
              </div>
            </div>
            <div>
              <div class="product-item">
                <div class="pi-img-wrapper">
                  <img src="{{asset('assets/user1/theme/assets/pages/img/products/k2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                  <div>
                    <a href="{{asset('assets/user1/theme/assets/pages/img/products/k2.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                    <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                  </div>
                </div>
                <h3><a href="shop-item.html">Berry Lace Dress6</a></h3>
                <div class="pi-price">$29.00</div>
                <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END SIMILAR PRODUCTS -->
    </div>
  </div>

  @include('user.step')

  @include('user.footer')

  <!-- BEGIN fast view of a product -->
  <div id="product-pop-up" style="display: none; width: 700px;">
    <div class="product-page product-pop-up">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-3">
          <div class="product-main-image">
            <img src="{{asset('assets/user1/theme/assets/pages/img/products/model7.jpg')}}" alt="Cool green dress with red bell" class="img-responsive">
          </div>
          <div class="product-other-images">
            <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="{{asset('assets/user1/theme/assets/pages/img/products/model3.jpg')}}"></a>
            <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('assets/user1/theme/assets/pages/img/products/model4.jpg')}}"></a>
            <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('assets/user1/theme/assets/pages/img/products/model5.jpg')}}"></a>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-9">
          <h1>Cool green dress with red bell</h1>
          <div class="price-availability-block clearfix">
            <div class="price">
              <strong><span>$</span>47.00</strong>
              <em>$<span>62.00</span></em>
            </div>
            <div class="availability">
              Availability: <strong>In Stock</strong>
            </div>
          </div>
          <div class="description">
            <p>Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat
              Nostrud duis molestie at dolore.</p>
          </div>
          <div class="product-page-options">
            <div class="pull-left">
              <label class="control-label">Size:</label>
              <select class="form-control input-sm">
                <option>L</option>
                <option>M</option>
                <option>XL</option>
              </select>
            </div>
            <div class="pull-left">
              <label class="control-label">Color:</label>
              <select class="form-control input-sm">
                <option>Red</option>
                <option>Blue</option>
                <option>Black</option>
              </select>
            </div>
          </div>
          <div class="product-page-cart">
            <div class="product-quantity">
              <input id="product-quantity3" type="text" value="1" readonly class="form-control input-sm">
            </div>
            <button class="btn btn-primary" type="submit">Add to cart</button>
            <a href="shop-item.html" class="btn btn-default">More details</a>
          </div>
        </div>

        <div class="sticker sticker-sale"></div>
      </div>
    </div>
  </div>
  <!-- END fast view of a product -->

  <script src="assets/user1/theme/assets/plugins/jquery.min.js" type="text/javascript"></script>
  <script src="assets/user1/theme/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
  <script src="assets/user1/theme/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="assets/user1/theme/assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
  <script src="assets/user1/theme/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- END CORE PLUGINS -->

  <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
  <script src="assets/user1/theme/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
  <script src="assets/user1/theme/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
  <script src='assets/user1/theme/assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
  <script src="assets/user1/theme/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
  <script src="assets/user1/theme/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
  <script src="assets/user1/theme/assets/plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script><!-- for slider-range -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="assets/user1/theme/assets/corporate/scripts/layout.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      Layout.init();
      Layout.initOWL();
      Layout.initTwitter();
      Layout.initImageZoom();
      Layout.initTouchspin();
      Layout.initUniform();
      Layout.initSliderRange();
    });
  </script>
  <!-- END PAGE LEVEL JAVASCRIPTS -->

  <script>
    $(document).ready(function() {

      // ✅ Quantity change (works with input, keyup, or TouchSpin events)
      $(document).on('change keyup input', '.qty-input', function() {
        let qty = parseInt($(this).val());
        let price = parseFloat($(this).data('price')); // unit price

        if (isNaN(qty) || qty < 1) qty = 1;
        $(this).val(qty);

        // calculate row total
        let rowTotal = qty * price;

        // update row total in table
        $(this).closest('tr').find('.row-total').text(rowTotal.toFixed(2));

        // update subtotal + grand total
        updateTotals();
      });

      // ✅ Delete item with SweetAlert + AJAX
      $(document).on('click', '.del-goods', function(e) {
        e.preventDefault();
        let row = $(this).closest('tr');
        let itemId = $(this).data('id');

        Swal.fire({
          title: 'Are you sure?',
          text: "This item will be removed from your cart!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "/cart/remove/" + itemId,
              type: "DELETE",
              data: {
                _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                if (response.success) {
                  row.remove();
                  updateTotals();
                  Swal.fire('Deleted!', 'Item has been removed.', 'success');
                }
              },
              error: function() {
                Swal.fire('Error!', 'Something went wrong.', 'error');
              }
            });
          }
        });
      });

      // ✅ Function to update subtotal + grand total
      function updateTotals() {
        let subTotal = 0;

        // loop through each row total
        $('.row-total').each(function() {
          let val = parseFloat($(this).text().trim());
          if (!isNaN(val)) subTotal += val;
        });

        // update subtotal
        $('#sub-total').text(subTotal.toFixed(2));

        // get shipping cost
        let shipping = parseFloat($('#shipping-cost').text().trim()) || 0;

        // update grand total
        let grandTotal = subTotal + shipping;
        $('#grand-total').text(grandTotal.toFixed(2));
      }

    });
  </script>
</body>
<!-- END BODY -->

</html>