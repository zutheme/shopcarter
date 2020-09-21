<?php  
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); 
function attribute_box($instance){ 
	$title = apply_filters( 'widget_title', $instance['title'] );
	$attribute_option = $instance[ 'attribute_name'];
	$template_option = $instance[ 'template_option'];
	$count_option = $instance[ 'count_option'];
	if($template_option == 0){ ?>
	 <div class="widget-filters__item">
	    <div class="filter filter--opened" data-collapse-item>
	        <button type="button" class="filter__title" data-collapse-trigger>
	            <?php echo $title; ?>
	            <svg class="filter__arrow" width="12px" height="7px">
	                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-12x7"></use>
	            </svg>
	        </button>
	        <div class="filter__body" data-collapse-content>
	        	<?php echo $attribute_name; ?>
	            <div class="filter__container">
	                <div class="filter-color">
	                    <div class="filter-color__list">    
	                     <?php
	                    //$attributes = wc_get_attribute_taxonomies();
	                    //var_dump($attributes); 
	                         $terms = get_terms( array( 
	                            'taxonomy' => $attribute_option,
	                            'hide_empty' => 0,
	                            'parent'   => 0,
	                            ) ); ?>
	                        <?php 
	                        foreach ($terms as $key => $item) { 
	                        	$color = get_term_meta($item->term_id, 'custom_field_taxonomy', true);
	                        	?>
	                        <label class="filter-color__item">
	                            <span class="filter-color__check input-check-color  input-check-color--white  " style="color: <?php echo $color; ?>">
	                                <label class="input-check-color__body">
	                                    <input class="input-check-color__input <?php echo $attribute_option; ?>" type="checkbox" value="<?php echo $item->term_id; ?>" attribute="<?php echo $attribute_option; ?>">
	                                    <span class="input-check-color__box"></span>
	                                    <svg class="input-check-color__icon" width="12px" height="9px">
	                                        <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#check-12x9"></use>
	                                    </svg>
	                                    <span class="input-check-color__stick"></span>
	                                </label>
	                            </span>
	                        </label>
	                         <?php } ?>              
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php }elseif ($template_option == 1) { ?>
	<div class="widget-filters__item">
        <div class="filter filter--opened" data-collapse-item>
            <button type="button" class="filter__title" data-collapse-trigger>
                <?php echo $title; ?>
                <svg class="filter__arrow" width="12px" height="7px">
                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-down-12x7"></use>
                </svg>
            </button>
            <div class="filter__body" data-collapse-content>
                <div class="filter__container">
                    <div class="filter-list">
                        <div class="filter-list__list">
                            <?php 
                                $terms = get_terms( array( 
                                    'taxonomy' => $attribute_option,
                                    'hide_empty' => 0,
                                    'parent'   => 0,
                                ) );
                                foreach ($terms as $key => $item) { ?>
                                    <label class="filter-list__item ">
                                        <span class="filter-list__input input-check">
                                            <span class="input-check__body">
                                                <input class="input-check__input <?php echo $attribute_option; ?>" type="checkbox" value="<?php echo $item->term_id; ?>" attribute="<?php echo $attribute_option; ?>">
                                                <span class="input-check__box"></span>
                                                <svg class="input-check__icon" width="9px" height="7px">
                                                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#check-9x7"></use>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="filter-list__title">
                                            <?php echo $item->name?>
                                        </span>
                                        <span class="filter-list__counter"><?php if($count_option ) { echo $item->count; } ?></span>
                                    </label>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
	<?php	
	} 
} 
?>
  