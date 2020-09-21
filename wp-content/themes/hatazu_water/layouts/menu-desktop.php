<!-- desktop site__header -->
<header class="site__header d-lg-block d-none">
	<div class="site-header">
		<!-- .topbar -->
		<?php get_template_part('layouts/top-bar'); ?>
		<!-- .topbar / end -->
		<div class="site-header__middle container">
			<div class="site-header__logo">
				<a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_directory');?>/images/swater-header.png"></a>
			</div>
			<div class="site-header__search">
				<div class="search search--location--header">
					<div class="search__body">
						<form role="search" method="get" class="search__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search__input" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off" />
							<button class="search__button search__button--type--submit" type="submit"><svg width="20px" height="20px">
									<use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#search-20">
									</use>
									</svg>
							</button>
							<input type="hidden" name="post_type" value="product" />
							<div class="search__border"></div>
						</form>
						<div class="search__suggestions suggestions suggestions--location--header">
						</div>
					</div>
				</div>
			</div>
			<div class="site-header__phone">
				<div class="site-header__phone-title">Customer Service</div>
				<div class="site-header__phone-number">(800) 060-0730</div>
			</div>
		</div>
		<div class="site-header__nav-panel">
			<!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
			<div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
				<div class="nav-panel__container container">
					<div class="nav-panel__row">
						<div class="nav-panel__departments">
							<!-- .departments -->
							<div class="departments " data-departments-fixed-by=".block-slideshow">
								<div class="departments__body">
									<div class="departments__links-wrapper">
										<div class="departments__submenus-container"></div>
										<?php get_template_part('layouts/depart-link'); ?>
									</div>
								</div>
								<button class="departments__button">
								 <svg class="departments__button-icon" width="18px" height="14px">
									<use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#menu-18x14">
									</use>
									</svg> 
								Shop By Category  
								 	<svg class="departments__button-arrow" width="9px" height="6px">
										<use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-9x6">
										</use>
									</svg> 
								</button>
							</div>
							<!-- .departments / end -->
						</div>
						<!-- .nav-links -->
						<?php get_template_part('layouts/nav-link'); ?>
						<!-- .nav-links / end -->
						<div class="nav-panel__indicators">
							<div class="indicator">
                                <a href="wishlist.html" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#heart-20"></use>
                                        </svg>
                                        <span class="indicator__value">0</span>
                                    </span>
                                </a>
                            </div>
							<?php get_template_part('layouts/mini-cart'); ?>
							<div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#person-20"></use>
                                        </svg>
                                    </span>
                                </a>
                                <div class="indicator__dropdown">
                                    <div class="account-menu">
                                    <?php	if ( !is_user_logged_in() ) {
                                    	 wc_get_template( 'global/form-login-menu.php' );
                                    	} else {
                                    	  $user = wp_get_current_user();
							              $avatar = apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' );
							              if (!$avatar ) { 
							                $avatar = get_template_directory_uri() . '/images/avatars/avatar-1.jpg'; 
							               }
                                    	?>    
                                        <div class="account-menu__divider"></div>
                                        <a href="account-dashboard.html" class="account-menu__user">
                                            <div class="account-menu__user-avatar">
                                                <img src="<?php echo $avatar; ?>" alt="">
                                            </div>
                                            <div class="account-menu__user-info">
                                                <div class="account-menu__user-name"><?php echo esc_attr( $user->display_name ); ?></div>
                                                <div class="account-menu__user-email"><?php echo esc_attr( $user->user_email ); ?></div>
                                            </div>
                                        </a>
                                        <div class="account-menu__divider"></div>
                                        <?php wc_get_template( 'myaccount/navigation-menu.php' ); ?>
                                        <div class="account-menu__divider"></div>
                                        <ul class="account-menu__links">
                                        </ul>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- desktop site__header / end -->
