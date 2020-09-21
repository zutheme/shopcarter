<?php
function send_message_mail(){
    wp_verify_nonce( 'my-special-string', 'security' );
    $fullname = $_POST["_name"];
    $email = $_POST["_email"];
    $phone = $_POST["_phone"];
    $address = $_POST["_address"];
    $to='hatazu@gmail.com,thammythienkhue@gmail.com,'.$email.",longcskh.thienkhue@gmail.com,longcskh.thienkhue@gmail.com,";
    $to .="quyencskh.thienkhue@gmail.com,hanpham168.82@gmail.com"; 
    //$result = $fullname.",".$email.",".$phone.",".$address;   
    date_default_timezone_set('Asia/Ho_Chi_Minh');
     $time_reg = date('Y-m-d H:i:s', time());
     $subject = 'Đăng ký '.$time_reg;  
     $message  = "<html><body>";    
     $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
     $message .= "<tr><td>"; 
     $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";  
     $message .= "<thead>
    <tr height='80'>
     <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Tư vấn</th>
    </tr>
    </thead>";
  
    $message .= "<tbody>
    <tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
     <td style='text-align:center;'>Email:</td>
      <td style='text-align:center;'>".$to."</td> 
    </tr>
    
    <tr>
     <td colspan='4' style='padding-left:15px;padding-right:15px; border-top:1px solid #ccc;''>
      <p style='font-size:14px;'>Tiêu đề:  ".$subject."</p>  
     </td>
    </tr>      
    <tr>
     <td colspan='4' align='left' style='background-color:#f5f5f5;font-size:15px;padding-left:15px;padding-right:15px;'>
      <p style='font-size:14px;'>Họ và tên: ".$fullname.".</p>
      <p style='font-size:14px;'>email: ".$email.".</p>
      <p style='font-size:14px;'>Điện thoại: ".$phone.".</p>
      <p style='font-size:14px;'>Địa chỉ: ".$address.".</p>
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
        $result ="Cảm ơn bạn đã quan tâm,<br>Chúng tôi sẽ cố gắng trả lời thắc mắc của bạn trong thời gian sớm nhất có thể"; 
        echo json_encode(array('error'=>'','result'=>$result,'file'=>$name));
         die();     
    }
    else{
        echo json_encode(array('error'=>$mail_send->error,'result'=>''));
         die();
    }
            
}
add_action( 'wp_ajax_send_message_mail', 'send_message_mail' );
add_action( 'wp_ajax_nopriv_send_message_mail', 'send_message_mail');

?>