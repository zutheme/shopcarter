var init_gallery;
var _quickview;
(function ($) {
    "use strict";

    let passiveSupported = false;

    try {
        const options = Object.defineProperty({}, 'passive', {
            get: function() {
                passiveSupported = true;
            }
        });

        window.addEventListener('test', null, options);
    } catch(err) {}

    let DIRECTION = null;

    function direction() {
        if (DIRECTION === null) {
            DIRECTION = getComputedStyle(document.body).direction;
        }

        return DIRECTION;
    }

    function isRTL() {
        return direction() === 'rtl';
    }

    /*
    // initialize custom numbers
    */
    $(function () {
        $('.input-number').customNumber();
    });


    /*
    // product tabs
    */
    $(function () {
        $('.product-tabs').each(function (i, element) {
            const list = $('.product-tabs__list', element);

            list.on('click', '.product-tabs__item', function (event) {
                event.preventDefault();

                const tab = $(this);
                const pane = $('.product-tabs__pane' + $(this).attr('href'), element);

                if ($(element).is('.product-tabs--stuck')) {
                    window.scrollTo(0, $(element).find('.product-tabs__content').offset().top - $(element).find('.product-tabs__list-body').outerHeight() + 2);
                }

                if (pane.length) {
                    $('.product-tabs__item').removeClass('product-tabs__item--active');
                    tab.addClass('product-tabs__item--active');

                    $('.product-tabs__pane').removeClass('product-tabs__pane--active');
                    pane.addClass('product-tabs__pane--active');
                }
            });

            const currentTab = $('.product-tabs__item--active', element);
            const firstTab = $('.product-tabs__item:first', element);

            if (currentTab.length) {
                currentTab.trigger('click');
            } else {
                firstTab.trigger('click');
            }

            if ($(element).is('.product-tabs--sticky')) {
                let stuckWhen = null;
                let fixedWhen = null;

                function calc() {
                    stuckWhen = list.offset().top + list.outerHeight();
                    fixedWhen = $(element).find('.product-tabs__content').offset().top - $(element).find('.product-tabs__list-body').outerHeight() + 2;
                }

                function onScroll() {
                    if (stuckWhen === null || fixedWhen === null) {
                        calc();
                    }

                    if ( window.pageYOffset >= stuckWhen ) {
                        $(element).addClass('product-tabs--stuck');
                    } else if (window.pageYOffset < fixedWhen) {
                        $(element).removeClass('product-tabs--stuck');
                        $(element).removeClass('product-tabs--header-stuck-hidden');
                    }
                }

                window.addEventListener('scroll', onScroll, passiveSupported ? {passive: true} : false);

                $(document).on('stroyka.header.sticky.show', function(){
                    $(element).addClass('product-tabs--header-stuck');
                    $(element).removeClass('product-tabs--header-stuck-hidden');
                });
                $(document).on('stroyka.header.sticky.hide', function(){
                    $(element).removeClass('product-tabs--header-stuck');

                    if ($(element).is('.product-tabs--stuck')) {
                        $(element).addClass('product-tabs--header-stuck-hidden');
                    }
                });
                $(window).on('resize', function() {
                    stuckWhen = null;
                    fixedWhen = null;
                });

                onScroll();
            }
        });
    });


    /*
    // block slideshow
    */
    $(function() {
        $('.block-slideshow .owl-carousel').owlCarousel({
            items: 1,
            nav: false,
            dots: true,
            loop: true,
            rtl: isRTL()
        });
    });


    /*
    // block brands carousel
    */
    $(function() {
        $('.block-brands__slider .owl-carousel').owlCarousel({
            nav: false,
            dots: false,
            loop: true,
            rtl: isRTL(),
            responsive: {
                1200: {items: 6},
                992: {items: 5},
                768: {items: 4},
                576: {items: 3},
                0: {items: 2}
            }
        });
    });


    /*
    // block posts carousel
    */
    $(function() {
        $('.block-posts').each(function() {
            const layout = $(this).data('layout');
            const options = {
                margin: 30,
                nav: false,
                dots: false,
                loop: true,
                rtl: isRTL()
            };
            const layoutOptions = {
                'grid-3': {
                    responsive: {
                        992: {items: 3},
                        768: {items: 2},
                    }
                },
                'grid-4': {
                    responsive: {
                        1200: {items: 4, margin: 20},
                        992:  {items: 3, margin: 24},
                        768:  {items: 2, margin: 20},
                        460:  {items: 2, margin: 20},
                    }
                },
                'list': {
                    responsive: {
                        992: {items: 2},
                        0:   {items: 1},
                    }
                }
            };
            const owl = $('.block-posts__slider .owl-carousel');
            const owlOptions = $.extend({}, options, layoutOptions[layout]);

            if (/^grid-/.test(layout)) {
                let mobileResponsiveOptions = {};

                if (parseFloat($(this).data('mobile-columns')) === 2) {
                    mobileResponsiveOptions = {
                        460:  {items: 2, margin: 20},
                        400:  {items: 2, margin: 16},
                        320:  {items: 2, margin: 12},
                    };
                } else {
                    mobileResponsiveOptions = {
                        0: {items: 1},
                    };
                }

                owlOptions.responsive = $.extend({}, owlOptions.responsive, mobileResponsiveOptions);
            }

            owl.owlCarousel(owlOptions);

            $(this).find('.block-header__arrow--left').on('click', function() {
                owl.trigger('prev.owl.carousel', [500]);
            });
            $(this).find('.block-header__arrow--right').on('click', function() {
                owl.trigger('next.owl.carousel', [500]);
            });
        });
    });


    /*
    // teammates
    */
    $(function() {
        $('.teammates .owl-carousel').owlCarousel({
            nav: false,
            dots: true,
            rtl: isRTL(),
            responsive: {
                768: {items: 3, margin: 32},
                380: {items: 2, margin: 24},
                0: {items: 1}
            }
        });
    });

    /*
    // quickview
    */
    
    const quickview = {
        cancelPreviousModal: function() {},
        clickHandler: function() {
            const modal = $('#quickview-modal');
            const button = $(this);
            const doubleClick = button.is('.product-card__quickview--preload');
            quickview.cancelPreviousModal();

            if (doubleClick) {
                return;
            }
            //const bg = curent_time();
            button.addClass('product-card__quickview--preload');
            var _nonce = button.attr("nonce");
            var _product_id = button.attr("data-product_id");
            //console.log(_none,_product_id);
            //return false;
            let auth = basicAuth(wooClientKey, wooClientSecret);
           
            //console.log(auth);
            let xhr = null;
            // timeout ONLY_FOR_DEMO!
            //const timeout = setTimeout(function() {
                var _url = _url_blog;
                //var protomatch = /^(http):\/\//; 
                //var _blog = _url.replace(protomatch, 'https://');
                const wooUrl = _url_blog +'/wp-json/wc/v3/products/'+_product_id;
                xhr = $.ajax({
                    type : "GET",
                    //type : "post",
                    dataType : "json",
                    url : wooUrl,
                    //data : {action: "quick_view", product_id : _product_id, nonce: _nonce},
                    //url: ajax_admin + '?action=quick_view',
                    beforeSend: function (req) {
                        req.setRequestHeader('Authorization', auth);
                        req.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
                    },
                    success: function(data) {
                        quickview.cancelPreviousModal = function() {};
                        button.removeClass('product-card__quickview--preload');
                        //console.log(wpApiSettings.tmp_dir;
                        //var myArr = JSON.parse(data);
                        console.log(data);
                        //const end = curent_time();
                        //console.log(end);
                        let _html = '';
                        /*begin html quickview */
_html += '<div class="quickview">';
_html += '    <button class="quickview__close" type="button">';
_html += '        <svg width="20px" height="20px">';
_html += '            <use xlink:href="'+_tmp_dir+'/images/sprite.svg#cross-20"></use>';
_html += '        </svg>';
_html += '    </button>';
_html += '    <div class="product product--layout--quickview" data-layout="quickview">';
_html += '        <div class="product__content">';
_html += '            <!-- .product__gallery -->';
_html += '            <div class="product__gallery">';
_html += '                <div class="product-gallery">';
_html += '                    <div class="product-gallery__featured">';
_html += '                        <button class="product-gallery__zoom">';
_html += '                            <svg width="24px" height="24px">';
_html += '                                <use xlink:href="'+_tmp_dir+'/images/sprite.svg#zoom-in-24"></use>';
_html += '                            </svg>';
_html += '                        </button>';
_html += '                        <div class="owl-carousel" id="product-image">';
                                        for (var i = 0; i < data['images'].length; i++) {
                                            _html += '<div class="product-image product-image--location--gallery"><a href="' + data['images'][i]['src'] + '" data-width="700" data-height="700" class="product-image__body" target="_blank">';
_html += '                                    <img class="product-image__img" src="' + data['images'][i]['src'] + '" alt="">';
_html += '                                </a></div>';
                                        }
_html += '                        </div>';
_html += '                    </div>';
_html += '                    <div class="product-gallery__carousel">';
_html += '                        <div class="owl-carousel" id="product-carousel">';
                                      for (var i = 0; i < data['images'].length; i++) {
                                            _html += '<a href="' + data['images'][i]['src'] + '" class="product-image product-gallery__carousel-item">';
_html += '                                <div class="product-image__body">';
_html += '                                    <img class="product-image__img product-gallery__carousel-image" src="' + data['images'][i]['src'] + '" alt="">';
_html += '                                </div>';
_html += '                            </a>';
                                        }
_html += '                        </div>';
_html += '                    </div>';
_html += '                </div>';
_html += '            </div>';
_html += '            <!-- .product__gallery / end -->';
_html += '            <!-- .product__info -->';
_html += '      <div class="product__info">';
_html += '                <div class="product__wishlist-compare">';
_html += '                    <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="Wishlist">';
_html += '                        <svg width="16px" height="16px">';
_html += '                            <use xlink:href="'+_tmp_dir+'/images/sprite.svg#wishlist-16"></use>';
_html += '                        </svg>';
_html += '                    </button>';
_html += '                    <button type="button" class="btn btn-sm btn-light btn-svg-icon" data-toggle="tooltip" data-placement="right" title="Compare">';
_html += '                        <svg width="16px" height="16px">';
_html += '                            <use xlink:href="'+_tmp_dir+'/images/sprite.svg#compare-16"></use>';
_html += '                        </svg>';
_html += '                    </button>';
_html += '                </div>';
_html += '                <h1 class="product__name">'+data['name']+'</h1>';
_html += '                <div class="product__rating">';
_html += '                    <div class="product__rating-stars">';
_html += '                        <div class="rating">';
_html += '                            <div class="rating__body">';
                                        for (var i = 0; i < 5; i++) {
                                            if(i < data['average_rating']){
                                            _html += '<svg class="rating__star rating__star--active" width="13px" height="12px">';
                                            _html += '  <g class="rating__fill">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal"></use>';
                                            _html += '  </g>';
                                            _html += '  <g class="rating__stroke">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal-stroke"></use>';
                                            _html += '  </g>';
                                            _html += '</svg>';
                                            _html += '<div class="rating__star rating__star--only-edge rating__star--active">';
                                            _html += '  <div class="rating__fill">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '  <div class="rating__stroke">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '</div>';
                                            }else{
                                            _html += '<svg class="rating__star" width="13px" height="12px">';
                                            _html += '  <g class="rating__fill">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal"></use>';
                                            _html += '  </g>';
                                            _html += '  <g class="rating__stroke">';
                                            _html += '      <use xlink:href="'+_tmp_dir+'/images/sprite.svg#star-normal-stroke"></use>';
                                            _html += '  </g>';
                                            _html += '</svg>';
                                            _html += '<div class="rating__star rating__star--only-edge">';
                                            _html += '  <div class="rating__fill">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '  <div class="rating__stroke">';
                                            _html += '      <div class="fake-svg-icon"></div>';
                                            _html += '  </div>';
                                            _html += '</div>';
                                            }       
                                        }                                 
_html += '                            </div>';
_html += '                        </div>';
_html += '                    </div>';
_html += '                    <div class="product__rating-legend">';
_html += '                        <a href="">'+ data['average_rating'] +' Reviews</a><span>/</span><a href="">Write A Review</a>';
_html += '                    </div>';
_html += '                </div>';
_html += '                <div class="product__description">';
_html +=                        data['short_description'];                            
_html += '                </div>';
_html += '                <ul class="product__features">';
_html += '                    <li>Speed: 750 RPM</li>';
_html += '                    <li>Power Source: Cordless-Electric</li>';
_html += '                    <li>Battery Cell Type: Lithium</li>';
_html += '                    <li>Voltage: 20 Volts</li>';
_html += '                    <li>Battery Capacity: 2 Ah</li>';
_html += '                </ul>';
_html += '                <ul class="product__meta">';
_html += '                    <li class="product__meta-availability">Availability: <span class="text-success">In Stock</span></li>';
_html += '                    <li>danh mục: '+ data['categories'][0]['name'] +'</li>';
_html += '                    <li>SKU: '+data['sku']+'</li>';
_html += '                </ul>';
_html += '            </div>';
_html += '            <!-- .product__info / end -->';
_html += '            <!-- .product__sidebar -->';
_html += '            <div class="product__sidebar">';
_html += '                <div class="product__availability">';
_html += '                    Availability: <span class="text-success">'+data['stock_status']+'</span>';
_html += '                </div>';
_html += '                <div class="product__prices">';
_html += '                    '+data['price_html'];
_html += '                </div>';
_html += '                <!-- .product__options -->';
_html += '                <form class="product__options" action="'+ document.URL +'" method="post" enctype="multipart/form-data" data-product_id="'+data['id']+'">';

if(data['attributes']){
   for (var i = 0; i < data['attributes'].length; i++) {
    var k = 0;
    var arr = [];
    for (var t = data['variations'].length-1; t >= 0; t--) {
        if(k < data['attributes'][i]['options'].length){
            arr.push(data['variations'][t]);
        }else{
            break;
        } 
        k++;
    }
    //console.log(arr);
_html += '                    <div class="form-group product__option">';
_html += '                        <label class="product__option-label">'+data['attributes'][i]['name']+'</label>';
_html += '                        <div class="input-radio-label">';
_html += '                            <div class="input-radio-label__list">';
                                        for (var j = 0; j < data['attributes'][i]['options'].length; j++) {                        
_html += '                                <label>';
_html += '                                    <input type="radio" name="attribute_pa_'+data['attributes'][i]['name']+'" value="'+data['attributes'][i]['options'][j]+'" id_variation="'+arr.pop()+'">';
_html += '                                    <span>'+data['attributes'][i]['options'][j]+'</span>';
_html += '                                </label>';
                                        }
_html += '                            </div>';
_html += '                        </div>';
_html += '                    </div>';
    } 
}
_html += '                    <div class="form-group product__option">';
_html += '                        <label class="product__option-label" for="product-quantity">Quantity</label>';
_html += '                        <div class="product__actions">';
_html += '                            <div class="product__actions-item">';
_html += '                                <div class="input-number product__quantity">';
_html += '                                    <input name="quantity" id="product-quantity" class="input-number__input form-control form-control-lg" type="number" min="1" value="1">';
_html += '                                    <div class="input-number__add"></div>';
_html += '                                    <div class="input-number__sub"></div>';
_html += '                                </div>';
_html += '                            </div>';
_html += '                            <div class="product__actions-item product__actions-item--addtocart">';
_html += '                                <button type="submit" name="add-to-cart" value="'+data['id']+'" class="btn btn-primary btn-lg">Add to cart</button>';
_html += '                            </div>';
_html += '                            <div class="product__actions-item product__actions-item--wishlist">';
_html += '                                <button type="button" class="btn btn-secondary btn-svg-icon btn-lg" data-toggle="tooltip" title="Wishlist">';
_html += '                                    <svg width="16px" height="16px">';
_html += '                                        <use xlink:href="'+_tmp_dir+'/images/sprite.svg#wishlist-16"></use>';
_html += '                                    </svg>';
_html += '                                </button>';
_html += '                            </div>';
_html += '                            <div class="product__actions-item product__actions-item--compare">';
_html += '                                <button type="button" class="btn btn-secondary btn-svg-icon btn-lg" data-toggle="tooltip" title="Compare">';
_html += '                                    <svg width="16px" height="16px">';
_html += '                                        <use xlink:href="'+_tmp_dir+'/images/sprite.svg#compare-16"></use>';
_html += '                                    </svg>';
_html += '                                </button>';
_html += '                            </div>';
_html += '                        </div>';
_html += '                    </div>';
_html += '                      <input type="hidden" name="add-to-cart" value="'+data['id']+'">';
_html += '                      <input type="hidden" name="product_id" value="'+data['id']+'">';
_html += '                      <input type="hidden" name="variation_id" class="variation_id" value="0">';
_html += '                </form>';
_html += '                <!-- .product__options / end -->';
_html += '            </div>';
_html += '            <!-- .product__end -->';
_html += '            <div class="product__footer">';
_html += '                <div class="product__tags tags">';
_html += '                    <div class="tags__list">';
                                if(data['tags']){
                                    for (var i = 0; i < data['tags'].length; i++) {
_html += '                              <a href="'+_url_blog+'/product-tag/'+data['tags'][i]['slug']+'">'+data['tags'][i]['name']+'</a>';
                                    }
                                }
_html += '                    </div>';
_html += '                </div>';
_html += '                <div class="product__share-links share-links">';
/*_html += '                      <ul class="share-links__list">';
_html += '                          <li class="fb-like" data-href="'+data['permalink']+'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></li>';
_html += '                          <li class="zalo-share-button" data-href="'+data['permalink']+'" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></li>';
_html += '                      </ul>';*/
_html += '                </div>';
_html += '            </div>';
_html += '        </div>';
_html += '    </div>';
_html += '</div>';
                        /*end html quickview */
                        modal.find('.modal-content').html(_html);
                        create_element_variproduct(data['id']);
                        modal.find('.quickview__close').on('click', function() {
                            modal.modal('hide');
                        });
                        modal.modal('show');
                    }
                });
            //}, 1000);

            quickview.cancelPreviousModal = function() {
                button.removeClass('product-card__quickview--preload');

                if (xhr) {
                    xhr.abort();
                }

                // timeout ONLY_FOR_DEMO!
                //clearTimeout(timeout);
            };
        }
    };

    $(function () {
        const modal = $('#quickview-modal');

        modal.on('shown.bs.modal', function() {
            modal.find('.product').each(function () {
                const gallery = $(this).find('.product-gallery');

                if (gallery.length > 0) {
                    initProductGallery(gallery[0], $(this).data('layout'));
                }
            });

            $('.input-number', modal).customNumber();
        });
        // var _e_product_card__quickview = document.getElementsByClassName("product-card__quickview");
        // for (var i = 0; i < _e_product_card__quickview.length; i++) {
        //     _e_product_card__quickview[i].addEventListener('click',function() {
        //         console.log(this);
        //     });
        // }

        /*$('.product-card__quickview').on('click', function() {
            quickview.clickHandler.apply(this, arguments);
        });*/
        _quickview();
    });

    _quickview =  function(){
        $('.product-card__quickview').on('click', function() {
            quickview.clickHandler.apply(this, arguments);
        });     
    }
    /*
    // products carousel
    */
    $(function() {
        $('.block-products-carousel').each(function() {
            const layout = $(this).data('layout');
            const options = {
                items: 4,
                margin: 14,
                nav: false,
                dots: false,
                loop: true,
                stagePadding: 1,
                rtl: isRTL()
            };
            const layoutOptions = {
                'grid-4': {
                    responsive: {
                        1200: {items: 4, margin: 14},
                        992:  {items: 4, margin: 10},
                        768:  {items: 3, margin: 10},
                    }
                },
                'grid-4-sm': {
                    responsive: {
                        1200: {items: 4, margin: 14},
                        992:  {items: 3, margin: 10},
                        768:  {items: 3, margin: 10},
                    }
                },
                'grid-5': {
                    responsive: {
                        1200: {items: 5, margin: 12},
                        992:  {items: 4, margin: 10},
                        768:  {items: 3, margin: 10},
                    }
                },
                'horizontal': {
                    items: 3,
                    responsive: {
                        1200: {items: 3, margin: 14},
                        992:  {items: 3, margin: 10},
                        768:  {items: 2, margin: 10},
                        576:  {items: 1},
                        475:  {items: 1},
                        0:    {items: 1}
                    }
                },
            };
            const owl = $('.owl-carousel', this);
            let cancelPreviousTabChange = function() {};

            const owlOptions = $.extend({}, options, layoutOptions[layout]);

            if (/^grid-/.test(layout)) {
                let mobileResponsiveOptions;

                if (parseFloat($(this).data('mobile-grid-columns')) === 2) {
                    mobileResponsiveOptions = {
                        420:  {items: 2, margin: 10},
                        320:  {items: 2, margin: 0},
                        0:    {items: 1},
                    };
                } else {
                    mobileResponsiveOptions = {
                        475:  {items: 2, margin: 10},
                        0:    {items: 1},
                    };
                }

                owlOptions.responsive = $.extend({}, owlOptions.responsive, mobileResponsiveOptions);
            }

            owl.owlCarousel(owlOptions);

            $(this).find('.block-header__group').on('click', function(event) {
                const block = $(this).closest('.block-products-carousel');

                event.preventDefault();

                if ($(this).is('.block-header__group--active')) {
                    return;
                }

                cancelPreviousTabChange();

                block.addClass('block-products-carousel--loading');
                $(this).closest('.block-header__groups-list').find('.block-header__group--active').removeClass('block-header__group--active');
                $(this).addClass('block-header__group--active');

                // timeout ONLY_FOR_DEMO! you can replace it with an ajax request
                let timer;
                timer = setTimeout(function() {
                    let items = block.find('.owl-carousel .owl-item:not(".cloned") .block-products-carousel__column');

                    /*** this is ONLY_FOR_DEMO! / start */
                    /**/ const itemsArray = items.get();
                    /**/ const newItemsArray = [];
                    /**/
                    /**/ while (itemsArray.length > 0) {
                    /**/     const randomIndex = Math.floor(Math.random() * itemsArray.length);
                    /**/     const randomItem = itemsArray.splice(randomIndex, 1)[0];
                    /**/
                    /**/     newItemsArray.push(randomItem);
                    /**/ }
                    /**/ items = $(newItemsArray);
                    /*** this is ONLY_FOR_DEMO! / end */

                    block.find('.owl-carousel')
                        .trigger('replace.owl.carousel', [items])
                        .trigger('refresh.owl.carousel')
                        .trigger('to.owl.carousel', [0, 0]);

                    $('.product-card__quickview', block).on('click', function() {
                        quickview.clickHandler.apply(this, arguments);
                    });

                    block.removeClass('block-products-carousel--loading');
                }, 1000);
                cancelPreviousTabChange = function() {
                    // timeout ONLY_FOR_DEMO!
                    clearTimeout(timer);
                    cancelPreviousTabChange = function() {};
                };
            });

            $(this).find('.block-header__arrow--left').on('click', function() {
                owl.trigger('prev.owl.carousel', [500]);
            });
            $(this).find('.block-header__arrow--right').on('click', function() {
                owl.trigger('next.owl.carousel', [500]);
            });
        });
    });


    /*
    // product gallery
    */
    const initProductGallery = function(element, layout) {
        layout = layout !== undefined ? layout : 'standard';

        const options = {
            dots: false,
            margin: 10,
            rtl: isRTL()
        };
        const layoutOptions = {
            standard: {
                responsive: {
                    1200: {items: 5},
                    992: {items: 4},
                    768: {items: 3},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            },
            sidebar: {
                responsive: {
                    768: {items: 4},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            },
            columnar: {
                responsive: {
                    768: {items: 4},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            },
            quickview: {
                responsive: {
                    1200: {items: 5},
                    768: {items: 4},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            }
        };

        const gallery = $(element);

        const image = gallery.find('.product-gallery__featured .owl-carousel');
        const carousel = gallery.find('.product-gallery__carousel .owl-carousel');

        image
            .owlCarousel({items: 1, dots: false, rtl: isRTL()})
            .on('changed.owl.carousel', syncPosition);

        carousel
            .on('initialized.owl.carousel', function () {
                carousel.find('.product-gallery__carousel-item').eq(0).addClass('product-gallery__carousel-item--active');
            })
            .owlCarousel($.extend({}, options, layoutOptions[layout]));

        carousel.on('click', '.owl-item', function(e){
            e.preventDefault();

            image.data('owl.carousel').to($(this).index(), 300, true);
        });

        gallery.find('.product-gallery__zoom').on('click', function() {
            openPhotoSwipe(image.find('.owl-item.active').index());
        });

        image.on('click', '.owl-item a', function(event) {
            event.preventDefault();

            openPhotoSwipe($(this).closest('.owl-item').index());
        });

        function getIndexDependOnDir(index) {
            // we need to invert index id direction === 'rtl' because photoswipe do not support rtl
            if (isRTL()) {
                return image.find('.owl-item img').length - 1 - index;
            }

            return index;
        }

        function openPhotoSwipe(index) {
            const photoSwipeImages = image.find('.owl-item a').toArray().map(function(element) {
                const img = $(element).find('img')[0];
                const width = $(element).data('width') || img.naturalWidth;
                const height = $(element).data('height') || img.naturalHeight;

                return {
                    src: element.href,
                    msrc: element.href,
                    w: width,
                    h: height,
                };
            });

            if (isRTL()) {
                photoSwipeImages.reverse();
            }

            const photoSwipeOptions = {
                getThumbBoundsFn: function(index) {
                    const imageElements = image.find('.owl-item img').toArray();
                    const dirDependentIndex = getIndexDependOnDir(index);

                    if (!imageElements[dirDependentIndex]) {
                        return null;
                    }

                    const imageElement = imageElements[dirDependentIndex];
                    const pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                    const rect = imageElement.getBoundingClientRect();

                    return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                },
                index: getIndexDependOnDir(index),
                bgOpacity: .9,
                history: false
            };

            const photoSwipeGallery = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, photoSwipeImages, photoSwipeOptions);

            photoSwipeGallery.listen('beforeChange', function() {
                image.data('owl.carousel').to(getIndexDependOnDir(photoSwipeGallery.getCurrentIndex()), 0, true);
            });

            photoSwipeGallery.init();
        }

        function syncPosition (el) {
            let current = el.item.index;

            carousel
                .find('.product-gallery__carousel-item')
                .removeClass('product-gallery__carousel-item--active')
                .eq(current)
                .addClass('product-gallery__carousel-item--active');
            const onscreen = carousel.find('.owl-item.active').length - 1;
            const start = carousel.find('.owl-item.active').first().index();
            const end = carousel.find('.owl-item.active').last().index();

            if (current > end) {
                carousel.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                carousel.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }
    };

    $(function() {
        $('.product').each(function () {
            const gallery = $(this).find('.product-gallery');

            if (gallery.length > 0) {
                initProductGallery(gallery[0], $(this).data('layout'));
            }
        });
    });

    init_gallery = (function() {
        $('.product').each(function () {
            const gallery = $(this).find('.product-gallery');

            if (gallery.length > 0) {
                initProductGallery(gallery[0], $(this).data('layout'));
            }
        });
    });
    
    /*
    // Checkout payment methods
    */
    $(function () {
        $('[name="checkout_payment_method"]').on('change', function () {
            const currentItem = $(this).closest('.payment-methods__item');

            $(this).closest('.payment-methods__list').find('.payment-methods__item').each(function (i, element) {
                const links = $(element);
                const linksContent = links.find('.payment-methods__item-container');

                if (element !== currentItem[0]) {
                    const startHeight = linksContent.height();

                    linksContent.css('height', startHeight + 'px');
                    links.removeClass('payment-methods__item--active');
                    linksContent.height(); // force reflow

                    linksContent.css('height', '');
                } else {
                    const startHeight = linksContent.height();

                    links.addClass('payment-methods__item--active');

                    const endHeight = linksContent.height();

                    linksContent.css('height', startHeight + 'px');
                    linksContent.height(); // force reflow
                    linksContent.css('height', endHeight + 'px');
                }
            });
        });

        $('.payment-methods__item-container').on('transitionend', function (event) {
            if (event.originalEvent.propertyName === 'height') {
                $(this).css('height', '');
            }
        });
    });


    /*
    // collapse
    */
    $(function () {
        $('[data-collapse]').each(function (i, element) {
            const collapse = element;

            $('[data-collapse-trigger]', collapse).on('click', function () {
                const openedClass = $(this).closest('[data-collapse-opened-class]').data('collapse-opened-class');
                const item = $(this).closest('[data-collapse-item]');
                const content = item.children('[data-collapse-content]');
                const itemParents = item.parents();

                itemParents.slice(0, itemParents.index(collapse) + 1).filter('[data-collapse-item]').css('height', '');

                if (item.is('.' + openedClass)) {
                    const startHeight = content.height();

                    content.css('height', startHeight + 'px');
                    item.removeClass(openedClass);

                    content.height(); // force reflow
                    content.css('height', '');
                } else {
                    const startHeight = content.height();

                    item.addClass(openedClass);

                    const endHeight = content.height();

                    content.css('height', startHeight + 'px');
                    content.height(); // force reflow
                    content.css('height', endHeight + 'px');
                }
            });

            $('[data-collapse-content]', collapse).on('transitionend', function (event) {
                if (event.originalEvent.propertyName === 'height') {
                    $(this).css('height', '');
                }
            });
        });
    });


    /*
    // price filter
    */
    $(function () {
        $('.filter-price').each(function (i, element) {
            const min = $(element).data('min');
            const max = $(element).data('max');
            const from = $(element).data('from');
            const to = $(element).data('to');
            const slider = element.querySelector('.filter-price__slider');

            noUiSlider.create(slider, {
                start: [from, to],
                connect: true,
                direction: isRTL() ? 'rtl' : 'ltr',
                range: {
                    'min': min,
                    'max': max
                }
            });

            const titleValues = [
                $(element).find('.filter-price__min-value')[0],
                $(element).find('.filter-price__max-value')[0]
            ];

            slider.noUiSlider.on('update', function (values, handle) {
                titleValues[handle].innerHTML = values[handle];
            });
        });
    });


    /*
    // mobilemenu
    */
    $(function () {
        const body = $('body');
        const mobilemenu = $('.mobilemenu');

        if (mobilemenu.length) {
            const open = function() {
                const bodyWidth = body.width();
                body.css('overflow', 'hidden');
                body.css('paddingRight', (body.width() - bodyWidth) + 'px');

                mobilemenu.addClass('mobilemenu--open');
            };
            const close = function() {
                body.css('overflow', '');
                body.css('paddingRight', '');

                mobilemenu.removeClass('mobilemenu--open');
            };


            $('.mobile-header__menu-button').on('click', function() {
                open();
            });
            $('.mobilemenu__backdrop, .mobilemenu__close').on('click', function() {
                close();
            });
        }
    });


    /*
    // tooltips
    */
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
    });


    /*
    // layout switcher
    */
    $(function () {
        $('.layout-switcher__button').on('click', function() {
            const layoutSwitcher = $(this).closest('.layout-switcher');
            const productsView = $(this).closest('.products-view');
            const productsList = productsView.find('.products-list');

            layoutSwitcher.find('.layout-switcher__button').removeClass('layout-switcher__button--active');
            $(this).addClass('layout-switcher__button--active');

            productsList.attr('data-layout', $(this).attr('data-layout'));
            productsList.attr('data-with-features', $(this).attr('data-with-features'));
        });
    });


    /*
    // offcanvas filters
    */
    $(function () {
        const body = $('body');
        const blockSidebar = $('.block-sidebar');
        const mobileMedia = matchMedia('(max-width: 991px)');

        if (blockSidebar.length) {
            const open = function() {
                if (blockSidebar.is('.block-sidebar--offcanvas--mobile') && !mobileMedia.matches) {
                    return;
                }

                const bodyWidth = body.width();
                body.css('overflow', 'hidden');
                body.css('paddingRight', (body.width() - bodyWidth) + 'px');

                blockSidebar.addClass('block-sidebar--open');
            };
            const close = function() {
                body.css('overflow', '');
                body.css('paddingRight', '');

                blockSidebar.removeClass('block-sidebar--open');
            };
            const onChangeMedia = function() {
                if (blockSidebar.is('.block-sidebar--open.block-sidebar--offcanvas--mobile') && !mobileMedia.matches) {
                    close();
                }
            };

            $('.filters-button').on('click', function() {
                open();
            });
            $('.block-sidebar__backdrop, .block-sidebar__close').on('click', function() {
                close();
            });

            if (mobileMedia.addEventListener) {
                mobileMedia.addEventListener('change', onChangeMedia);
            } else {
                mobileMedia.addListener(onChangeMedia);
            }
        }
    });

    /*
    // .block-finder
    */
    $(function () {
        $('.block-finder__select').on('change', function() {
            const item = $(this).closest('.block-finder__form-item');

            if ($(this).val() !== 'none') {
                item.find('~ .block-finder__form-item:eq(0) .block-finder__select').prop('disabled', false).val('none');
                item.find('~ .block-finder__form-item:gt(0) .block-finder__select').prop('disabled', true).val('none');
            } else {
                item.find('~ .block-finder__form-item .block-finder__select').prop('disabled', true).val('none');
            }

            item.find('~ .block-finder__form-item .block-finder__select').trigger('change.select2');
        });
    });

    /*
    // select2
    */
    $(function () {
        $('.form-control-select2, .block-finder__select').select2({width: ''});
    });

    /*
    // totop
    */
    $(function () {
        let show = false;

        $('.totop__button').on('click', function() {
            $('html, body').animate({scrollTop: 0}, '300');
        });

        let fixedPositionStart = 300;

        window.addEventListener('scroll', function() {
            if (window.pageYOffset >= fixedPositionStart) {
                if (!show) {
                    show = true;
                    $('.totop').addClass('totop--show');
                }
            } else {
                if (show) {
                    show = false;
                    $('.totop').removeClass('totop--show');
                }
            }
        }, passiveSupported ? {passive: true} : false);
    });
})(jQuery);
