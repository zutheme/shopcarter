<div class="wrap">

	<h2>Setting subscriber option</h2>

	<form method="post" action="options.php">

	    <?php settings_fields( 'subscriber-settings' ); ?>

	    <?php do_settings_sections( 'subscriber-settings' ); ?>

	    <?php 
			if ( isset( $_POST['syndata'] ) ) {}
		    $subscriber = (string) $_POST['syndata'];
		    // apply more sanitizations here if needed
		    $subscriber = new subscriber();
		    $subscriber->SynData();
		    $error = $subscriber->_Error();
		    if($error){
		    	echo $error;
		    }else{
		    	echo 'Synchronize success';
		    }
		?>

	    <table class="form-table">
	        <tr valign="top">
	        	<th scope="row">Synchronize email from customer woocommerce</th>
	        </tr>
	      	<tr><td>
	      		<input class="btn btn-default" type="submit" name="submit" value="Synchronize">
	      	</td></tr>
	    </table>

	    <?php //submit_button(); ?>

	</form>

	</div>