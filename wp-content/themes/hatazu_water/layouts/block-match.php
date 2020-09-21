<div class="match haloween-shop">
    <div class="container">
        <div class="row">
             <?php $match_header_menu = get_field('match_header_menu','customizer');
                if ($match_header_menu) :?>
                <?php $count = 0; ?>
                <?php foreach ($match_header_menu as $value) : 
                    if( $count < 2) {
                ?>
                 <div class="col-6 thumb-cate text-center">
                    <a href="<?php echo $value['match_header_link']; ?>"><img src="<?php echo $value['match_header_image']['url']; ?>"></a>
                    <div class="menu-cate">
                        <?php echo $value['match_header_text']; ?>
                       <!--  <h3>NEW! MADE TO MATCH</h3>
                        <p>Totally fun tops have a matching legging.</p> -->
                        <div class="cate">
                            <ul>
                                <li><a href="<?php echo $value['match_header_link1']; ?>"><?php echo $value['match_header_text1']; ?></a></li>
                                <li><a href="<?php echo $value['match_header_link2']; ?>"><?php echo $value['match_header_text2']; ?></a></li>
                                <li><a href="<?php echo $value['match_header_link3']; ?>"><?php echo $value['match_header_text3']; ?></a></li>
                            </ul>
                        </div>
                    </div> 
                </div>
                <?php } 
                $count++; ?>
                <?php endforeach; ?>           
            <?php endif;?> 
        </div>
    </div>
</div>