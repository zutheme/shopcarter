<?php
class subscriber{
	private $id_subscriber;
	private $firstname;
	private $lastname;
	private $email;
	private $num_phone;
	private $addpress;
	private $time_reg;
	private $error='';
	private $test = '';
	public function __construct(){
		$this->id_subscriber = 0;
		$this->firstname = '';
		$this->lastname = '';
		$this->email = '';
		$this->num_phone = '';
	}
	public function __destruct(){
		//echo 'the"',__class__,'"destruct';
	}
	
	public function Id_subscriber($idsubscriber){
		$this->id_subscriber = $idsubscriber;
	}
	public function _Id_subscriber(){
		return $this->id_subscriber;
	}
	public function Firstname($firstname){
		$this->firstname = $firstname;
	}
	public function _Firstname(){
		return $this->firstname;
	}
	public function Lastname($lastname){
		$this->lastname = $lastname;
	}
	public function _Lastname(){
		return $this->lastname;
	}
	public function Email($email){
		$this->email = $email;
	}
	public function _Email(){
		return $this->email;
	}
	public function Num_phone($num_phone){
		$this->num_phone = $num_phone;
	}
	public function _Num_phone(){
		return $this->num_phone;
	}
	public function Address($address){
		$this->address = $address;
	}
	public function _Address(){
		return $this->address;
	}
	public function Time_reg($time_reg){
		$this->time_reg = $$time_reg;
	}
	public function _Time_reg(){
		return $this->time_reg;
	}
	public function Error($error){
		$this->error = $error;
	}
	public function _Error(){
		return $this->error;
	}
	public function _Test(){
		return $this->test;
	}
	public function exist_subscriber_by_email(){
		global $wpdb;
		$this->Id_subscriber(0);
		$tb_subscriber = $wpdb->prefix . 'subscribers';
		$sql = "SELECT id_subscriber FROM $tb_subscriber WHERE email='{$this->email}' LIMIT 1";	
		$results = array();
		$results = $wpdb->get_results($sql,object);
		foreach ( $results as $item ) {
			$this->id_subscriber = $item->id_subscriber;
		}
        //show error
        if($wpdb->last_error !== ''){
	        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
	        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
	        $error ="WordPress database error:[$str]<code>$query</code>";        
    	}
    	$this->error = $error;
    	$wpdb->flush();
	}
	public function exist_subscriber_by_phone(){
		global $wpdb;
		$tb_subscriber = $wpdb->prefix . 'subscribers';
		$sql = "SELECT id_subscriber FROM $tb_subscriber WHERE num_phone='{$this->num_phone}' LIMIT 1";	
		$results = array();
		$results = $wpdb->get_results($sql,object);
		foreach ( $results as $item ) {
			$this->id_subscriber = $item->id;
		}
        //show error
        if($wpdb->last_error !== ''){
	        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
	        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
	        $error ="WordPress database error:[$str]<code>$query</code>";        
    	}
    	$this->error = $error;
    	$wpdb->flush();
	}
	
	public function exist_idsubscriber_email_or_phone(){
		$this->exist_subscriber_by_phone();
		if(empty($this->id_subscriber)){
			$this->exist_subscriber_by_email();
		}
	}
	public function insert_subscriber(){
		global $wpdb;
		$tb_subscriber = $wpdb->prefix . 'subscribers';
       	$wpdb->insert( 
           $tb_subscriber, 
           array(
           	 'email' => $this->email, 
           	 'firstname' => $this->firstname,
           	 'lastname' => $this->lastname
             //'num_phone' => $this->num_phone
             ) 
         );
        $this->id_subscriber = $wpdb->insert_id;	
        //show error
        if($wpdb->last_error !== ''){
	        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
	        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
	        $error ="WordPress database error:[$str]<code>$query</code>";        
    	}
    	$this->error = $error;
    	$wpdb->flush();
	}
	public function add_subscriber(){
		$this->exist_subscriber_by_email();
		if($this->id_subscriber == 0){
			$this->insert_subscriber();
		}else if($this->id_subscriber > 0){
			$this->error = 'Existing';
		}
	}
	public function update(){
		global $wpdb;
		$tb_subscriber = $wpdb->prefix . 'subscribers';   
        $sql = "UPDATE $tb_subscriber ";
        $sql .= "SET firstname='{$this->firstname}',lastname='{$this->lastname}',";
        $sql .= "email='{$this->email}',address='{$this->address}'";
        $sql .=" WHERE id_subscriber='{$this->id_subscriber}'";
        $wpdb->query($sql);
        /*show error*/
        if($wpdb->last_error !== ''){
	        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
	        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
	        $error ="WordPress database error:[$str]<code>$query</code>";        
    	}
    	$this->error = $error;
    	$wpdb->flush();
	}
	public function delete(){
		global $wpdb;
		$tb_subscriber = $wpdb->prefix . 'subscribers';   
        $sql = "DELETE FROM $tb_subscriber WHERE id_subscriber='{$this->id_subscriber}'";
        $wpdb->query($sql);
        
        if($wpdb->last_error !== ''){
	        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
	        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
	        $error ="WordPress database error:[$str]<code>$query</code>";        
    	}
    	$this->test=$sql;
    	$this->error = $error;
    	$wpdb->flush();
	}
	public function SynData(){
		global $wpdb;
		$tb_subscriber = $wpdb->prefix . 'subscribers'; 
		$tb_wp_wc_customer_lookup = $wpdb->prefix . 'wc_customer_lookup';
        $sql = "INSERT INTO $tb_subscriber(email,firstname,lastname) SELECT email,first_name,last_name FROM $tb_wp_wc_customer_lookup WHERE email not in (SELECT email FROM $tb_subscriber)";
        $wpdb->query($sql);
        if($wpdb->last_error !== ''){
	        $str   = htmlspecialchars( $wpdb->last_result, ENT_QUOTES );
	        $query = htmlspecialchars( $wpdb->last_query, ENT_QUOTES );
	        $error ="WordPress database error:[$str]<code>$query</code>";        
    	}
    	$this->test=$sql;
    	$this->error = $error;
    	$wpdb->flush();
	}
}
?>