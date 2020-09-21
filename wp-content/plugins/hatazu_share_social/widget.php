<?php
// Register and load the widget
function htz_share_social_fixed() {
    register_widget( 'htz_share_socials' );
}
add_action( 'widgets_init', 'htz_share_social_fixed' );
// Creating the widget 
class htz_share_socials extends WP_Widget  {
 
function __construct() {
    parent::__construct(  
        // Base ID of your widget
        'htz_share_socials',       
        // hatazu share_social  will appear in UI
        __('share_social htz', 'htz_share_social_domain'),         
        // Widget description
        array( 'description' => __( 'share_social htz', 'htz_share_social_domain' ), ) 
        );
    }
 
    // Creating widget front-end
     
    public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
             
            // before and after widget arguments are defined by themes
            //echo $args['before_widget'];
            //if ( ! empty( $title ) )
            //echo $args['before_title'] . $title . $args['after_title'];
             
            // This is where you run the code and display the output
            //echo __( 'Hello, World!', 'htz_share_social_domain' );
            share_social_box($title);
            //echo $args['after_widget'];
        }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'htz_share_social_domain' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} ?>
