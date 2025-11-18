<?php
/**
 * @var \Illuminate\Database\Eloquent\Model $raffle
 */

$banners = json_encode($raffle->banners);
?>
<div class="banner-container">

    <img
        id="raffle-banner"
        class="banner"
        src="{{ \Storage::url($raffle->banners[0]->banner) }}"
        alt="{{ $raffle->banners[0]->banner_alt ?? '' }}"
    >

    <div class="banner-controls">
        <button class="banner-controls__btn btn btn-icon btn-black" type="button" id="prev">
            <x-icons.left-arrow />
            <span class="sr-only">Previous</span>
        </button>
        <button class="banner-controls__btn btn btn-icon btn-black" type="button" id="next">
            <x-icons.right-arrow />
            <span class="sr-only">Next</span>
        </button>
    </div>

    <script>
        const baseStoragePath = '{{ str_replace('\\', '/', \Storage::url('/')) }}';
        const banners = @json($raffle->banners);
        let position = 0;

        const $banner = document.querySelector('#raffle-banner')
        const $prev = document.querySelector('#prev')
        const $next = document.querySelector('#next')

        $prev.addEventListener('click', () => handleBannerChange(-1))
        $next.addEventListener('click', () => handleBannerChange(1))

        function handleBannerChange(step) {
            console.log(banners)
            position = (position + step) % banners.length

            if (position < 0) position = banners.length - 1

            $banner.src = baseStoragePath + banners[position].banner
            $banner.alt = banners[position].banner_alt ?? ''
        }
    </script>
</div>
