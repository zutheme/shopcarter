<header>
        <!-- Thường chứa LOGO, MENU NAVIGATION,... -->
        <div class="hdContainer">
          <a class="logo" href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_directory');?>/assets/images/logo.png"></a>
          <a class="logo-mobile" href="<?php echo get_home_url(); ?>"><img src="<?php bloginfo('template_directory');?>/assets/images/logo-1.png"></a>
          <div class="hamburger-menu">
                <div class="bar"></div>
          </div>
        </div>
         <div class="hdContainer-call">
            <a class="call-mobile" href="tel:0862002112"><img src="<?php bloginfo('template_directory');?>/assets/images/icon-phone.png""> 0862.002.112</a>
        </div>
        <div class="ctMenu">
            <nav>
              <?php

                 wp_nav_menu( array(

                      'theme_location'    => 'menu-1',

                      'menu'              => "menu-1",

                      'depth'             => 3,

                      'container'         => '',

                      'container_class'   => '',

                      'container_id'      => '',

                      'menu_id'           => 'nav',

                      'menu_class'        => '',

                      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',

                      'walker'            => new wp_bootstrap_navwalker(),

                  ) );

                ?>  

               

                <!-- <div class="subLink">

                    <a href="#" target="_blank" class="">Tuyển dụng</a>

                    <a href="#" class="">Liên hệ</a>

                </div> -->

            </nav>

        </div>

    </header>



           