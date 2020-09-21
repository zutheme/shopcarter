<?php 
function get_the_user_ip_contact() {
if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
	//check ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	//to check ip is pass from proxy
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return apply_filters( 'wpb_get_ip', $ip );
}

/*login*/

//send mail

if(!function_exists('send_contact')):
	function send_contact(){
	 wp_verify_nonce( 'my-special-string', 'security' );
	 $to="vhllogistic2019@gmail.com,hatazu@gmail.com";
	 $input = json_decode(file_get_contents('php://input'),true);
     $name = $input['name'];
     $email = $input['email'];
	 $phone = $input['phone'];
     $address = $input['address'];
     $txtmessage = $input['message'];
	  date_default_timezone_set('Asia/Ho_Chi_Minh');
     $time_reg = date('Y-m-d H:i:s', time());
     $subject = 'Đăng ký '.$time_reg;  
     $message  = "<html><body>";    
     $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
     $message .= "<tr><td>"; 
     $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";  
     $message .= "<thead>
    <tr height='20'>
     <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:16px;' >Thông tin liên hệ</th>
    </tr>
    </thead>";
  
    $message .= "<tbody>    
    <tr>
     <td colspan='4' align='left' style='padding:5px'>
      <p style='font-size:14px;'>Họ và tên: ".$name.".</p>
      <p style='font-size:14px;'>email: ".$email.".</p>
      <p style='font-size:14px;'>Điện thoại: ".$phone.".</p>
      <p style='font-size:14px;'>Địa chỉ: ".$address.".</p>
     </td>
    </tr>
     <tr>
     <tr height='20'>
     <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:16px;' >Nội dung tư vấn</th>
    </tr>
    </thead>
     <td colspan='4' align='left' style='padding:5px'>
     	".$txtmessage."
     </td>
     </tr>     
    </tbody>"; 
    //end body           
     $message .= "</table>"; 
     $message .= "</td></tr>";
     $message .= "</table>";           
     $message .= "</body></html>";

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";      
    // Create email headers
    $headers .= 'From: '.$to."\r\n".
        'Reply-To: '.$to."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    $mail_send = wp_mail($to, $subject, $message, $headers);
   if($mail_send){
        $result = "Cảm ơn bạn đã gửi thông tin liện hệ,<br> chúng tôi sẽ phản hồi sớm nhất có thể";
	    echo json_encode(array('success' => true, 'result' => $result));
	        die();     
	     } else{
			echo json_encode(array('error' => true, 'error' => $mail_send->error));
			die();
	        }
}

endif;

add_action( 'wp_ajax_send_contact', 'send_contact' );

add_action( 'wp_ajax_nopriv_send_contact', 'send_contact' );