<?php 
function add_subscriber(){
    wp_verify_nonce('media-form', 'security');
    $_email = htmlspecialchars(stripslashes(trim($_POST['email'])));
     
   	$subscriber = new subscriber();
    $subscriber->Email($_email);
    $subscriber->add_subscriber();
    $error = $subscriber->_Error();
    if($error){
        echo json_encode(array('error'=>$error));
        wp_die();
    }
    $idsubscriber = $subscriber->_Id_subscriber();
    echo json_encode(array('idsubscriber'=>$idsubscriber,'error'=>''));
    wp_die();
}
add_action('wp_ajax_add_subscriber', 'add_subscriber');
add_action('wp_ajax_nopriv_add_subscriber', 'add_subscriber');
?>