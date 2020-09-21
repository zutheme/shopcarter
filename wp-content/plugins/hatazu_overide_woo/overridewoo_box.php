<?php function contact_box($title){ ?>
<div class="modal-consultant-form">
  <div class="modal-consult">
    <!-- Modal content -->
    <div class="modal-content-consult">   
      	<form class="frm-register">
      		<span class="close">&times;</span>
      		<div class="row">
	      		<!-- <div class="column">
	      			<div class="register">
	 					<a class="doctor" href="javascript(0);"><img class="bacsi" src="<?php //echo plugin_dir_url(__FILE__); ?>images/chuyen-gia1.jpg"></a>
	 				</div>	
	      		</div> -->
	      		<div class="column reg">
	      			<div class="form-reg">
		      			<h2>Tư vấn </h2>
						<div class="input-group-consult">
							<input type="text" class="form-control-consult your-name" name="your-name" placeholder="Họ và tên" required>
					  	</div>
						<div class="input-group-consult">
							<input type="number" class="form-control-consult your-phone" name="your-phone" placeholder="Điện thoại" required>
						</div>		
					  <div class="input-group-consult">
							<input type="email" class="form-control-consult your-email" name="your-email" placeholder="E-mail (nếu có)">
						</div>
					   <div class="input-group-consult">
							<input type="text" class="form-control-consult your-address" name="your-address" placeholder="Địa chỉ">
						</div>
						<div class="input-group-consult">
							<textarea col="2" row="10" class="form-control-consult your-message" placeholder="Nội dung"></textarea>
						</div>	
					  <div class="input-group-consult area-btn">
							<a href="javascript:void(0)" class="btn btn-default btn-register">Đăng ký ngay</a>
					  </div>
					  <p>(* Mọi thông tin được bảo mật)</p>
					  <!-- <p><img class="loading" style="display:none;width:30px;" src="<?php //echo plugin_dir_url(__FILE__); ?>images/loader.gif"></p> -->
					  <span class="result"></span>  	
					  <!-- <canvas id="my_canvas_id" width="0px" height="0px"></canvas> -->
					</div>
				</div>
			</div>
		</form>	  	
    </div>
  </div>
</div>
<?php } ?>
<?php function processing_modal(){ ?>
	<div class="htz-popup-processing" style="display: none; position: fixed; z-index: 99999 !important;left: 0;top: 0%;width: 100%; height: 100%; overflow: auto;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4); ">
	<div class="processing" style="position:relative;background-color: rgba(255,255,255,0.1);width: 250px;height: 250px;margin-top:15%; margin-left: auto;margin-right: auto;text-align: center;">
		<p><img class="loading" style=" position: absolute;top: 11%;left: 11%;display: none;width: 200px; height: 200px;margin-left: auto;margin-right: auto;" src="<?php echo plugin_dir_url(__FILE__) .'images/loader-1.gif'; ?>"></p>
		<p class="result" style="text-align:center;color: #fff;font-size: 24px; padding: 5px 15px;top:15%;position:relative;"></p>
	</div>
</div>
<?php } ?>
<?php function box_link_contact(){ 
?>
<div id="box-link" class="box-link" style="display:none">
<ul>
<li><a href="<?php echo esc_attr( get_option('box-facebook') ); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
<li><a href="<?php echo esc_attr( get_option('box-youtube') ); ?>"><i class="fa fa-youtube-play"></i></a></li>
<li><a href="tel:<?php echo esc_attr( get_option('box-phone') ); ?>"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
<li><a class="consultant" href="javascript:void(0);"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
</ul>
</div>
<?php } ?>
