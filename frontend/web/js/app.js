(function($){
    if($('.slider').length) {
        $('.slider').bxSlider({
            mode: 'fade',
            captions: true,
            pager:true,
            auto:true,
            controls:true,
            nextText:'Следующий отзыв >>',
            prevText:'<< Предыдущий отзыв'
        });
    }
})(jQuery);