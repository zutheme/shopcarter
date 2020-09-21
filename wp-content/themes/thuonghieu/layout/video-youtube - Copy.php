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

                               <!--  <ul class="listEvent">

                                        <li>

                                            <div class="date">

                                               <img src="<?php //bloginfo('template_directory');?>/images/dich-vu/tri-nam.jpg">

                                            </div>

                                            <div class="copy">

                                                    <a>Trị nám</a>

                                                <div>

                                                <p>Thiên khuê có tới hơn 60 dịch vụ từ chăm sóc da hàng tuần đến các dịch vụ trị liệu về da</p>

                                                </div>

                                            </div>

                                        </li>

                                        <li>

                                            <div class="date">

                                               <img src="<?php //bloginfo('template_directory');?>/images/dich-vu/tre-hoa.jpg">

                                            </div>

                                            <div class="copy">

                                                    <a>Trẻ hóa</a>

                                                <div>

                                                    <p>Thiên khuê có tới hơn 60 dịch vụ từ chăm sóc da</p>

                                                </div>

                                            </div>

                                        </li>

                                        <li>

                                            <div class="date">

                                               <img src="<?php //bloginfo('template_directory');?>/images/dich-vu/giam-beo1.jpg">

                                            </div>

                                            <div class="copy">

                                                <a>Giảm béo</a>

                                                <div>

                                                <p>Thiên khuê có tới hơn 60 dịch vụ từ chăm sóc da hàng tuần đến các dịch vụ trị liệu về da</p>

                                                </div>

                                            </div>

                                        </li>

                                        <li>

                                            <div class="date">

                                               <img src="<?php //bloginfo('template_directory');?>/images/dich-vu/tri-mun.jpg">

                                            </div>

                                            <div class="copy">

                                                    <a>Trị mụn</a>

                                                <div>

                                                    <p>Thiên khuê có tới hơn 60 dịch vụ từ chăm sóc da hàng tuần đến các dịch vụ trị liệu về da</p>

                                                </div>

                                            </div>

                                        </li>

                                        

                                </ul> -->

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