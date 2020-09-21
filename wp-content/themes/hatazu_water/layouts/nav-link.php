<!-- .nav-links -->
<div class="nav-panel__nav-links nav-links">
	<?php

                 wp_nav_menu( array(

                      'theme_location'    => 'menu-1',

                      'menu'              => "menu-1",

                      'depth'             => 4,

                      'container'         => '',

                      'container_class'   => '',

                      'container_id'      => '',

                      'menu_id'           => 'nav',

                      'menu_class'        => 'nav-links__list',

                      'fallback_cb'       => 'wp_bootstrap_navwalker_navlink_carter::fallback',

                      'walker'            => new wp_bootstrap_navwalker_navlink_carter(),

                  ) );

                ?>  
</div>
<!-- .nav-links / end -->