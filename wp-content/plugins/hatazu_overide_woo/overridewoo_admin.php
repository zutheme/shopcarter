<div class="wrap">

	<h2>Setting option links</h2>

	<form method="post" action="options.php">

	    <?php settings_fields( 'box-link-settings-group' ); ?>

	    <?php do_settings_sections( 'box-link-settings-group' ); ?>


	    <table class="form-table">

	        <tr valign="top">

	        <th scope="row">facebook</th>

	        <td><input type="text" name="box-facebook" value="<?php echo esc_attr( get_option('box-facebook') ); ?>" /></td>

	        </tr>
	    </table>

	    <?php submit_button(); ?>

	</form>

	</div>