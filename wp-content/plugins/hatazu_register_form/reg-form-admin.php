<div class="wrap">

	<h2>Setting reg_form theme</h2>

	<form method="post" action="options.php">

	    <?php settings_fields( 'reg_form-settings' ); ?>

	    <?php do_settings_sections( 'reg_form-settings' ); ?>

	    <?php if ( isset( $_POST['option-reg'] ) ) {

		    $foo = (string) $_POST['option-reg'];

		    // apply more sanitizations here if needed

		} ?>

	    <table class="form-table">

	    	<tr><td>--reg option---</td></tr>

	        <tr valign="top">

	        <th scope="row">reg option</th>

	        <td><input class="opt form-control" type="text" name="option-reg" value="<?php echo esc_attr( get_option('option-reg') ); ?>" /></td>

	        </tr>
	      
	    </table>

	    <?php submit_button(); ?>

	</form>

	</div>