<div class="main">
  <div class="container">
    <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
    <div class="row margin-bottom-40">
      <div class="col-md-12 sale-product">
        <h2>New Arrivals</h2>
        <div class="owl-carousel owl-carousel5">
          @foreach($products as $product)
          <div>
            <div class="product-item">
              <div class="pi-img-wrapper">
                <img src="{{ asset('uploads/products/' . $product->image) }}"
                  class="img-responsive"
                  alt="{{ $product->name }}">

                <div>
                  <a href="{{ asset('uploads/products/' . $product->image) }}"
                    class="btn btn-default fancybox-button">Zoom</a>

                  <a href="#product-pop-up"
                    class="btn btn-default fancybox-fast-view">View</a>
                </div>
              </div>
              <h3><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>

              {{-- price with discount --}}
              @if($product->discount > 0)
              <div class="pi-price">
                ${{ $product->price - $product->discount }}
                <span style="text-decoration: line-through; font-size: 13px; color: #888;">
                  ${{ $product->price }}
                </span>
              </div>
              @else
              <div class="pi-price">${{ $product->price }}</div>
              @endif

              <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>

              {{-- optional: sticker if new or on sale --}}
              @if($product->created_at->gt(now()->subDays(7)))
              <div class="sticker sticker-new"></div>
              @elseif($product->discount > 0)
              <div class="sticker sticker-sale"></div>
              @endif
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <!-- END SALE PRODUCT & NEW ARRIVALS -->



    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40 ">
      <div class="sidebar col-md-3 col-sm-4">
        <!-- BEGIN SIDEBAR -->
        <ul class="list-group margin-bottom-25 sidebar-menu">
          @foreach($categories as $category)
          <li class="list-group-item clearfix dropdown">
            <a href="{{ route('category.show', $category->id) }}">
              <i class="fa fa-angle-right"></i> {{ $category->name }}
            </a>

            {{-- check if category has subcategories --}}
            @if($category->subcategories->count() > 0)
            <ul class="dropdown-menu">
              @foreach($category->subcategories as $subcategory)
              <li class="list-group-item dropdown clearfix">
                <a href="{{ route('subcategory.show', $subcategory->id) }}">
                  <i class="fa fa-angle-right"></i> {{ $subcategory->name }}
                </a>
              </li>
              @endforeach
            </ul>
            @endif
          </li>
          @endforeach
        </ul>

      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN CONTENT -->
      <div class="col-md-9 col-sm-8">
        <h2>Three items</h2>
        <div class="owl-carousel owl-carousel3">
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
      <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->




    <!-- BEGIN TWO PRODUCTS & PROMO -->
    <div class="row margin-bottom-35 ">
      <!-- BEGIN TWO PRODUCTS -->
      <div class="col-md-6 two-items-bottom-items">
        <h2>Two items</h2>
        <div class="owl-carousel owl-carousel2">
          <div>
            <div class="product-item">
              <div class="pi-img-wrapper">
                <img src="{{asset('assets/user1/theme/assets/pages/img/products/k4.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
                <div>
                  <a href="{{asset('assets/user1/theme/assets/pages/img/products/k4.jpg')}}" class="btn btn-default fancybox-button">Zoom</a>
                  <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                </div>
              </div>
              <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
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
              <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
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
              <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
              <div class="pi-price">$29.00</div>
              <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
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
              <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
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
              <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
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
              <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
              <div class="pi-price">$29.00</div>
              <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
            </div>
          </div>
        </div>
      </div>
      <!-- END TWO PRODUCTS -->
      <!-- BEGIN PROMO -->
      <div class="col-md-6 shop-index-carousel">
        <div class="content-slider">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="{{asset('assets/user1/theme/assets/pages/img/index-sliders/slide1.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
              </div>
              <div class="item">
                <img src="{{asset('assets/user1/theme/assets/pages/img/index-sliders/slide2.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
              </div>
              <div class="item">
                <img src="{{asset('assets/user1/theme/assets/pages/img/index-sliders/slide3.jpg')}}" class="img-responsive" alt="Berry Lace Dress">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END PROMO -->
    </div>
    <!-- END TWO PRODUCTS & PROMO -->
  </div>
</div>



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
         <h2>Cool green dress with red bell</h2>
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
           <p>Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>
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
             <input id="product-quantity" type="text" value="1" readonly name="product-quantity" class="form-control input-sm">
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