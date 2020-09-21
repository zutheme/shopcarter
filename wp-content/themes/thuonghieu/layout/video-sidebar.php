<div class="video-bg">
	<div class="container">
		<div class="contentwraps">
		<?php
		  echo "<script>var playlist = [];</script>";
          $args = array(
          'post_type' => 'video',
          'posts_per_page' => '6'
          );                                                                           
          $team_query = new WP_Query($args);
          $count = 0;
         if ($team_query->have_posts()) {
          while ($team_query->have_posts()) {
            $team_query->the_post();  
            $id = get_the_ID();
            $idyoutube = get_post_meta( $id, 'id-youtube', true );
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium', false );
            if($count==0){
            	if( isset($idyoutube) ) {
	            	echo "<script>".
	            		 "playlist.push('".$idyoutube."');".
	            		"function onYouTubeIframeAPIReady() {
				        player = new YT.Player('player', {
				          height: maxHeightvideo,
				          width: '100%',
				          playerVars: {
				            color: 'white', 
				            rel: 0,
				            //controls:0,
				            playlist: playlist.join(','),
				          },
				          events: {
				            'onReady': onPlayerReady
				            //'onStateChange': onPlayerStateChange
				          }
				        });
				      }</script>";
			}
	           ?>
	            <div class="infoCates">
					<article id="video-container" class="video-desc">
						<div class="thumbnail-player">
							<div id="player"></div> 					
						</div>
					</article>
				</div>
				<ul class="listCateHomes">	
			           <?php
			           }else { 
			           	echo "<script>".
	            		 "playlist.push('".$idyoutube."');</script>";
			           	?>
				           		<li><article class="desc-thumb">
									<div class="video-mask">
										<a class="thumb" href="#"><img src="https://img.youtube.com/vi/<?php echo $idyoutube; ?>/0.jpg"></a>
										<div class="mask">
											<a href="#<?php echo $count; ?>" class="btn btn-default btn-video"><i class="fa fa-play" aria-hidden="true"></i></a>
										</div>
									</div>
									<div class="desc">
										<h2><a class="link-video" href="#<?php echo $count; ?>"><?php the_title(); ?></a></h2>
									</div>
								</article></li>
			           		<?php }
			           		$count++; 
				              }//end while
				          } else {
				              echo "nothing found";
				          }//end if have post
				          wp_reset_query();  ?>
				 </ul>
			</div>
	</div>
</div>
<!-- <script>

      

    </script> -->