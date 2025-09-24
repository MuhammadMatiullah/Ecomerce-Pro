<!-- BEGIN SLIDER -->
<div class="page-slider margin-bottom-35">
    <div id="carousel-example-generic" class="carousel slide carousel-slider">

        <!-- Indicators (dynamic) -->
        <ol class="carousel-indicators">
            @foreach($sliders as $key => $slider)
                <li data-target="#carousel-example-generic" 
                    data-slide-to="{{ $key }}" 
                    class="{{ $key == 0 ? 'active' : '' }}">
                </li>
            @endforeach
        </ol>

        <!-- Wrapper for slides (dynamic) -->
        <div class="carousel-inner" role="listbox">
            @foreach($sliders as $key => $slider)
            <div class="item {{ $key == 0 ? 'active' : '' }}"
                 style="background-image: url('{{ asset('uploads/sliders/'.$slider->image) }}'); background-size: cover; background-position: center; height: 500px;">

                <div class="container">
                    <div class="carousel-position-four text-center">
                        <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" 
                            data-animation="animated fadeInDown">
                            {{ $slider->title }}
                        </h2>
                        <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">
                            {{ $slider->subtitle }}
                        </p>
                        <p class="carousel-subtitle-v3" data-animation="animated fadeInUp">
                            {{ $slider->summary }}
                        </p>
                    </div>
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
