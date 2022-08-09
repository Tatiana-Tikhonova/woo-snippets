$(document).ready(function () {
    /**
     * required slick-slider
     */
    if ($('.home-tabs__panel .products').length > 0) {
        $('.home-tabs__panel .products').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            variableWidth: true

        });
    }


    function getHomeTabsContent() {
        $('.home-tabs-buttons__btn').on('click', function (e) {
            let buttons = $('.home-tabs-buttons__btn'),
                attr = $(e.target).attr('data-tabs'),
                overlay = $(this).parents('.home-tabs').find('.home-tabs__overlay'),
                data = {
                    action: 'tab_action',
                    nonce: get__tabs.nonce
                },
                errMessage = '<div class="err-message">Произошла ошибка, пожалуйста обновите страницу!</div>',
                tabBtns = $(this).parent();


            $(buttons).removeClass('active');
            $(e.target).addClass('active');
            $(overlay).addClass('visible');
            $(buttons).each(function (i, el) {
                $(el).prop("disabled", true);
            });

            if (attr == 'hits') {
                data.hits = 1;
            } else if (attr == 'news') {
                data.news = 1;
            } else if (attr == 'recommend') {
                data.recommend = 1;
            } else if (attr == 'sale') {
                data.sale = 1;
            }

            $.ajax({
                url: get__tabs.url,
                data: data,
                type: 'POST',
                dataType: 'json',
                error: function () {
                    if ($(tabBtns).next('.home-tabs__panel').find('.products').length > 0) {
                        $('.home-tabs__panel .products').slick('unslick');

                        $(tabBtns).next('.home-tabs__panel').find('.products').html(errMessage);
                        $(overlay).removeClass('visible');

                    }
                },
                success: function (data) {
                    data.out = data.out.slice(1, -1);

                    if ($(tabBtns).next('.home-tabs__panel').find('.products').length > 0) {
                        $('.home-tabs__panel .products').slick('unslick');
                        $(tabBtns).next('.home-tabs__panel').find('.products').html(data.out);
                        $('.home-tabs__panel .products').slick({
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            variableWidth: true,

                        });
                        $(overlay).removeClass('visible');
                        $(buttons).each(function (i, el) {
                            $(el).prop("disabled", false);
                        });
                    }


                }
            });

        });
    }
    if ($('.home-tabs').length > 0) { getHomeTabsContent(); }
});