<?php  defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="attribute wrap">
	<h2>Setting attrinbute</h2>
	<form method="post" action="options.php">
	    <?php settings_fields( 'htzattribute-option' ); 
	     do_settings_sections( 'htzattribute-option' ); 
	     if ( isset( $_POST['htzClientKey'] ) ) {
		    $foo1 = (string) $_POST['htzClientKey'];
		    // apply more sanitizations here if needed
		} 
		if ( isset( $_POST['htzClientSecret'] ) ) {
		    $foo2 = (string) $_POST['htzClientSecret'];
		    // apply more sanitizations here if needed
		} 
		?>

    <table class="form-table">
    	<tr><td>--option---</td></tr>
        <tr><td>
        	<p><label>Client Key woocomerce</label></p>
        	<input class="opt form-control" type="text" name="htzClientKey" value="<?php echo esc_attr( get_option('htzClientKey') ); ?>" /></td>
        </tr> 
         <tr><td>
         	<p><label>Client Secret woocomerce</label></p>
         	<input class="opt form-control" type="text" name="htzClientSecret" value="<?php echo esc_attr( get_option('htzClientSecret') ); ?>" /></td>
        </tr> 
    </table>
	    <?php submit_button(); ?>
	</form>
	</div>
<?php /*end file */ ?>