<div class="wrap">

	<h2>Setting subscriber option</h2>

	<form method="post" action="options.php">

	    <?php settings_fields( 'subscriber-settings' ); ?>

	    <?php do_settings_sections( 'subscriber-settings' ); ?>

	    <?php 
			if ( isset( $_POST['keyapi_mailchimp'] ) ) {
		    $subscriber = (string) $_POST['keyapi_mailchimp'];
		    // apply more sanitizations here if needed

		} ?>

	    <table class="form-table">

	    	<tr><td>--Add contact to mailchimp---</td></tr>

	        <tr valign="top">

	        <th scope="row">API key mailchimp</th>

	        <td><input class="opt form-control" type="text" name="keyapi_mailchimp" value="<?php echo esc_attr( get_option('keyapi_mailchimp') ); ?>" /></td>

	        </tr>
	      	<tr valign="top">

	        <th scope="row">ID List</th>

	        <td><input class="opt form-control" type="text" name="idlist_mailchimp" value="<?php echo esc_attr( get_option('idlist_mailchimp') ); ?>" /></td>

	        </tr>
	    </table>

	    <?php submit_button(); ?>

	</form>

	</div>