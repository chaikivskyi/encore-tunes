<div
    class="spotify-tracks relative w-10/12 mx-auto flex flex-row"
    x-data="{ swiper: null }"
    x-init="swiper = new Swiper($refs.container, {
      slidesPerView: 1,
      spaceBetween: 0,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
        1279: {
          slidesPerView: 4,
        },
      },
    })"
>
    <div class="swiper" x-ref="container">
        <div class="swiper-wrapper">
            @foreach ($tracks as $trackId)
                <div class="swiper-slide p-4">
                    <iframe
                        style="border-radius:12px"
                        src="https://open.spotify.com/embed/track/{{ $trackId }}"
                        width="250px"
                        height="352"
                        frameBorder="0"
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy"
                        class="m-auto"
                    >
                    </iframe>
                </div>
            @endforeach
        </div>

        <div class="swiper-button-prev spotify-tracks__carousel__button"></div>
        <div class="swiper-button-next spotify-tracks__carousel__button"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
