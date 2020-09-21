<?php
class init_custom_field_taxonomy
// Always prefix your plugin with something unique, like your name. Here I used the question number
{
    public $_renderTasksOn;
    //var $_renderTasksOn = array( 'wp_insert_post', 'wp_insert_comment', ... );
    function __construct() {
   		$_renderTasksOn =  wc_get_attribute_taxonomies();
    }
    function init_custom_field_taxonomy()
    {
        // The constructor of this class, which will hook up everything
        // This is the 'trick' to this question: a loop on your list and `add_action` for each item
        foreach ( $this->_renderTasksOn as $attribute ) {
            //add_action( $hookname, array( $this, 'getStatic' ) );
            $prefix_taxonomy = 'pa_'.$attribute->attribute_name;
			add_action($prefix_taxonomy.'_add_form_fields', array( $this,'wh_taxonomy_add_new_meta_field'));
			add_action($prefix_taxonomy.'_edit_form_fields', array( $this,'wh_taxonomy_edit_meta_field'));
			add_action('edited_'.$prefix_taxonomy, array( $this,'wh_save_taxonomy_custom_meta'));
			add_action('create_'.$prefix_taxonomy, array( $this,'wh_save_taxonomy_custom_meta'));
        }
    }

    function getStatic()
    {
        // Your code
    }
    function wh_taxonomy_add_new_meta_field() {
    ?>   
	    <div class="form-field">
	        <label for="wh_meta_title"><?php _e('Meta Title', 'wh'); ?></label>
	        <input type="text" name="custom_field_taxonomy" id="custom_field_taxonomy">
	        <p class="description"><?php _e('Enter a meta title, <= 60 character', 'wh'); ?></p>
	    </div>
	    <?php

	}
	//Product Cat Edit page
	function wh_taxonomy_edit_meta_field($term) {
	    //getting term ID
	    $term_id = $term->term_id;
	    // retrieve the existing value(s) for this meta field.
	    $wh_meta_custom_field = get_term_meta($term_id, 'custom_field_taxonomy', true); ?>
	    <tr class="form-field">
	        <th scope="row" valign="top"><label for="wh_meta_title"><?php _e('Meta Title', 'wh'); ?></label></th>
	        <td>
	            <input type="text" name="custom_field_taxonomy" id="custom_field_taxonomy" value="<?php echo esc_attr($wh_meta_custom_field) ? esc_attr($wh_meta_custom_field) : ''; ?>">
	            <p class="description"><?php _e('Enter a meta title, <= 60 character', 'wh'); ?></p>
	        </td>
	    </tr>
	    <?php
	}


	// Save extra taxonomy fields callback function.
	function wh_save_taxonomy_custom_meta($term_id) {

	    $wh_meta_custom_field = filter_input(INPUT_POST, 'custom_field_taxonomy');
	    update_term_meta($term_id, 'custom_field_taxonomy', $wh_meta_custom_field);
	} 
}

// add_action( 'plugins_loaded', 'init_custom_field_taxonomy_init' );
// function init_custom_field_taxonomy_init()
// {
//     $GLOBALS['init_custom_field_taxonomy_instance'] = new init_custom_field_taxonomy();
// }
?>