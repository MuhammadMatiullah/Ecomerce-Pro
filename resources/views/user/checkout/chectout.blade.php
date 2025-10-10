<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Checkout | Metronic Shop UI</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">
  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-">
  <meta property="og:url" content="-CUSTOMER VALUE-">

  @include('user.css')
</head>

<body class="ecommerce">
  @include('user.header')

  <div class="main">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="{{ url('/')}}">Home</a></li>
        <li><a href="">Store</a></li>
        <li class="active">Checkout</li>
      </ul>
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>Checkout</h1>
          <!-- BEGIN CHECKOUT PAGE -->
          <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

            @if(!Auth::check())
            <!-- BEGIN CHECKOUT -->
            <div id="checkout" class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">
                  <a data-toggle="collapse" data-parent="#checkout-page" href="#checkout-content" class="accordion-toggle">
                    Step 1: Checkout Options
                  </a>
                </h2>
              </div>
              <div id="checkout-content" class="panel-collapse collapse in">
                <div class="panel-body row">
                  <div class="col-md-6 col-sm-6">
                    <h3>New Customer</h3>
                    <p>Checkout Options:</p>
                    <div class="radio-list">
                      <label>
                        <input type="radio" name="account" value="register"> Register Account
                      </label>
                      <label>
                        <input type="radio" name="account" value="guest"> Guest Checkout
                      </label>
                    </div>
                    <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                    <button class="btn btn-primary" type="submit" data-toggle="collapse" data-parent="#checkout-page" data-target="#payment-address-content">Continue</button>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <h3>Returning Customer</h3>
                    <p>I am a returning customer.</p>
                    <form role="form" action="#">
                      <div class="form-group">
                        <label for="email-login">E-Mail</label>
                        <input type="text" id="email-login" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="password-login">Password</label>
                        <input type="password" id="password-login" class="form-control">
                      </div>
                      <a href="javascript:;">Forgotten Password?</a>
                      <div class="padding-top-20">
                        <button class="btn btn-primary" type="submit">Login</button>
                      </div>
                      <hr>
                      <div class="login-socio">
                        <p class="text-muted">or login using:</p>
                        <ul class="social-icons">
                          <li><a href="javascript:;" data-original-title="facebook" class="facebook" title="facebook"></a></li>
                          <li><a href="javascript:;" data-original-title="Twitter" class="twitter" title="Twitter"></a></li>
                          <li><a href="javascript:;" data-original-title="Google Plus" class="googleplus" title="Google Plus"></a></li>
                          <li><a href="javascript:;" data-original-title="Linkedin" class="linkedin" title="LinkedIn"></a></li>
                        </ul>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- END CHECKOUT -->
            @endif


            @php
            $billing = Auth::user()->addresses()->where('is_billing', true)->first();
            $delivery = Auth::user()->addresses()->where('is_delivery', true)->first();
            @endphp

            <!-- BEGIN PAYMENT ADDRESS -->

            <div id="payment-address" class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">
                  <a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
                    Step 1: Account &amp; Billing Details
                  </a>
                </h2>
              </div>
              <div id="payment-address-content" class="panel-collapse collapse">
                <div class="panel-body row">
                  <div class="col-md-6 col-sm-6">
                    <h3>Your Personal Details</h3>
                    <div class="form-group">
                      <label for="firstname">First Name <span class="require">*</span></label>
                      <input type="text" id="firstname" name="first_name" class="form-control" value="{{ $billing->first_name ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="lastname">Last Name <span class="require">*</span></label>
                      <input type="text" id="lastname" name="last_name" class="form-control" value="{{ $billing->last_name ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="email">E-Mail <span class="require">*</span></label>
                      <input type="text" id="email" name="email" class="form-control" value="{{ $billing->email ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="telephone">Telephone <span class="require">*</span></label>
                      <input type="text" id="telephone" name="telephone" class="form-control" value="{{ $billing->telephone ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="fax">Fax</label>
                      <input type="text" id="fax" name="fax" class="form-control" value="{{ $billing->fax ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="region-state">Region/State <span class="require">*</span></label>
                      <select class="form-control input-sm" id="region-state" name="region_state">
                        <option value=""> --- Please Select --- </option>
                        <option value="3513" {{ ($billing->region_state ?? '') == '3513' ? 'selected' : '' }}>Aberdeen</option>
                        <option value="3514" {{ ($billing->region_state ?? '') == '3514' ? 'selected' : '' }}>Aberdeenshire</option>
                        <option value="3515" {{ ($billing->region_state ?? '') == '3515' ? 'selected' : '' }}>Anglesey</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <h3>Your Address</h3>
                    <div class="form-group">
                      <label for="company">Company</label>
                      <input type="text" id="company" name="company" class="form-control" value="{{ $billing->company ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="address1">Address 1</label>
                      <input type="text" id="address1" name="address1" class="form-control" value="{{ $billing->address1 ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="address2">Address 2</label>
                      <input type="text" id="address2" name="address2" class="form-control" value="{{ $billing->address2 ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="city">City <span class="require">*</span></label>
                      <input type="text" id="city" name="city" class="form-control" value="{{ $billing->city ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="post-code">Post Code <span class="require">*</span></label>
                      <input type="text" id="post-code" name="postcode" class="form-control" value="{{ $billing->postcode ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="country">Country <span class="require">*</span></label>
                      <select class="form-control input-sm" id="country" name="country">
                        <option value=""> --- Please Select --- </option>
                        <option value="244" {{ ($billing->country ?? '') == '244' ? 'selected' : '' }}>Aaland Islands</option>
                        <option value="1" {{ ($billing->country ?? '') == '1' ? 'selected' : '' }}>Afghanistan</option>
                        <option value="2" {{ ($billing->country ?? '') == '2' ? 'selected' : '' }}>Albania</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="col-md-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> I wish to subscribe to the OXY newsletter.
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="same-as-billing" checked="checked"> My delivery and billing addresses are the same.

                      </label>
                    </div>
                    <button class="btn btn-primary pull-right" type="submit"
                      data-toggle="collapse" data-parent="#checkout-page"
                      data-target="#shipping-address-content"
                      id="button-payment-address">
                      Continue
                    </button>


                  </div>
                </div>
              </div>
            </div>
            <!-- END PAYMENT ADDRESS -->

            <!-- BEGIN SHIPPING ADDRESS -->
            <div id="shipping-address" class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">
                  <a data-toggle="collapse" data-parent="#checkout-page" href="#shipping-address-content" class="accordion-toggle">
                    Step 2: Delivery Details
                  </a>
                </h2>
              </div>
              <div id="shipping-address-content" class="panel-collapse collapse">
                <div class="panel-body row">
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="firstname-dd">First Name <span class="require">*</span></label>
                      <input type="text" id="firstname-dd" name="first_name_dd" class="form-control" value="{{ $delivery->first_name ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="lastname-dd">Last Name <span class="require">*</span></label>
                      <input type="text" id="lastname-dd" name="last_name_dd" class="form-control" value="{{ $delivery->last_name ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="email-dd">E-Mail <span class="require">*</span></label>
                      <input type="text" id="email-dd" name="email_dd" class="form-control" value="{{ $delivery->email ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="telephone-dd">Telephone <span class="require">*</span></label>
                      <input type="text" id="telephone-dd" name="telephone_dd" class="form-control" value="{{ $delivery->telephone ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="fax-dd">Fax</label>
                      <input type="text" id="fax-dd" name="fax_dd" class="form-control" value="{{ $delivery->fax ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="company-dd">Company</label>
                      <input type="text" id="company-dd" name="company_dd" class="form-control" value="{{ $delivery->company ?? '' }}">
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="address1-dd">Address 1</label>
                      <input type="text" id="address1-dd" name="address1_dd" class="form-control" value="{{ $delivery->address1 ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="address2-dd">Address 2</label>
                      <input type="text" id="address2-dd" name="address2_dd" class="form-control" value="{{ $delivery->address2 ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="city-dd">City <span class="require">*</span></label>
                      <input type="text" id="city-dd" name="city_dd" class="form-control" value="{{ $delivery->city ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="post-code-dd">Post Code <span class="require">*</span></label>
                      <input type="text" id="post-code-dd" name="postcode_dd" class="form-control" value="{{ $delivery->postcode ?? '' }}">
                    </div>
                    <div class="form-group">
                      <label for="country-dd">Country <span class="require">*</span></label>
                      <select class="form-control input-sm" id="country-dd" name="country_dd">
                        <option value=""> --- Please Select --- </option>
                        <option value="244" {{ ($delivery->country ?? '') == '244' ? 'selected' : '' }}>Aaland Islands</option>
                        <option value="1" {{ ($delivery->country ?? '') == '1' ? 'selected' : '' }}>Afghanistan</option>
                        <option value="2" {{ ($delivery->country ?? '') == '2' ? 'selected' : '' }}>Albania</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="region-state-dd">Region/State <span class="require">*</span></label>
                      <select class="form-control input-sm" id="region-state-dd" name="region_state_dd">
                        <option value=""> --- Please Select --- </option>
                        <option value="3513" {{ ($delivery->region_state ?? '') == '3513' ? 'selected' : '' }}>Aberdeen</option>
                        <option value="3514" {{ ($delivery->region_state ?? '') == '3514' ? 'selected' : '' }}>Aberdeenshire</option>
                        <option value="3515" {{ ($delivery->region_state ?? '') == '3515' ? 'selected' : '' }}>Anglesey</option>
                        <option value="3516" {{ ($delivery->region_state ?? '') == '3516' ? 'selected' : '' }}>Angus</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-primary pull-right" type="submit" id="button-shipping-address" data-toggle="collapse" data-parent="#checkout-page" data-target="#shipping-method-content">Continue</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- END SHIPPING ADDRESS -->






            <!-- BEGIN CONFIRM -->
            <div id="confirm" class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">
                  <a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
                    Step 3: Confirm Order
                  </a>
                </h2>
              </div>

              <div id="confirm-content" class="panel-collapse collapse">
                <div class="panel-body row">
                  <div class="col-md-12 clearfix">

                    <!-- FORM START -->
                    <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                      @csrf

                      <!-- CART TABLE -->
                      <div class="table-wrapper-responsive mb-4">
                        <table class="table">
                          <thead>
                            <tr>
                              <th class="checkout-image">Image</th>
                              <th class="checkout-description">Description</th>
                              <th class="checkout-model">Model</th>
                              <th class="checkout-quantity">Quantity</th>
                              <th class="checkout-price">Price</th>
                              <th class="checkout-total">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($cartItems as $index => $cartItem)
                            <tr>
                              <td class="checkout-image">
                                <a href="javascript:;">
                                  <img src="{{ asset('uploads/products/' . $cartItem->product->image) }}"
                                    alt="{{ $cartItem->product->name }}" width="80">
                                </a>
                              </td>
                              <td class="checkout-description">
                                <h4><a href="javascript:;">{{ $cartItem->product->name }}</a></h4>
                                <p>
                                  <strong>Item {{ $loop->iteration }}</strong> —
                                  Color: {{ $cartItem->product->color ?? 'N/A' }};
                                  Size: {{ $cartItem->product->size ?? 'N/A' }}
                                </p>
                                <em>{{ $cartItem->product->description }}</em>
                              </td>
                              <td class="checkout-model">{{ $cartItem->product->slug }}</td>
                              <td class="checkout-quantity">{{ $cartItem->quantity }}</td>
                              <td class="checkout-price">
                                <strong><span>$</span>{{ number_format($cartItem->product->price, 2) }}</strong>
                              </td>
                              <td class="checkout-total">
                                <strong><span>$</span>{{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</strong>
                              </td>
                            </tr>

                            <!-- ✅ Hidden fields to send product data -->
                            <input type="hidden" name="products[{{ $index }}][id]" value="{{ $cartItem->product->id }}">
                            <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $cartItem->quantity }}">
                            <input type="hidden" name="products[{{ $index }}][price]" value="{{ $cartItem->product->price }}">
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- END CART TABLE -->

                      <!-- HIDDEN FIELDS -->
                      <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                      <input type="hidden" name="shipping" value="{{ $shipping }}">
                      <input type="hidden" name="total" value="{{ $total }}">

                      <div class="row mt-4">
                        <!-- LEFT SIDE -->
                        <div class="col-md-8">
                          <p>Please select the preferred payment method to use on this order.</p>

                          <div class="radio-list mb-3">
                            <label>
                              <input type="radio" name="payment_method" value="CashOnDelivery" checked> Cash On Delivery
                            </label>
                          </div>

                          <div class="form-group mb-3">
                            <label for="delivery-payment-method">Add Comments About Your Order</label>
                            <textarea name="comment" id="delivery-payment-method" rows="6" class="form-control"></textarea>
                          </div>

                          <div class="d-flex align-items-center justify-content-between">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" name="agree" id="termsCheckbox">
                                I have read and agree to the
                                <a title="Terms & Conditions" href="javascript:;">Terms & Conditions</a>
                              </label>
                            </div>
                          </div>
                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-md-4">
                          <div class="checkout-total-block">
                            <ul class="list-unstyled">
                              <li>
                                <em>Sub total</em>
                                <strong class="price"><span>$</span>{{ number_format($subtotal, 2) }}</strong>
                              </li>
                              <li>
                                <em>Shipping cost</em>
                                <strong class="price"><span>$</span>{{ number_format($shipping, 2) }}</strong>
                              </li>
                              <li class="checkout-total-price">
                                <em>Total</em>
                                <strong class="price"><span>$</span>{{ number_format($total, 2) }}</strong>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>

                      <!-- BUTTONS -->
                      <div class="clearfix mt-4">
                        <button class="btn btn-primary pull-right" type="submit" id="button-confirm">Confirm Order</button>
                        <button type="button" class="btn btn-default pull-right margin-right-20">Cancel</button>
                      </div>
                    </form>
                    <!-- END FORM -->


                  </div>
                </div>
              </div>
            </div>
            <!-- END CONFIRM -->






          </div>
          <!-- END CHECKOUT PAGE -->
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>


  @include('user.step')

  @include('user.footer')

  @include('user.js')


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const checkbox = document.getElementById("same-as-billing");
      const billingContinueBtn = document.getElementById("button-payment-address");
      const shippingContinueBtn = document.getElementById("button-shipping-address");

      // Hide Step 3 Continue if same-as-billing is checked
      function toggleStep3() {
        if (checkbox.checked) {
          // Copy values + lock fields
          copyBillingToDelivery();
          lockDeliveryFields(true);

          // Hide Step 3's Continue button
          shippingContinueBtn.style.display = "none";
        } else {
          // Unlock delivery fields
          lockDeliveryFields(false);

          // Show Step 3's Continue button again
          shippingContinueBtn.style.display = "block";
        }
      }

      // Copy Billing → Delivery
      function copyBillingToDelivery() {
        document.getElementById("firstname-dd").value = document.getElementById("firstname").value;
        document.getElementById("lastname-dd").value = document.getElementById("lastname").value;
        document.getElementById("email-dd").value = document.getElementById("email").value;
        document.getElementById("telephone-dd").value = document.getElementById("telephone").value;
        document.getElementById("fax-dd").value = document.getElementById("fax").value;
        document.getElementById("company-dd").value = document.getElementById("company").value;
        document.getElementById("address1-dd").value = document.getElementById("address1").value;
        document.getElementById("address2-dd").value = document.getElementById("address2").value;
        document.getElementById("city-dd").value = document.getElementById("city").value;
        document.getElementById("post-code-dd").value = document.getElementById("post-code").value;
        document.getElementById("country-dd").value = document.getElementById("country").value;
        document.getElementById("region-state-dd").value = document.getElementById("region-state").value;
      }

      // Lock / Unlock Delivery Fields
      function lockDeliveryFields(lock) {
        document.querySelectorAll("#shipping-address-content input, #shipping-address-content select")
          .forEach(el => {
            if (lock) {
              el.setAttribute("readonly", true);
              el.setAttribute("disabled", true); // disable dropdowns also
            } else {
              el.removeAttribute("readonly");
              el.removeAttribute("disabled");
            }
          });
      }

      // Step 2 Continue → Save billing/delivery & move next
      billingContinueBtn.addEventListener("click", function(e) {
        e.preventDefault();

        let data = {
          _token: '{{ csrf_token() }}',
          billing_firstname: document.getElementById("firstname").value,
          billing_lastname: document.getElementById("lastname").value,
          billing_email: document.getElementById("email").value,
          billing_telephone: document.getElementById("telephone").value,
          billing_fax: document.getElementById("fax").value,
          billing_company: document.getElementById("company").value,
          billing_address1: document.getElementById("address1").value,
          billing_address2: document.getElementById("address2").value,
          billing_city: document.getElementById("city").value,
          billing_postcode: document.getElementById("post-code").value,
          billing_country: document.getElementById("country").value,
          billing_region_state: document.getElementById("region-state").value,

          delivery_firstname: document.getElementById("firstname-dd").value,
          delivery_lastname: document.getElementById("lastname-dd").value,
          delivery_email: document.getElementById("email-dd").value,
          delivery_telephone: document.getElementById("telephone-dd").value,
          delivery_fax: document.getElementById("fax-dd").value,
          delivery_company: document.getElementById("company-dd").value,
          delivery_address1: document.getElementById("address1-dd").value,
          delivery_address2: document.getElementById("address2-dd").value,
          delivery_city: document.getElementById("city-dd").value,
          delivery_postcode: document.getElementById("post-code-dd").value,
          delivery_country: document.getElementById("country-dd").value,
          delivery_region_state: document.getElementById("region-state-dd").value
        };

        fetch("{{ route('checkout.saveAddresses') }}", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          }).then(res => res.json())
          .then(res => {
            if (res.success) {
              if (checkbox.checked) {
                // Skip Step 3 → go to Step 4
                $('#shipping-method-content').collapse('show');
              } else {
                // Go to Step 3
                $('#shipping-address-content').collapse('show');
              }
            }
          });
      });

      // Step 3 Continue → Save delivery info then go Step 4
      shippingContinueBtn.addEventListener("click", function(e) {
        e.preventDefault();

        let data = {
          _token: '{{ csrf_token() }}',
          delivery_firstname: document.getElementById("firstname-dd").value,
          delivery_lastname: document.getElementById("lastname-dd").value,
          delivery_email: document.getElementById("email-dd").value,
          delivery_telephone: document.getElementById("telephone-dd").value,
          delivery_fax: document.getElementById("fax-dd").value,
          delivery_company: document.getElementById("company-dd").value,
          delivery_address1: document.getElementById("address1-dd").value,
          delivery_address2: document.getElementById("address2-dd").value,
          delivery_city: document.getElementById("city-dd").value,
          delivery_postcode: document.getElementById("post-code-dd").value,
          delivery_country: document.getElementById("country-dd").value,
          delivery_region_state: document.getElementById("region-state-dd").value
        };

        fetch("{{ route('checkout.saveAddresses') }}", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          }).then(res => res.json())
          .then(res => {
            if (res.success) {
              $('#shipping-method-content').collapse('show');
            }
          });
      });

      // Listen to checkbox toggle
      checkbox.addEventListener("change", toggleStep3);

      // Run once on load
      toggleStep3();
    });
  </script>


  <!-- JS VALIDATION -->
  <script>
    document.getElementById('orderForm').addEventListener('submit', function(event) {
      const terms = document.getElementById('termsCheckbox');
      if (!terms.checked) {
        event.preventDefault();
        alert('⚠️ Please agree to the Terms & Conditions before confirming your order.');
      }
    });
  </script>

</body>
<!-- END BODY -->

</html>