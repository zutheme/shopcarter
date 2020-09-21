<section class="newsHomeWrap">
    <div section=".newsHomeWrap" data="200" class="container paralax">
        <a href="#">
            <h2 class="title2">Chuyên gia tư vấn</h2>
        </a>
        <?php
                 wp_nav_menu( array(

                      'theme_location'    => 'menu-archive',

                      'menu'              => "menu-archive",

                      'depth'             => 3,

                      'container'         => '',

                      'container_class'   => '',

                      'container_id'      => '',

                      'menu_id'           => 'newsHomeList',

                      'menu_class'        => 'newsHomeList',

                      'fallback_cb'       => 'wp_bootstrap_navwalker_archive::fallback_archive',

                      'walker'            => new wp_bootstrap_navwalker_archive(),

                  ) );

                ?>  
        <!-- <ul class="newsHomeList">
                <li>
                    <div class="itemNews">
                        <div class="img">
                            <div style="background: url('') center"></div>
                            <img src="">
                        </div>
                        <div class="copy">
                            <h4></h4>
                            <h3></h3>
                             
                        </div>
                        <a class="link" href=""><?php //the_title(); ?></a>
                    </div>
                </li>
        </ul> -->
    </div>
</section>