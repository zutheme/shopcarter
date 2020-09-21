<?php
/* Register and load the widget */
function htz_subscriber_fixed() {
    register_widget( 'htz_subscribers' );
}
add_action( 'widgets_init', 'htz_subscriber_fixed' );
// Creating the widget 
class htz_subscribers extends WP_Widget  {
 
function __construct() {
    parent::__construct(  
        // Base ID of your widget
        'htz_subscribers',       
        // hatazu subscriber  will appear in UI
        __('subscriber htz', 'htz_subscriber_domain'),         
        // Widget description
        array( 'description' => __( 'subscriber htz', 'htz_subscriber_domain' ), ) 
        );
    }
 
    // Creating widget front-end
     
    public function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', $instance['title'] );
            $desc_subscriber = $instance[ 'desc_subscriber'];
            //before and after widget arguments are defined by themes
            //echo $args['before_widget'];
            //if ( ! empty( $title ) )
            //echo $args['before_title'] . $title . $args['after_title'];
            //echo __( 'Hello, World!', 'htz_subscriber_domain' );
           ?>
           <div class="widget-newsletter widget">
                <h4 class="widget-newsletter__title"><?php echo $title; ?></h4>
                <div class="widget-newsletter__text"><?php echo $desc_subscriber; ?></div>
                <form class="widget-newsletter__form" action="">
                    <label for="widget-newsletter-email" class="sr-only">Email Address</label>
                    <input class="email form-control" type="email" placeholder="Email Address">
                    <button type="button" class="btn btn-primary mt-3 btn-subscriber">Subscribe</button>
                    <div class="load-result"><img class="loading" style="display: none;margin-right: auto;margin-left: auto;max-width: 100px;margin-top: 5px;" src="<?php echo plugin_dir_url(__FILE__); ?>/images/loader.gif"><p class="message"></p></div>
                </form>
            </div>
            <?php 
            echo $args['after_widget'];
        }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'htz_subscriber_domain' );
        }
        if ( isset( $instance[ 'desc_subscriber' ] ) ) {
            $desc_subscriber = $instance[ 'desc_subscriber'];
        }else {
            $desc_subscriber = __( 'description', 'htz_subscriber_domain' );
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         <p>
        <label for="<?php echo $this->get_field_id( 'desc_subscriber' ); ?>"><?php _e( 'description: ' ); ?></label> 
        <textarea col='2' row='10' class="widefat" id="<?php echo $this->get_field_id( 'desc_subscriber' ); ?>" name="<?php echo $this->get_field_name( 'desc_subscriber' ); ?>"><?php echo esc_attr( $desc_subscriber ); ?></textarea>
        </p>
    <?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
         $instance['desc_subscriber'] = ( ! empty( $new_instance['desc_subscriber'] ) ) ? strip_tags( $new_instance['desc_subscriber'] ) : '';
        return $instance;
    }
} ?>
