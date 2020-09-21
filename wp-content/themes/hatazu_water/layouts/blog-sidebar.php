<div class="block-sidebar__item">
    <div class="widget-search">
         <form role="search" method="get" class="widget-search__body" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div>
            <input class="widget-search__input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Từ khóa" autocomplete="off" spellcheck="false"/>
            <button class="widget-search__button" type="submit">
                <svg width="20px" height="20px">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprite.svg#search-20"></use>
                </svg>
            </button>
        </div>
        </form>
    </div>
</div>
<div class="block-sidebar__item">
    <div class="widget-aboutus widget">
        <h4 class="widget__title">About Blog</h4>
        <div class="widget-aboutus__text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tincidunt, erat in malesuada aliquam, est erat faucibus purus,
            eget viverra nulla sem vitae neque. Quisque id sodales libero.
        </div>
        <!-- social-links -->
        <div class="social-links widget-aboutus__socials social-links--shape--rounded">
            <ul class="social-links__list">
                <li class="social-links__item">
                    <a class="social-links__link social-links__link--type--rss" href="" target="_blank">
                        <i class="fas fa-rss"></i>
                    </a>
                </li>
                <li class="social-links__item">
                    <a class="social-links__link social-links__link--type--youtube" href="" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </li>
                <li class="social-links__item">
                    <a class="social-links__link social-links__link--type--facebook" href="" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="social-links__item">
                    <a class="social-links__link social-links__link--type--twitter" href="" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="social-links__item">
                    <a class="social-links__link social-links__link--type--instagram" href="" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- social-links / end -->
    </div>
</div>
<div class="block-sidebar__item">
    <div class="widget-categories widget-categories--location--blog widget">
        <h4 class="widget__title"><?php esc_html_e( 'Categories', 'hatazu_water' ); ?></h4>
         <?php wp_nav_menu( array(
          'theme_location'    => 'menu-1',

          'menu'              => "menu-1",

          'depth'             => 4,

          'container'         => '',

          'container_class'   => '',

          'container_id'      => '',

          'menu_id'           => '',

          'menu_class'        => 'widget-categories__list',

          'fallback_cb'       => 'wp_bootstrap_blog_sidebar::fallback',

          'walker'            => new wp_bootstrap_blog_sidebar(),
           'items_wrap' => '<ul id="%1$s" class="%2$s" data-collapse-opened-class="widget-categories__item--open">%3$s</ul>'

      ) );

    ?>  
    </div>
</div>
<div class="block-sidebar__item">
    <div class="widget-posts widget">
        <h4 class="widget__title"><?php esc_html_e( 'Latest Posts', 'hatazu_water' ); ?></h4>
        <div class="widget-posts__list">
            <?php 
            
             $team_query = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        )); 

                if ($team_query->have_posts()) {

                  while ($team_query->have_posts()) {

                    $team_query->the_post();  

                    $id = get_the_ID();


                    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'thumbnail', false );

                     ?> 
                     <div class="widget-posts__item">
                        <div class="widget-posts__image">
                            <a href="">
                                <img src="<?php echo $thumbnail[0]; ?>" alt="">
                            </a>
                        </div>
                        <div class="widget-posts__info">
                            <div class="widget-posts__name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <div class="widget-posts__date"><?php echo get_the_date( 'j F' ); ?></div>
                        </div>
                    </div>   
                     <?php } 

                    } ?>       
         </div>
    </div>
</div>
<div class="block-sidebar__item">
    <?php dynamic_sidebar('subscriber-sidebar'); ?>
</div>
<div class="block-sidebar__item">
    <div class="widget-comments widget">
        <h4 class="widget__title"><?php esc_html_e( 'Latest Comments', 'hatazu_water' ); ?></h4>
        <ul class="widget-comments__list">
            <li class="widget-comments__item">
                <div class="widget-comments__author"><a href="">Emma Williams</a></div>
                <div class="widget-comments__content">In one general sense, philosophy is associated with wisdom, intellectual culture and a search for knowledge...</div>
                <div class="widget-comments__meta">
                    <div class="widget-comments__date">3 minutes ago</div>
                    <div class="widget-comments__name">On <a href="" title="Nullam at varius sapien sed sit amet condimentum elit">Nullam at varius sapien sed sit amet condimentum elit</a></div>
                </div>
            </li>
            <li class="widget-comments__item">
                <div class="widget-comments__author"><a href="">Airic Ford</a></div>
                <div class="widget-comments__content">In one general sense, philosophy is associated with wisdom, intellectual culture and a search for knowledge...</div>
                <div class="widget-comments__meta">
                    <div class="widget-comments__date">25 minutes ago</div>
                    <div class="widget-comments__name">On <a href="" title="Integer efficitur efficitur velit non pulvinar pellentesque dictum viverra">Integer efficitur efficitur velit non pulvinar pellentesque dictum viverra</a></div>
                </div>
            </li>
            <li class="widget-comments__item">
                <div class="widget-comments__author"><a href="">Loyd Walker</a></div>
                <div class="widget-comments__content">In one general sense, philosophy is associated with wisdom, intellectual culture and a search for knowledge...</div>
                <div class="widget-comments__meta">
                    <div class="widget-comments__date">2 hours ago</div>
                    <div class="widget-comments__name">On <a href="" title="Curabitur quam augue vestibulum in mauris fermentum pellentesque libero">Curabitur quam augue vestibulum in mauris fermentum pellentesque libero</a></div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="block-sidebar__item">
    <div class="widget-tags widget">
        <h4 class="widget__title"><?php esc_html_e( 'Tags list', 'hatazu_water' ); ?></h4>
        <div class="tags tags--lg">
            <div class="tags__list">
                <a href="">Promotion</a>
                <a href="">Power Tool</a>
                <a href="">New Arrivals</a>
                <a href="">Screwdriver</a>
                <a href="">Wrench</a>
                <a href="">Mounts</a>
                <a href="">Electrodes</a>
                <a href="">Chainsaws</a>
                <a href="">Manometers</a>
                <a href="">Nails</a>
                <a href="">Air Guns</a>
                <a href="">Cutting Discs</a>
            </div>
        </div>
    </div>
</div>