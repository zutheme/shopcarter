<!-- mobile site__header -->
        <header class="site__header d-lg-none">
            <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
            <div class="mobile-header mobile-header--sticky" data-sticky-mode="pullToShow">
                <div class="mobile-header__panel">
                    <div class="container">
                        <div class="mobile-header__body">
                            <button class="mobile-header__menu-button">
                                <svg width="18px" height="14px">
                                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#menu-18x14"></use>
                                </svg>
                            </button>
                            <a class="mobile-header__logo" href="<?php bloginfo('url'); ?>">
                                <img src="<?php bloginfo('template_directory');?>/images/swater-header.png">
                            </a>
                            <div class="search search--location--mobile-header mobile-header__search">
                                <div class="search__body">
                                    <form role="search" method="get" class="search__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <input type="search" id="mobile-woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search__input" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
                                        <button class="search__button search__button--type--submit" type="submit"><svg width="20px" height="20px">
                                                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#search-20">
                                                </use>
                                                </svg>
                                        </button>
                                        <button class="search__button search__button--type--close" type="button">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#cross-20"></use>
                                            </svg>
                                        </button>
                                        <input type="hidden" name="post_type" value="product" />
                                        <div class="search__border"></div>
                                    </form>
                                    
                                    <div class="search__suggestions suggestions suggestions--location--mobile-header"></div>
                                </div>
                            </div>
                            <div class="mobile-header__indicators">
                                <div class="indicator indicator--mobile-search indicator--mobile d-md-none">
                                    <button class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#search-20"></use>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="indicator indicator--mobile d-sm-flex d-none">
                                   <!--  <a href="wishlist.html" class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?php //echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#heart-20"></use>
                                            </svg>
                                            <span class="indicator__value">0</span>
                                        </span>
                                    </a> -->
                                </div>
                                <div class="indicator indicator--mobile">
                                    <a href="cart.html" class="indicator__button">
                                        <span class="indicator__area">
                                            <svg width="20px" height="20px">
                                                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#cart-20"></use>
                                            </svg>
                                            <span class="indicator__value">3</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile site__header / end -->