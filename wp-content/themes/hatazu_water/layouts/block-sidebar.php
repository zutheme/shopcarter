<div class="block block-sidebar block-sidebar--offcanvas--mobile">
    <div class="block-sidebar__backdrop"></div>
    <div class="block-sidebar__body">
        <div class="block-sidebar__header">
            <div class="block-sidebar__title">Bộ lọc</div>
            <button class="block-sidebar__close" type="button">
                <svg width="20px" height="20px">
                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#cross-20"></use>
                </svg>
            </button>
        </div>
        <div class="block-sidebar__item">
            <div class="widget-filters widget widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened">
                <h4 class="widget-filters__title widget__title">Bộ lọc</h4>
                <div class="widget-filters__list">
                    <div class="widget-filters__item">
                        <div class="filter filter--opened" data-collapse-item>
                            <button type="button" class="filter__title" data-collapse-trigger>
                                Danh mục
                                <svg class="filter__arrow" width="12px" height="7px">
                                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-12x7"></use>
                                </svg>
                            </button>
                            <div class="filter__body" data-collapse-content>
                                <div class="filter__container">
                                    <div class="filter-categories-alt">
                                        <?php
                                         wp_nav_menu( array(

                                              'theme_location'    => 'menu-1',

                                              'menu'              => "menu-1",

                                              'depth'             => 4,

                                              'container'         => '',

                                              'container_class'   => '',

                                              'container_id'      => '',

                                              'menu_id'           => 'nav_sidebar',

                                              'menu_class'        => 'filter-categories-alt__list filter-categories-alt__list--level--1',

                                              'fallback_cb'       => 'wp_bootstrap_navwalker_sidebar::fallback',

                                              'walker'            => new wp_bootstrap_navwalker_sidebar(),
                                               'items_wrap' => '<ul id="%1$s" class="%2$s" data-collapse-opened-class="filter-categories-alt__item--open">%3$s</ul>'

                                          ) );

                                        ?>  
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 
                   <?php dynamic_sidebar( 'sidebar-archive-product' ); 
                   //echo do_shortcode( '[woo_products_by_attributes attribute="color" values="white"]' );
                   ?>
                </div>
                
                <div class="widget-filters__actions d-flex">
                    <button class="btn btn-primary btn-sm btn-filter">Filter</button>
                    <button class="btn btn-secondary btn-sm">Reset</button>
                </div>
            </div>
        </div>
        <div class="block-sidebar__item d-none d-lg-block">
            <div class="widget-products widget">
                <h4 class="widget__title">Latest Products</h4>
                <div class="widget-products__list">
                    <?php 
                            $args = array( 'post_type' => 'product', 
                                'posts_per_page' => 3, 
                                //'product_cat' => 'shoes', 
                                'orderby' => 'rand' );
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post(); global $post, $product; ?>
                          <!-- item -->
                          <div class="widget-products__item">
                                <div class="widget-products__image">
                                    <div class="product-image">
                                        <a href="product.html" class="product-image__body">
                                            <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'thumbnail', array( 'class' => 'product-image__img' )); else echo '<img class="product-image__img" src="'.woocommerce_placeholder_img_src().'" alt="" />'; ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="widget-products__info">
                                    <div class="widget-products__name">
                                        <a href="product.html"><?php the_title(); ?></a>
                                    </div>
                                    <div class="widget-products__prices">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--end item-->
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                                      
                   
                </div>
            </div>
        </div>
    </div>
</div>