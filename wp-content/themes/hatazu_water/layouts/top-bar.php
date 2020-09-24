 
 <div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
             <?php $count = 0; ?>
                     <?php $menu_top = get_field('menu_top','customizer');
                    if ($menu_top) :?>
                    <?php foreach ($menu_top as $value) :?>
                        <div class="topbar__item topbar__item--link">
                            <a class="topbar-link" href="<?php  echo $value['link_menu_top'];  ?>"><?php  echo $value['text_menu_top'];  ?></a>
                        </div>
                    <!-- END SLIDE #1 -->   
                     <?php $count++; ?>  
                    <?php endforeach;?>           
                    <?php endif;?>  
            
           
            <div class="topbar__spring"></div>
            <div class="topbar__item">
                <div class="topbar-dropdown">
                 <?php  if ( !is_user_logged_in() ) { ?>
                     <button class="topbar-dropdown__btn" type="button">
                        Đăng nhập
                        <svg width="7px" height="5px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-7x5"></use>
                        </svg>
                    </button>
                  <?php  } else {
                      $user = wp_get_current_user(); ?>
                      <button class="topbar-dropdown__btn" type="button">
                       <?php echo esc_attr( $user->display_name ); ?>
                        <svg width="7px" height="5px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-7x5"></use>
                        </svg>
                    </button>
                    <div class="topbar-dropdown__body">
                        <!-- .menu -->
                        <div class="menu menu--layout--topbar ">
                            <div class="menu__submenus-container"></div>
                             <?php wc_get_template( 'myaccount/navigation-menu.php' ); ?>
                        </div>
                        <!-- .menu / end -->
                    </div>
                    <?php } ?>    
                </div>
            </div>
            <div class="topbar__item">
                
            </div>
            <div class="topbar__item">
                
            </div>
        </div>
    </div>
</div>