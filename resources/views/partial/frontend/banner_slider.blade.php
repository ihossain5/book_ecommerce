    <!-- Banner Section -->
    <section class="banner_section pt-20 pb-56">
        <div class="container">
            <div class="banner_slider">
                <div class="owl-carousel owl-theme">
                @if (!empty($sliders))
                    @foreach ($sliders as $slider)
                    <div class="item"><img src="{{ asset('images/'.$slider->image) }}" alt="slider-images">
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </section>