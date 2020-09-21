<?php 
if(!function_exists('send_comment')):
	function send_comment(){
			 //check_ajax_referer( 'my-special-string', 'security' );
			 wp_verify_nonce( 'my-special-string','security');
			 $comment_post_ID = htmlspecialchars(stripslashes(trim($_POST['comment_post_ID'])));
			 $comment_parent = htmlspecialchars(stripslashes(trim($_POST['comment_parent'])));
			 $text_comment = htmlspecialchars(stripslashes(trim($_POST['comment_body'])));
             $phone = htmlspecialchars(stripslashes(trim($_POST['phone'])));
             $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
             $fullname = htmlspecialchars(stripslashes(trim($_POST['fullname'])));
             $rate = htmlspecialchars(stripslashes(trim($_POST['max'])));
			 date_default_timezone_set('Asia/Ho_Chi_Minh');
			 $time = current_time('mysql');
			 $data = array(
			    'comment_post_ID' => $comment_post_ID,
			    'comment_author' => $fullname,
			    'comment_author_email' => $email,
			    'comment_author_url' => '',
			    'comment_content' => $text_comment,
			    'comment_type' => '',
			    'comment_parent' => $comment_parent,
			    'user_id' => 0,
			    'comment_author_IP' => getUserIP(),
			    'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
			    'comment_date' => $time,
			    'comment_approved' => 0,
			);
			$comment_id = wp_insert_comment($data);
            $phone = wp_filter_nohtml_kses($phone);
            add_comment_meta( $comment_id, 'phone', $phone );
            $rate = wp_filter_nohtml_kses($rate);
            add_comment_meta( $comment_id, 'rating', $rate );
            echo json_encode(array('comment_id'=>$comment_id));
            wp_die();
	}
endif;
add_action( 'wp_ajax_send_comment', 'send_comment' );
add_action( 'wp_ajax_nopriv_send_comment', 'send_comment' );

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP)){
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }
    else{
        $ip = $remote;
    }

    return $ip;
}
