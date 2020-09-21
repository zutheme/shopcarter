<section id="itemPageWraps" class="item-PageWrap">

    <div class="container">
        <div class="desc-service">
            <h3 class="title2">Dịch vụ nổi bật</h3>
            <p><?php echo esc_attr( get_option('option-desc-1') ); ?></p>
        </div>
        <ul>
                <?php $team_query = new WP_Query( array(

                    'post_type' => 'services',

                    'posts_per_page' => 4,

                    //'orderby'   => 'meta_value',

                    'order' => 'asc',

                    'tax_query' => array(

                        array (

                            'taxonomy' => 'group',

                            'field' => 'slug',

                            'terms' => 'dich-vu',

                        )

                    ),

                )); 

            if ($team_query->have_posts()) {

              while ($team_query->have_posts()) {

                $team_query->the_post();  

                $id = get_the_ID();

                $link = get_post_meta( $id, 'link', true );

                $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full', false );

                 ?> 
                    <li>

                    <div>

                        <h3><?php the_title(); ?></h3>
                        <p><?php echo get_the_excerpt_max(200); ?></p>
                        <img src="<?php echo $thumbnail[0]; ?>"/> 
                        <a target="_blank" class="btn-2 arrow default" href="<?php echo $link; ?>">Tìm hiểu</a>
                    </div>

                </li>
        
                 <?php } 

                } ?>
                

        </ul>

    </div>

</section>