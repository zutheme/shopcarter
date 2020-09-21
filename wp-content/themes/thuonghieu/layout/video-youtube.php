<section class="video-youtube partnerPageWrap">

    <div class="container">

        <div class="row item-2">

            <div class="ir-homepage-l">

                <div>

                    <h3 class="title2">Câu chuyện khách hàng</h3>

                        <div class="nanos">

                            <div class="nano-contents">

                                <?php

                                     wp_nav_menu( array(

                                          'theme_location'    => 'menu-video-customer',

                                          'depth'             => 1,

                                          'container'         => '',

                                          'container_class'   => '',

                                          'container_id'      => '',

                                          'menu_id'           => 'listEvent',

                                          'menu_class'        => 'listEvent',

                                          'fallback_cb'       => 'wp_bootstrap_navwalker_youtube::fallback_youtube',

                                          'walker'            => new wp_bootstrap_navwalker_youtube(),

                                      ) );

                                    ?> 

                            </div>

                        </div>

                </div>

            </div>

            <div class="ir-homepage-r">

                <div>

                    <h3 class="title2">

                        <a href="#">Trải nghiệm</a>

                    </h3>

                    <div>

                        <div id="video-container" class="video">

                                <div id="player"></div>

                        </div>                 

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>