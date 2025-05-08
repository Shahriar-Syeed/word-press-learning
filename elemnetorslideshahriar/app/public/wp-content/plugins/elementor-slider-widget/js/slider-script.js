jQuery(document).ready(function($) {
    $('.elementor-splide-slider').each(function() {
        const slider = $(this);
        const settings = slider.data('slider-settings');
        
        // Initialize Splide slider
        new Splide(slider[0], {
            type: 'loop',
            perPage: 1,
            perMove: 1,
            gap: '20px',
            arrows: settings.arrows,
            pagination: settings.dots,
            autoplay: settings.autoplay,
            interval: settings.autoplay_speed || 3000,
            pauseOnHover: true,
            pauseOnFocus: true,
            breakpoints: {
                768: {
                    arrows: settings.arrows,
                    pagination: settings.dots
                }
            }
        }).mount();
    });
});