<?php  
/*Register and load the widget */
function htz_attribute_fixed() {
    register_widget( 'htz_attributes' );
}
add_action( 'widgets_init', 'htz_attribute_fixed' ); 
class htz_attributes extends WP_Widget  { 
    function __construct() { 
        parent::__construct(  
        // Base ID of your widget
        'htz_attributes', 
        __('attribute htz', 'htz_attribute_domain'),         
        // Widget description
        array( 'description' => __( 'attribute htz', 'htz_attribute_domain' ) ) 
        );
    } 
    // Creating widget front-end
    public function widget( $args, $instance ) {
            //$title = apply_filters( 'widget_title', $instance['title'] );
            //attribute_box($instance);
            $title = apply_filters( 'widget_title', $instance['title'] );
            $attribute_option = $instance[ 'attribute_name'];
            $template_option = $instance[ 'template_option'];
            $count_option = $instance[ 'count_option'];
            if($template_option == 0){ ?>
             <div class="widget-filters__item">
                <div class="filter filter--opened" data-collapse-item>
                    <button type="button" class="filter__title" data-collapse-trigger>
                        <?php echo $title; ?>
                        <svg class="filter__arrow" width="12px" height="7px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-12x7"></use>
                        </svg>
                    </button>
                    <div class="filter__body" data-collapse-content>
                        <?php //echo $attribute_name; ?>
                        <div class="filter__container">
                            <div class="filter-color">
                                <div class="filter-color__list">    
                                 <?php
                                //$attributes = wc_get_attribute_taxonomies();
                                //var_dump($attributes); 
                                     $terms = get_terms( array( 
                                        'taxonomy' => $attribute_option,
                                        'hide_empty' => 0,
                                        'parent'   => 0,
                                        ) ); ?>
                                    <?php 
                                    foreach ($terms as $key => $item) { 
                                        $color = get_term_meta($item->term_id, 'custom_field_taxonomy', true);
                                        ?>
                                    <label class="filter-color__item">
                                        <span class="filter-color__check input-check-color  input-check-color--white  " style="color: <?php echo $color; ?>">
                                            <label class="input-check-color__body">
                                                <input class="input-check-color__input <?php echo $attribute_option; ?>" type="checkbox" value="<?php echo $item->term_id; ?>" attribute="<?php echo $attribute_option; ?>">
                                                <span class="input-check-color__box"></span>
                                                <svg class="input-check-color__icon" width="12px" height="9px">
                                                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#check-12x9"></use>
                                                </svg>
                                                <span class="input-check-color__stick"></span>
                                            </label>
                                        </span>
                                    </label>
                                     <?php } ?>              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }elseif ($template_option == 1) { ?>
            <div class="widget-filters__item">
                <div class="filter filter--opened" data-collapse-item>
                    <button type="button" class="filter__title" data-collapse-trigger>
                        <?php echo $title; ?>
                        <svg class="filter__arrow" width="12px" height="7px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-12x7"></use>
                        </svg>
                    </button>
                    <div class="filter__body" data-collapse-content>
                        <div class="filter__container">
                            <div class="filter-list">
                                <div class="filter-list__list">
                                    <?php 
                                        $terms = get_terms( array( 
                                            'taxonomy' => $attribute_option,
                                            'hide_empty' => 0,
                                            'parent'   => 0,
                                        ) );
                                        foreach ($terms as $key => $item) { ?>
                                            <label class="filter-list__item ">
                                                <span class="filter-list__input input-check">
                                                    <span class="input-check__body">
                                                        <input class="input-check__input <?php echo $attribute_option; ?>" type="checkbox" value="<?php echo $item->term_id; ?>" attribute="<?php echo $attribute_option; ?>">
                                                        <span class="input-check__box"></span>
                                                        <svg class="input-check__icon" width="9px" height="7px">
                                                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#check-9x7"></use>
                                                        </svg>
                                                    </span>
                                                </span>
                                                <span class="filter-list__title">
                                                    <?php echo $item->name?>
                                                </span>
                                                <span class="filter-list__counter"><?php if($count_option ) { echo $item->count; } ?></span>
                                            </label>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <?php   
            } 
        }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'htz_attribute_domain' );
        }
        if ( isset( $instance[ 'attribute_name' ] ) ) {
            $attribute_name = $instance[ 'attribute_name'];
        }else {
            $attribute_name = '';
        }
        if ( isset( $instance[ 'template_option' ] ) ) {
            $template_option = $instance[ 'template_option'];
        }else {
            $template_option = 0;
        }
        if ( isset( $instance[ 'count_option' ] ) ) {
            $count_option = $instance[ 'count_option'];
        }else {
            $count_option = 1;
        }
        
        echo '<p>';
        echo '<label for="'.$this->get_field_id( 'title' ),'">'._e( 'Title:' ).'</label> 
        <input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'. esc_attr( $title ).'" />
        </p>';
        echo '<p>';
        echo '<select id="'.$this->get_field_id( 'attribute_name' ).'" name="'.$this->get_field_name( 'attribute_name' ).'">';
             $attributes = wc_get_attribute_taxonomies(); 
            foreach ($attributes as $key => $attribute) {
            $selected = '';
            if($attribute_name == 'pa_'.$attribute->attribute_name){
                $selected = 'selected';
            } 
            echo '<option '.$selected.' value="'.'pa_'.$attribute->attribute_name.'" >'.$attribute->attribute_name.'</option>';
            } 
        echo '</select>';
        echo '</p>';
        echo '<p>';
        echo '<select id="'.$this->get_field_id( 'template_option' ).'" name="'.$this->get_field_name( 'template_option' ).'">';
        $tmp_select1 = '';
        $tmp_select2 = '';
        if($template_option == 0){
            $tmp_select1 = 'selected';
        }
        if($template_option == 1){
            $tmp_select2 = 'selected';
        }
        echo  '<option '.$tmp_select1.' value="0">template color</option>';
        echo  '<option '.$tmp_select2.' value="1">template size</option>';
        echo '</select>';
        echo '</p>';
        echo '<p>';
        $select_count1 = '';
        $select_count2 = '';
        if($count_option > 0){
            $select_count1 = 'selected';
        }
        if($count_option < 0){
            $select_count2 = 'selected';
        }
        echo '<label for="'.$this->get_field_id( 'count_option' ).'">'._e( 'Show count:' ).'</label>'; 
        echo '<input class="widefat" name="'.$this->get_field_name( 'count_option' ).' type="radio" value="1" '.$select_count1.'/>';
        echo '<label for="'.$this->get_field_id( 'count_option' ).'">'._e( 'Hide count:' ).'</label>'; 
        echo '<input class="widefat" name="'.$this->get_field_name( 'count_option' ).'" type="radio" value="0" '.$select_count2.'/>';
        echo '</p>';
    } 
    /*Updating widget replacing old instances with new */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['attribute_name'] = ( ! empty( $new_instance['attribute_name'] ) ) ? strip_tags( $new_instance['attribute_name'] ) : '';
         $instance['template_option'] = ( ! empty( $new_instance['template_option'] ) ) ? strip_tags( $new_instance['template_option'] ) : 0;
          $instance['count_option'] = ( ! empty( $new_instance['count_option'] ) ) ? strip_tags( $new_instance['count_option'] ) : 0;
        return $instance;
    } 
   
} ?>