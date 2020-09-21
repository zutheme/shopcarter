<?php
//add_action('admin_enqueue_scripts', 'admin_load_scripts_share');
function hatazu_share_custom() {
    global $post;
    if( is_single() || is_page() && !is_page_template(array('page-template.php'))) {
        //wp_enqueue_style( 'hatazu_share_style', plugin_dir_url(__FILE__) . 'css/hatazu_share_style.css',array(), '1.3.4', true);
        wp_enqueue_script( 'jssocial.js', plugin_dir_url(__FILE__) .'js/jssocial.js', array(), '1.3.8', false );
    }
}
add_action('wp_enqueue_scripts', 'hatazu_share_custom'); 
// function box_social( $content ) {    
//     if( is_single() || is_page() ) {
//       // Get current page URL 
//           //$url = urlencode(get_permalink());
//           //$url = get_permalink();
//           // Get current page title
//           $link = get_the_permalink();
//           $link = str_replace(':', '%3A', $link);
//           $link = str_replace('/', '%2F', $link);
//           $socialTitle = str_replace( ' ', '%20', get_the_title());
//           // Get Post Thumbnail for pinterest
//           //$socialThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $id_post ), 'medium' );
//           // Construct sharing URL without using any script
//           $scriptsocial ="";
//           $scriptsocial .="<div class=\"dzalo\"> <div class=\"fb-like\" data-href=\"".$link."\" data-layout=\"button_count\" data-action=\"like\" data-size=\"small\" data-show-faces=\"false\" data-share=\"true\"></div>";
//           $scriptsocial .="<div class=\"zalo-share-button\" data-href=\"".$link."\" data-oaid=\"579745863508352884\" data-layout=\"1\" data-color=\"blue\" data-customize=false></div></div>";
//           return $content.$scriptsocial;
//       }
//       return $content;
//   }
//add_filter( 'the_content', 'box_social', 20 );
function script_dev(){ 
    if(is_single() || is_page() && !is_front_page()) { ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <?php }  
 } 
add_action( 'wp_footer', 'script_dev'); ?>