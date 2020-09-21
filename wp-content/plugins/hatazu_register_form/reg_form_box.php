<?php 
function box_cropper(){ ?>
 <!--avatar-->       
        <div class="cropper">
              <div class="img-container">
              	<?php $user = wp_get_current_user();
                $avatar = apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' );
				      if ( $avatar ) { 
                	 //echo apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' ); ?>
                   <img id="image" src="<?php echo apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' ); ?>" height="500" weight="500">
                <?php	}
                else{
                	echo '<img id="image" src="'.plugin_dir_url( __FILE__ ) . 'images/avatar.jpeg" height="500" weight="500">'; 
                }
             	?>
              </div>
           
            <div class="docs-buttons">
              <!-- <h3 class="page-header">Toolbar:</h3> -->
             <div class="btn-group">                   
                <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                  <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                    <span class="fa fa-upload"></span>
                  </span>
                </label>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                    <span class="fa fa-search-plus"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                    <span class="fa fa-search-minus"></span>
                  </span>
                </button>
               <!--  <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ "width": 320, "height": 180 }">
		            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="cropper.getCroppedCanvas({ width: 320, height: 180 })">320×180</span>
		          </button> -->
              </div>
              <div class="btn-group">
              	<div class="input-group input-group-sm">
		            <span class="input-group-prepend">
		              <label class="input-group-text" for="dataWidth">Width</label>
		            </span>
		            <input type="text" class="form-control" id="dataWidth" placeholder="width">
		            <span class="input-group-append">
		              <span class="input-group-text">px</span>
		            </span>
		          </div>
              	<div class="input-group input-group-sm">
		            <span class="input-group-prepend">
		              <label class="input-group-text" for="dataHeight">Height</label>
		            </span>
		            <input type="text" class="form-control" id="dataHeight" placeholder="height">
		            <span class="input-group-append">
		              <span class="input-group-text">px</span>
		            </span>
		          </div>
              </div>      
              <div class="btn-group btn-group-crop">
                <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">Cắt ảnh</span>
                </button>
              </div>
             
              <!-- Show the cropped image in modal -->
               <div class="modal fade docs-cropped box-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body cropped-image"></div>
                    <div class="modal-footer">
                      <form method="post" action="">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <input id="download" type="hidden" name="download" value="">
                        <button type="button" onclick="upload_image(this);" class="btn btn-primary">Cập nhật</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- /.modal -->
          </div>
        </div>
      <!--end avatar -->
<?php }
function dashboard__begin(){?>
    <div class="dashboard">
<?php } 
function dashboard__profile(){?>
  <div class="dashboard__profile card profile-card">
      <div class="card-body profile-card__body">
          <div class="profile-card__avatar">
              <?php $user = wp_get_current_user();
              $avatar = apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' );
              if ( $avatar ) { 
                   //echo apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' ); ?>
                   <img src="<?php echo apply_filters( 'get_avatar', '',$user->ID , '', '', '', '' ); ?>">
                <?php }
                else{
                  echo '<img src="'.plugin_dir_url( __FILE__ ) . 'images/avatar.jpeg">'; 
                }
              ?>
              
          </div>
          <div class="profile-card__name"><?php echo esc_attr( $user->display_name ); ?></div>
          <div class="profile-card__email"><?php echo esc_attr( $user->user_email ); ?></div>
          <div class="profile-card__edit">
              <a href="<?php echo wc_customer_edit_account_url(); ?>" class="btn btn-secondary btn-sm">Edit Profile</a>
          </div>
      </div>
  </div>
<?php } 
function dashboard__address(){
  $customer_id = get_current_user_id();
  $name ='billing';
  $address = wc_get_account_formatted_address( $name );
  ?>
  <div class="dashboard__address card address-card address-card--featured">
      <div class="address-card__badge"><?php esc_html_e( 'Billing Address', 'woocommerce' ); ?></div>
      <div class="address-card__body">
          <div class="address-card__name"><?php echo get_user_meta( $customer_id, $name . '_first_name', true).' '.get_user_meta( $customer_id, $name . '_last_name', true);?></div>
          <div class="address-card__row">
             <?php
              echo get_user_meta( $customer_id, $name . '_address_1', true );            
        ?>
          </div>
          <?php if(get_user_meta( $customer_id, $name . '_phone', true)) { ?>
          <div class="address-card__row">
              <div class="address-card__row-title"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?></div>
              <div class="address-card__row-content"><?php echo get_user_meta( $customer_id, $name . '_phone', true);?></div>
          </div>
          <?php } ?>
          <?php if(get_user_meta( $customer_id, $name . '_email', true)) { ?>
          <div class="address-card__row">
              <div class="address-card__row-title"><?php esc_html_e( 'Email address', 'woocommerce' ); ?></div>
              <div class="address-card__row-content"><?php echo get_user_meta( $customer_id, $name . '_email', true);?></div>
          </div>
          <?php } ?>
          
          <div class="address-card__footer">
              <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>
          </div>
      </div>
  </div>
<?php } 
function dashboard__orders(){ 
  ?>
  <div class="dashboard__orders card">
      <div class="card-header">
          <h5><?php esc_html_e('Recent orders', 'woocommerce'); ?></h5>
      </div>
      <div class="card-divider"></div>
      <div class="card-table">
          <div class="table-responsive-sm">
            <?php wc_get_template( 'myaccount/my-orders.php' ); ?>
            
          </div>
      </div>
  </div> 
<?php } 
function dashboard__end(){?>
 </div>
<?php } ?>
  