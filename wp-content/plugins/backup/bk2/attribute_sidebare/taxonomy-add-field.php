<?php 
function wh_taxonomy_add_new_meta_field() {
    ?>   
    <div class="form-field">
        <label for="wh_meta_title"><?php _e('Color codes', 'wh'); ?></label>
        <input type="text" name="custom_field_taxonomy" id="custom_field_taxonomy">
        <p class="description"><?php _e('Enter a code', 'wh'); ?></p>
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
        <th scope="row" valign="top"><label for="wh_meta_title"><?php _e('Color codes', 'wh'); ?></label></th>
        <td>
            <input type="text" name="custom_field_taxonomy" id="custom_field_taxonomy" value="<?php echo esc_attr($wh_meta_custom_field) ? esc_attr($wh_meta_custom_field) : ''; ?>">
            <p class="description"><?php _e('Enter a code', 'wh'); ?></p>
        </td>
    </tr>
    <?php
}


// Save extra taxonomy fields callback function.
function wh_save_taxonomy_custom_meta($term_id) {

    $wh_meta_custom_field = filter_input(INPUT_POST, 'custom_field_taxonomy');
    update_term_meta($term_id, 'custom_field_taxonomy', $wh_meta_custom_field);
} 
add_action( 'plugins_loaded', 'add_field_multi_attribute');
function add_field_multi_attribute(){
	$attributes = wc_get_attribute_taxonomies(); 
	foreach ($attributes as $key => $attribute) { 
		$prefix_taxonomy = 'pa_'.$attribute->attribute_name;
		add_action($prefix_taxonomy.'_add_form_fields', 'wh_taxonomy_add_new_meta_field', 10, 1);
		add_action($prefix_taxonomy.'_edit_form_fields', 'wh_taxonomy_edit_meta_field', 10, 1);
		add_action('edited_'.$prefix_taxonomy, 'wh_save_taxonomy_custom_meta', 10, 1);
		add_action('create_'.$prefix_taxonomy, 'wh_save_taxonomy_custom_meta', 10, 1);
	}
} ?>