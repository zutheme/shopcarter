<?php 
function addcontactmailchimp(){
    //check_ajax_referer('ajax_file_nonce', 'security');
    //wp_verify_nonce( 'ajax_file_nonce', 'security');
    wp_verify_nonce('media-form', 'security');
    $_email = htmlspecialchars(stripslashes(trim($_POST['email'])));
   	$data = [
    'email'     => $_email,
    'status'    => 'subscribed',
    'firstname' => '',
    'lastname'  => ''
	];
    $result = syncMailchimp($data);
    //$result = getlistemailmailchimp();
    echo $result;
    wp_die();
}
add_action('wp_ajax_addcontactmailchimp', 'addcontactmailchimp');
add_action('wp_ajax_nopriv_addcontactmailchimp', 'addcontactmailchimp');
function syncMailchimp($data) {
    $apiKey = esc_attr( get_option('keyapi_mailchimp') );
    $listId = esc_attr( get_option('idlist_mailchimp') );

    $memberId = md5(strtolower($data['email']));
    $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;
    $json = json_encode([
        'email_address' => $data['email'],
        'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
        'merge_fields'  => [
            'FNAME'     => $data['firstname'],
            'LNAME'     => $data['lastname']
        ]
    ]);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return $httpCode;
}
function getlistemailmailchimp(){
    $api_key = esc_attr(get_option('keyapi_mailchimp'));
    $list_id = esc_attr(get_option('idlist_mailchimp'));

    $dc = substr($api_key,strpos($api_key,'-')+1); // us5, us8 etc
    $args = array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
        )
    );
     
    // connect
    $response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id, $args );
     
    // decode the response
    $body = json_decode( $response['body'] );
    $emails = array();
    if ( $response['response']['code'] == 200 ) :
     
        // subscribers count
        $member_count = $body->stats->member_count;
        $emails = array();
     
        for( $offset = 0; $offset < $member_count; $offset += 50 ) :
     
            $response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members?offset=' . $offset . '&count=50', $args );
            // decode the result
            $body = json_decode( $response['body'] );
     
            if ( $response['response']['code'] == 200 ) {
                foreach ( $body->members as $member ) {
                    $emails[] = $member->email_address;
                }
            }
     
        endfor;
     
    endif;
    // print all emails
   return $emails;
}
?>