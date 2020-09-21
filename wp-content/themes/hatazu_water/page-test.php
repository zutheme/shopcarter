<?php
/**
 *  Template Name: Test
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eleaning
 */
get_header();
	$api_key = esc_attr(get_option('keyapi_mailchimp'));
    $list_id = esc_attr(get_option('idlist_mailchimp'));
    echo $api_key.','.$list_id;
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
    print_r($emails);
get_footer(); 