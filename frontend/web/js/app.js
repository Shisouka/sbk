(function($){
    if($('.slider, .mask, .zoom, #reviews .reviews_list').length){
        $('.slider').bxSlider({
            mode: 'fade',
            captions: true,
            pager:true,
            auto:true,
            controls:true,
            nextText:'Следующий отзыв >>',
            prevText:'<< Предыдущий отзыв'
        });
        $('#reviews .reviews_list').bxSlider({
            mode: 'fade',
            captions: true,
            pager:true,
            auto:false,
            controls:true,
            nextText:'Следующий отзыв >>',
            prevText:'<< Предыдущий отзыв'
        });
        $('input.mask').mask("+7(999)999-99-99");

        $('.photos').bxSlider({
            minSlides: 1,
            maxSlides: 8,
        });
    }
    //$('.mobile_nav_block').css('height', $(window).height());
    $('.mobile_nav_show').on('click', function(e){
        e.preventDefault();
        $('header').removeClass('fix');
        if($(this).hasClass('active')){
            $('.mobile_nav_block').removeClass('active');
            $(this).removeClass('active');
            $('.wrap, header').removeClass('left');
            $('.overlay, .mobile_over, .mobile_nav_block_city').removeClass('active');
        }else{
            $(this).addClass('active');
            $('.mobile_nav_block').addClass('active');
            $('.mobile_nav_block').find('.mobile_nav_block_inner').jScrollPane({scrollbarWidth:10});
            $('.overlay').addClass('active');
            $('.wrap').addClass('left');
        }
    });
    (function mobile(){
        $('.mobile_nav_block_city').on('click', function(e){
            e.preventDefault();
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $('.mobile_over').removeClass('active');
            }else{
                $(this).addClass('active');
                $('.mobile_over').addClass('active');
                $('.mobile_nav_block_city_list').find('ul').jScrollPane({scrollbarWidth:10});
            }
        });
        $('.mobile_over').on('click', function(e){
            e.preventDefault();
            $(this).removeClass('active');
            $('.mobile_nav_block_city').removeClass('active');
        });
        $('.mobile_nav_block_city_list').find('li').on('click', function(e){
            //e.preventDefault();
            if (e.which != 2) {
                $(this).addClass('active');
                $('.mobile_nav_block_city, .mobile_over, .top_adres ul li').removeClass('active');
                $('.current-city').find('span').html($(this).find('span').text());
                $('li[data-city="' + $(this).find('span').text() + '"]').addClass('active');
            }
        });
    })();
    $('.overlay').on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('.mobile_nav_show, .citys_current, .select .current.active, .mobile_nav_block, .mobile_nav_block_city, .mobile_over').removeClass('active');
            $('.wrap').removeClass('left');
        }
    });

    (function select(){
        var $block = $('.select');

        $block.find('.current').on('click', function(e){
            e.preventDefault();
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $(this).next('.select-list').removeClass('scroll-pane');
                $('.overlay').removeClass('active')
            }else{
                $block.find('.current').addClass('active');
                $(this).next('.select-list').addClass('scroll-pane');
                $('.scroll-pane').jScrollPane({scrollbarWidth:10});
                $('.overlay').addClass('active');
                $block.find('.select-list:not(".no-pane")').find('a').on('click', function(e){
                    e.preventDefault();
                });
                $block.find('.select-list:not(".no-pane")').find('li').on('click', function(e){
                    e.preventDefault();
                    $block.find('.active').removeClass('active');
                    $(this).addClass('active');
                    $block.find('.current').find('b').html($(this).find('a').text());

                });

            }
        });
    })();

    $('.photos_list').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true
    });
    $('.why_slider').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1
    });
    (function callback(){
        var $callback = $('.callback_block');
        $('a.callback').on('click', function(e){
            e.preventDefault();
            if($(this).closest('div').hasClass('contacts_callback')){
                if($('header .callback_block').css('display')!='none')
                    $('header .callback_block').slideUp(500);
                else
                    $('header .callback_block').slideDown(500);
            }else{
                if($('footer').prev('.callback_block').css('display')!='none')
                    $('footer').prev('.callback_block').slideUp(500);
                else
                    $('footer').prev('.callback_block').slideDown(500);
            }
        });
        $('a.callback_close').on('click', function(e){
            e.preventDefault();
            $callback.slideUp(500);
        });
    })();
    (function scroll_top(){
        var $header = $('header'), prev = 0;
        $(window).scroll(function(){
            var current = $(window).scrollTop();
            if(!$('.mobile_nav_block').hasClass('active')){
                if(current > 76){
                    if(current < prev){
                        $header.removeClass('fix');
                    }else{
                        $header.addClass('fix');
                    }
                }

            }else{
                $header.removeClass('fix');
            }

            prev = current;
        });
    })();
    (function contacts(){
        var $contacts = $('.contacts'), back = 'Свернуть', text = '';
        $contacts.find('.show').find('a').on('click', function(e){
            e.preventDefault();
            $(this).closest('.contacts_item').toggleClass('active');
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $(this).html(text);
            }else{
                $(this).addClass('active');
                text = $(this).text();
                $(this).html(back);
            }

        });
    })();
    (function scroll(){
        $('a.scroll').on('click', function(e){
            e.preventDefault();
            $('body, html').animate({scrollTop: $( '.'+ $( this ).data('block') + '' ).offset().top}, 500)
        });
    })();

    (function tabs(){
        var $tabs = $('.tabs:not(.courase, .t_portfolio)'), $nav = $tabs.find('.tabs_nav'), $tabs_content = $tabs.find('.tabs_content'), $t_portfolio = $('.tabs.t_portfolio');
        $t_portfolio.find('a:not(.show,.button)').on('click',function(e){
            e.preventDefault();
            function slideTab($obj) {
                $obj.closest('.tabs').find('.active').removeClass('active');
                $obj.addClass('active');
                $obj.closest('li').addClass('active');
                $obj.closest('.tabs').find('.tabs_content').find('[data-teacherid="'+$that.data('teacherid')+'"]').addClass('active').addClass('test');
            }
            $that = $(this);
            //Проверям есть ли слайд преподователя в коллекции
            if($that.attr('data-isload') == 'false'){
                $.ajax({
                    type: "get",
                    dataType : "html",
                    url: '/teacher-portfolio',
                    data: "teacher_id="+$(this).attr('data-teacherid'),
                    cache: false,
                    success: function($response){
                        $r = $($response);
                        $r.find('.photos_list').slick({
                            dots: false,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 1,
                            centerMode: true,
                            variableWidth: true
                        });
                        $t_portfolio.find('.tabs_content ul:first').append($r);
                        //Говорим что слайд уже загружен и находися в коллекции
                        $that.attr('data-isload','true');
                        slideTab($that);
                    }
                });
            }else{
                slideTab($that);
            }
        });
        $tabs.each(function(){
            $(this).find('.tabs_content').find('li.tabs_item:nth-child('+$(this).find('a.active').data('item')+')').addClass('active');
        });

        var selectTab = function(e){
            var that = null;
            if(undefined !== $(this).data('get-request')) {
                //the button where target is tab
                that = $tabs.find('a[data-item="'+$(this).data('item')+'"]:not(.show,.button)');
            } else {
                //default
                that = $(this);
                e.preventDefault();
            }

            if(that.parent().parent().attr('class') === 'career_tabs') {
                $('a#cost_spec_anchor').attr({'href':'#cost_'+that.data('item')});
            }

            that.closest('.tabs').find('.active').removeClass('active');
            that.addClass('active');
            that.closest('li').addClass('active');
            that.closest('.tabs').find('.tabs_content').find('li:nth-child('+that.data('item')+')').addClass('active');
        }

        $tabs.find('a:not(.show,.button)').on('click', selectTab);

        $('a[data-get-request=""]').on('click', selectTab);

        $t_portfolio.find('a.show').on('click', function(e){
            e.preventDefault();
            $(this).closest('.tabs').find('.hidden').removeClass('hidden');
            $(this).removeClass('show');
            $(this).hide();
        });
        $('.horizontal-only').jScrollPane({scrollbarWidth:0});
    })();
    (function select_city(){
        var $block = $('.citys'), $current = $block.find('.citys_current');
        $current.on('click', function(e){
            e.preventDefault();
            if($(this).hasClass('active')){
                $(this).removeClass('active');
                $('.overlay').removeClass('active');
            }else{
                $(this).addClass('active');
                $('.overlay').addClass('active');
            }
        });
        $block.find('ul li').on('click', function(e){
            //e.preventDefault();
            if (e.which != 2){
                $block.find('.active').removeClass('active');
                $('.overlay, .mobile_nav_block_city_list ul li').removeClass('active');
                $(this).addClass('active');
                $current.find('span').find('b').html($(this).find('span').text());
                $('.current-city').find('span').html($(this).find('span').text());
                $('li[data-city="'+$(this).find('span').text()+'"]').addClass('active');
            }
        });
    })();

    $('.close, .overlay').on('click', function(){
        $('.hiddenBlock, .overlay').removeClass('active');
        $('.video .hiddenBlock_inner iframe').remove();
        return false;
    });

    $('.show-popup').on('click', function(e){
        e.preventDefault();
        var div = $(this).data('block');
        $('.overlay').show();
        if($(this).hasClass('show-video')){
            $('.'+div+'').find('.close').after('<iframe width="100%" height="515" src="'+$(this).data('link')+'" frameborder="0" ></iframe>');
            $('.'+div+'').show();
        }else{
            $('.'+div+'').show();
        }
        return false;
    });


    (function validate_form()
    {
        var container = $('.ajax_form_block'), main;
        container.on('keyup', '.valid', function(e){
            main = $(this).closest('.form-block');
            if($(this).hasClass('email')){
                if($(this).val() != '') {
                    var mail = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                    if(mail.test($(this).val())){
                        $(this).addClass('ok').removeClass('error').css('border-color','#e9e9e9');
                    } else {
                        $(this).removeClass('ok').addClass('error').css('border-color','red');
                    }
                } else {
                    $(this).removeClass('ok').addClass('error').css('border-color','red');
                }
            }
            if($(this).hasClass('phone')){
                if($(this).val() != '') {
                    var phone = /^\([0-9]{3}\)[0-9]{3}-[0-9]{2}\-[0-9]{2}/;
                    if(phone.test($(this).val().replace('+7', ''))){
                        $(this).addClass('ok').removeClass('error').css('border-color','#e9e9e9');
                    } else {
                        $(this).removeClass('ok').addClass('error').css('border-color','red');
                    }
                } else {
                    $(this).removeClass('ok').addClass('error').css('border-color','red');
                }
            }
            if($(this).hasClass('name')){
                if($(this).val() != ''){
                    if($.isNumeric($(this).val())){
                        $(this).removeClass('ok').addClass('error').css('border-color','red');
                    }else{
                        if($(this).val().length > 2){
                            $(this).addClass('ok').removeClass('error').css('border-color','#e9e9e9');
                        }
                        else{
                            $(this).removeClass('ok').addClass('error').css('border-color','red');
                        }
                    }
                }else{
                    $(this).removeClass('ok').addClass('error').css('border-color','red');
                }
            }
            if($(this).hasClass('text')){
                if($(this).val() != ''){
                    if($.isNumeric($(this).val())){
                        $(this).removeClass('ok').addClass('error').css('border-color','red');
                    }else{
                        if($(this).val().length > 2){
                            $(this).addClass('ok').removeClass('error').css('border-color','#e9e9e9');
                        }
                        else{
                            $(this).removeClass('ok').addClass('error').css('border-color','red');
                        }
                    }
                }else{
                    $(this).removeClass('ok').addClass('error').css('border-color','red');
                }
            }
            if(!main.find('.valid').hasClass('error')){
                main.find('.button').prop('disabled', false);
            }else{
                main.find('.button').prop('disabled', true);
            }
        });
        container.on('submit', 'form', function(e) {

            e.preventDefault();
            e.stopPropagation();

            var form = $(this), data = $(this).serialize();
            urlBase = form.attr('action');


            $.ajax({
                type: "post",
                dataType : "html",
                url: urlBase,
                data: "q="+urlBase+"&data="+data,
                cache: false,
                success: function(response){

                    setTimeout(function() {
                        if(form.closest('.hiddenBlock')){
                            form.closest('.hiddenBlock').hide();
                            form[0].reset();
                            $('.thanks-block, .overlay').show();
                            $('input[type="submit"]').prop('disabled',true);
                        }else{
                            $('.thanks-block, .overlay').show();
                            $('input[type="submit"]').prop('disabled',true);
                            form[0].reset();
                        }

                    }, 300);
                }
            });
        });
    })();

    var layout_elevator = $('#layout_elevator');

    $(document).on('scroll',function(e){
        ($(this).scrollTop() > (window.innerHeight/2)) ? layout_elevator.addClass('show-elevator') : layout_elevator.removeClass('show-elevator');
    });
    layout_elevator.on('click',function(e){
        e.preventDefault();
        $('html,body').animate({scrollTop:0},500);
    });

})(jQuery);