<?php
 wp_nav_menu( array(

      'theme_location'    => 'menu-1',

      'menu'              => "menu-1",

      'depth'             => 4,

      'container'         => '',

      'container_class'   => '',

      'container_id'      => '',

      'menu_id'           => 'nav',

      'menu_class'        => 'mobile-links mobile-links--level--0',

      'fallback_cb'       => 'wp_bootstrap_navwalker_mobile_link::fallback',

      'walker'            => new wp_bootstrap_navwalker_mobile_link(),
      'items_wrap' => '<ul id="%1$s" class="%2$s" data-collapse="" data-collapse-opened-class="mobile-links__item--open">%3$s</ul>'

  ) );

?>  