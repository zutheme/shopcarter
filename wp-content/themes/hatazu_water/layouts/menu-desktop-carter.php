 <?php $logo_image = get_field('logo','customizer'); ?>
 <!-- desktop site__header -->
<header class="site__header d-lg-block d-none">
    <div class="site-header">
        <!-- .topbar -->
        <?php get_template_part('layouts/top-bar'); ?>
        <!-- .topbar / end -->
        <div class="site-header__nav-panel">
            <!-- data-sticky-mode - one of [pullToShow, alwaysOnTop] -->
            <div class="nav-panel nav-panel--sticky" data-sticky-mode="pullToShow">
                <div class="nav-panel__container container">
                    <div class="nav-panel__row">
                        <div class="nav-panel__logo">
                            <a href="<?php bloginfo('url'); ?>"><img class="logo-img" src="<?php echo $logo_image['url']; ?>"></a>
                        </div>
                       <!-- .nav-links -->
						<?php get_template_part('layouts/nav-link'); ?>
				<!-- .nav-links / end -->
					
                  		<div class="nav-panel__indicators">
                  			<div class="indicator indicator--trigger--click">
						        <button type="button" class="indicator__button">
						            <span class="indicator__area">
						                <svg width="20px" height="20px" >
						                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg#search-20'; ?>"></use>
						                </svg> 
						                <svg class="indicator__icon indicator__icon--open" width="20px" height="20px">
						                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg#cross-20'; ?>"></use>
						                </svg>
						            </span>
						        </button>
						        <div class="indicator__dropdown">
						            <div class="search search--location--indicator ">
						                <div class="search__body">
						                    <form class="search__form" action="">
						                        <input class="search__input" name="search" placeholder="Search over 10,000 products" aria-label="Site search" type="text" autocomplete="off">
						                        <button class="search__button search__button--type--submit" type="submit">
						                            <svg width="20px" height="20px">
						                                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>'; ?>#search-20"></use>
						                            </svg>
						                        </button>
						                        <div class="search__border"></div>
						                    </form>
						                    <div class="search__suggestions suggestions suggestions--location--indicator"></div>
						                </div>
						            </div>
						        </div>
						    </div>

							
							<?php get_template_part('layouts/mini-cart'); ?>
							<div class="indicator indicator--trigger--click">
                                <a href="#" class="indicator__button">
                                    <span class="indicator__area">
                                        <svg width="20px" height="20px">
                                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg#person-20'; ?>"></use>
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
        <div class="bottom-header">
        	<div class="container">
        		<div class="row">
        			<div class="col-12 text-center">
        				<h3><a href="#">Join Rewarding Moments® and earn points!</a></h3>
        			</div>
        		</div>
        	</div>
        </div>
    </div>
</header>
<!-- desktop site__header / end -->