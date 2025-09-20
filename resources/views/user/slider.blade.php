 <!-- BEGIN SLIDER -->
 <div class="page-slider margin-bottom-35">
     <div id="carousel-example-generic" class="carousel slide carousel-slider">
         <!-- Indicators -->
         <ol class="carousel-indicators">
             <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
             <li data-target="#carousel-example-generic" data-slide-to="1"></li>
             <li data-target="#carousel-example-generic" data-slide-to="2"></li>
             <li data-target="#carousel-example-generic" data-slide-to="3"></li>
         </ol>

         <!-- Wrapper for slides -->
         <div class="carousel-inner" role="listbox">
             @foreach($sliders as $key => $slider)
             <div class="item {{ $key == 0 ? 'active' : '' }}">
                 <div class="container text-center">
                     <h2>{{ $slider->title }}</h2>
                     <p>{{ $slider->subtitle }}</p>
                     <p>{{ $slider->summary }}</p>
                     @if($slider->image)
                     <img src="{{ asset('uploads/sliders/'.$slider->image) }}" alt="{{ $slider->title }}">
                     @endif
                 </div>
             </div>
             @endforeach
         </div>


         <!-- Controls -->
         <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
             <i class="fa fa-angle-left" aria-hidden="true"></i>
         </a>
         <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
             <i class="fa fa-angle-right" aria-hidden="true"></i>
         </a>
     </div>
 </div>
 <!-- END SLIDER -->