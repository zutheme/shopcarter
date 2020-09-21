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
            $title = apply_filters( 'widget_title', $instance['title'] );
            attribute_box($instance);
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