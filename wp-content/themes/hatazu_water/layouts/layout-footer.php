</div>
<!-- site__body / end -->
<!-- site__footer -->
<footer class="site__footer">
<div class="site-footer">
<div class="container">
<div class="site-footer__widgets">
<div class="row">
<div class="col-12 col-md-6 col-lg-4">
	<div class="site-footer__widget footer-contacts">
		<h5 class="footer-contacts__title">Contact Us</h5>
		<div class="footer-contacts__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer in feugiat lorem. Pellentque ac placerat tellus.</div>
		<ul class="footer-contacts__contacts">
			<li><i class="footer-contacts__icon fas fa-globe-americas"></i>715 Fake Street, New York 10021 USA</li>
			<li><i class="footer-contacts__icon far fa-envelope"></i>stroyka@example.com</li>
			<li><i class="footer-contacts__icon fas fa-mobile-alt"></i>(800) 060-0730, (800) 060-0730</li>
			<li><i class="footer-contacts__icon far fa-clock"></i>Mon-Sat 10:00pm - 7:00pm</li>
		</ul>
	</div>
</div>
<div class="col-6 col-md-3 col-lg-2">
	<div class="site-footer__widget footer-links">
		<h5 class="footer-links__title">Information</h5>
		<ul class="footer-links__list">
		<li class="footer-links__item"><a href="" class="footer-links__link">About Us</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Delivery Information</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Privacy Policy</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Brands</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Contact Us</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Returns</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Site Map</a></li></ul>
	</div>
</div>
<div class="col-6 col-md-3 col-lg-2">
	<div class="site-footer__widget footer-links">
	<h5 class="footer-links__title">My Account</h5>
	<ul class="footer-links__list"><li class="footer-links__item"><a href="" class="footer-links__link">Store Location</a></li>
		<li class="footer-links__item"><a href="" class="footer-links__link">Order History</a></li>
			<li class="footer-links__item"><a href="" class="footer-links__link">Wish List</a></li>
			<li class="footer-links__item"><a href="" class="footer-links__link">Newsletter</a></li>
			<li class="footer-links__item"><a href="" class="footer-links__link">Specials</a></li>
			<li class="footer-links__item"><a href="" class="footer-links__link">Gift Certificates</a></li>
			<li class="footer-links__item"><a href="" class="footer-links__link">Affiliate</a></li>
		</ul>
	</div>
</div>
<div class="col-12 col-md-12 col-lg-4">
<div class="site-footer__widget footer-newsletter">
<h5 class="footer-newsletter__title">Newsletter</h5>
<div class="footer-newsletter__text">Praesent pellentesque volutpat ex, vitae auctor lorem pulvinar mollis felis at lacinia.</div>
	<form action="" class="footer-newsletter__form">
	<label class="sr-only" for="footer-newsletter-address">Email Address</label>
	 <input type="text" class="footer-newsletter__form-input form-control" id="footer-newsletter-address" placeholder="Email Address...">
	 <button class="footer-newsletter__form-button btn btn-primary">Subscribe</button>
	</form>
	<div class="footer-newsletter__text footer-newsletter__text--social">
Follow us on social networks</div>
<!-- social-links -->
<div class="social-links footer-newsletter__social-links social-links--shape--circle">
	<ul class="social-links__list">
		<li class="social-links__item"><a class="social-links__link social-links__link--type--rss" href="" target="_blank"><i class="fas fa-rss"></i>
		</a>
		</li>
		<li class="social-links__item"><a class="social-links__link social-links__link--type--youtube" href="" target="_blank"><i class="fab fa-youtube"></i></a></li>
		<li class="social-links__item"><a class="social-links__link social-links__link--type--facebook" href="" target="_blank"><i class="fab fa-facebook-f"></i></a>
		</li>
		<li class="social-links__item"><a class="social-links__link social-links__link--type--twitter" href="" target="_blank"><i class="fab fa-twitter"></i></a></li>
		<li class="social-links__item"><a class="social-links__link social-links__link--type--instagram" href="" target="_blank"><i class="fab fa-instagram"></i></a>
		</li>
	</ul>
</div>
<!-- social-links / end -->
</div>
</div>
</div>
</div>
	<div class="site-footer__bottom">
		<div class="site-footer__copyright">
		<!-- copyright -->Powered by HTML — Design by <a href="https://themeforest.net/user/kos9" target="_blank">
		Kos</a>
		<!-- copyright / end -->
		</div>
		<div class="site-footer__payments">
		<img src="<?php bloginfo('template_directory');?>/images/payments.png" alt="">
		</div>
	</div>
</div>
<div class="totop">
<div class="totop__body">
<div class="totop__start">
</div>
<div class="totop__container container">
</div>
<div class="totop__end">
<button type="button" class="totop__button">
<svg width="13px" height="8px">
<use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-up-13x8">
</use>
</svg> 
</button>
</div>
</div>
</div>
</div>
</footer>
<!-- site__footer / end -->
</div>
<!-- site / end -->
<!-- quickview-modal -->
<div id="quickview-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-xl">
<div class="modal-content">
</div>
</div>
</div>
<!-- quickview-modal / end -->
<!-- mobilemenu -->
<div class="mobilemenu">
	<div class="mobilemenu__backdrop"></div>
		<div class="mobilemenu__body">
			<div class="mobilemenu__header">
				<div class="mobilemenu__title">Menu</div>
				 <button type="button" class="mobilemenu__close">
                    <svg width="20px" height="20px">
                        <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#cross-20"></use>
                    </svg>
                </button>
			</div>
			<div class="mobilemenu__content">
				 <?php 
				  	get_template_part('layouts/mobile-link');
				  ?>
			</div>
		</div>
</div>
<!-- mobilemenu / end -->
<!-- photoswipe -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
<div class="pswp__bg">
</div>
<div class="pswp__scroll-wrap">
<div class="pswp__container">
<div class="pswp__item">
</div>
<div class="pswp__item">
</div>
<div class="pswp__item">
</div>
</div>
<div class="pswp__ui pswp__ui--hidden">
<div class="pswp__top-bar">
<div class="pswp__counter">
</div>
<button class="pswp__button pswp__button--close" title="Close (Esc)">
</button>
<!--<button class="pswp__button pswp__button&#45;&#45;share" title="Share">
</button>
-->
 <button class="pswp__button pswp__button--fs" title="Toggle fullscreen">
</button>
 <button class="pswp__button pswp__button--zoom" title="Zoom in/out">
</button>
<div class="pswp__preloader">
<div class="pswp__preloader__icn">
<div class="pswp__preloader__cut">
<div class="pswp__preloader__donut">
</div>
</div>
</div>
</div>
</div>
<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
<div class="pswp__share-tooltip">
</div>
</div>
<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
</button>
 <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
</button>
<div class="pswp__caption">
<div class="pswp__caption__center">
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	var ajax_admin = '<?php echo admin_url( 'admin-ajax.php') ?>';
</script>
<!-- photoswipe / end -->
<!-- js -->
<script src="<?php bloginfo('template_directory');?>/js/firstload.js?v=0.0.3"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/nouislider/nouislider.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/photoswipe/photoswipe.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/photoswipe/photoswipe-ui-default.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/select2/js/select2.min.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/number.js"></script>
<script src="<?php bloginfo('template_directory');?>/js/main.js?v=0.3.7.7"></script>
<script src="<?php bloginfo('template_directory');?>/js/header.js"></script>
<script src="<?php bloginfo('template_directory');?>/vendor/svg4everybody/svg4everybody.min.js"></script>
<script>svg4everybody();</script>
</body>
</html>
