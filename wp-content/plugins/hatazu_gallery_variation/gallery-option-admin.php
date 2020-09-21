<div class="wrap">

	<h2>Setting gallery</h2>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=gallery-menu-settings">

	    <?php //settings_fields( 'box-link-settings-group' ); ?>

	    <?php //do_settings_sections( 'box-link-settings-group' ); ?>


	    <table class="form-table">
	    	<tr><td>
	    	<?php $_sync = $_POST['sync_gallery'];
	    	 ?>	
	    	</td></tr>
	        <tr valign="top">
	        <th scope="row">* synchronize url gallery *</th>
	        <td><input type="hidden" name="sync_gallery" value="1" /></td>
	        <td><input type="submit" name="sync-gallery" value="sync gallery" /></td>

	        </tr>
	    </table>

	    <?php //submit_button(); ?>

	</form>

	</div>
<?php 
	if(isset($_POST['sync-gallery']) && intval($_sync) > 0 ){
		$rep = get_home_url().'/wp-content';
		$pat = 'http(.*?)\/wp-content';
		global $wpdb;
		$wpdb->query( $wpdb->prepare(
		    "UPDATE wp_postmeta SET meta_value = REGEXP_REPLACE(meta_value, %s, %s) WHERE meta_key='gallery'",
		    array(
		        $pat,
		        $rep
		    )
		));
		if(!$wpdb->show_errors()){
			echo '<h4>Synchronizing Success</h4>';
		}
	}
?>