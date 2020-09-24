<?php
/*htz Theme Customizer.*
 * @package htz */

/*Create options page*/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Tùy chỉnh',
		'menu_title'	=> 'Tùy chỉnh',
		'menu_slug' 	=> 'customizer',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-hammer',
		'id'			=> 'customizer',
		'post_id' 		=> 'customizer',
	));
}

/*Add FTP field group*/
if( function_exists('acf_add_local_field_group') ) {
	
	acf_add_local_field_group(	array(
		'key'		=> 'customizer_setup',
		'title' 	=> __( 'Cài đặt', 'htz' ),
		'fields' 	=> array (
			/*Logo*/
            array (
				'key'   		=> 'tab_hotro',
				'label' 		=> __( 'Logo  ', 'htz' ),
				'name'  		=> 'tab_hotro',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
			
			array (
				'key'   		=> 'itobjects',
				'label' 		=> __( 'Itobject', 'htz' ),
				'name'  		=> 'itobjects',
				'type'  		=> 'text', 
			),
	
			 array (
				'key'   		=> 'logo',
				'label' 		=> __( 'Logo', 'htz' ),
				'name'  		=> 'logo',
				'type'  		=> 'image',
			),
			
			 array (
				'key'   		=> 'favicon',
				'label' 		=> __( 'Favicon', 'htz' ),
				'name'  		=> 'favicon',
				'type'  		=> 'image',
			),
			 
			 array (
				'key'   		=> 'keywords',
				'label' 		=> __( 'Keywords', 'htz' ),
				'name'  		=> 'keywords',
				'type'  		=> 'textarea',
			),
		
		    array (
				'key'   		=> 'description',
				'label' 		=> __( 'Description', 'htz' ),
				'name'  		=> 'description',
				'type'  		=> 'textarea',
			),
	
		  //Head
			array (
				'key'   		=> 'tab_header',
				'label' 		=> __( 'Header', 'htz' ),
				'name'  		=> 'tab_header',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),

		 
			array (
			'key'   		=> 'menu_top',
			'label' 		=> __( 'menu list', 'htz' ),
			'name'  		=> 'menu_top',
			'type'  		=> 'repeater',
			'layout'	   => 'table',
			'button_label' => __( 'Thêm', 'htz' ),
			'sub_fields' => array (
			 	array (
					'key'   		=> 'text_menu_top',
					'label' 		=> __( 'text menu', 'htz' ),
					'name'  		=> 'text_menu_top',
					'type'  		=> 'text',
				 
				),
			 	array (
					'key'   		=> 'link_menu_top',
					'label' 		=> __( 'Link', 'htz' ),
					'name'  		=> 'link_menu_top',
					'type'  		=> 'text',
				 
				),
			),
		),
		 array (
				'key'   		=> 'header_phone1',
				'label' 		=> __( 'Số điện thoại 1', 'htz' ),
				'name'  		=> 'header_phone1',
				'type'  		=> 'text',
			),
		 array (
				'key'   		=> 'header_phone2',
				'label' 		=> __( 'Số điện thoại 2', 'htz' ),
				'name'  		=> 'header_phone2',
				'type'  		=> 'text',
			),
		  array (
				'key'   		=> 'header_address',
				'label' 		=> __( 'Dia chi', 'htz' ),
				'name'  		=> 'header_address',
				'type'  		=> 'text',
			),
		  array (
				'key'   		=> 'header_email',
				'label' 		=> __( 'Email', 'htz' ),
				'name'  		=> 'header_email',
				'type'  		=> 'text',
			),
		  array (
				'key'   		=> 'zalo',
				'label' 		=> __( 'Zalo', 'htz' ),
				'name'  		=> 'zalo',
				'type'  		=> 'text',
			),
			
		  
		    array (
				'key'   		=> 'idfacebook',
				'label' 		=> __( 'Idfacebook', 'htz' ),
				'name'  		=> 'idfacebook',
				'type'  		=> 'text',
			),
		 
     	/*slider*/
		  array (
				'key'   		=> 'tab_slider',
				'label' 		=> __( 'slider', 'htz' ),
				'name'  		=> 'tab_slider',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
	
				array (
				'key'   		=> 'slider',
				'label' 		=> __( 'Hình slider (1110x480)', 'htz' ),
				'name'  		=> 'slider',
				'type'  		=> 'repeater',
				'layout'	   => 'block',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'image_slider',
						'label' 		=> __( 'Hình ảnh', 'htz' ),
						'name'  		=> 'image_slider',
						'type'  		=> 'image',
					),
	
					array (
						'key'   		=> 'link_slider',
						'label' 		=> __( 'Link', 'htz' ),
						'name'  		=> 'link_slider',
						'type'  		=> 'text',
					 
					),
					
				 	array (
						'key'   		=> 'tex1_slider',
						'label' 		=> __( 'text 1', 'htz' ),
						'name'  		=> 'tex1_slider',
						'type'  		=> 'textarea',
					 
					),
				 
				),
			),
			/*featured block*/
			array (
				'key'   		=> 'featured_block_general',
				'label' 		=> __( 'Featured block', 'htz' ),
				'name'  		=> 'featured_block_general',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),

		 
			array (
			'key'   		=> 'featured_block',
			'label' 		=> __( 'featured block', 'htz' ),
			'name'  		=> 'featured_block',
			'type'  		=> 'repeater',
			'layout'	   => 'table',
			'button_label' => __( 'Thêm', 'htz' ),
			'sub_fields' => array (
			 	array (
					'key'   		=> 'featured_block_text',
					'label' 		=> __( 'text menu', 'htz' ),
					'name'  		=> 'featured_block_text',
					'type'  		=> 'text',
				 
				),
			 	array (
					'key'   		=> 'featured_block_link',
					'label' 		=> __( 'Link', 'htz' ),
					'name'  		=> 'featured_block_link',
					'type'  		=> 'text',
				 
					),
				),
			),

			/**banner*/
			array (
				'key'   		=> 'banner_general',
				'label' 		=> __( 'Banner khuyen mai', 'htz' ),
				'name'  		=> 'banner_general',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),

		    array (
				'key'   		=> 'banner_image',
				'label' 		=> __( 'Anh banner kich thuoc (1110x480)', 'htz' ),
				'name'  		=> 'banner_image',
				'type'  		=> 'image',	
			),
			 array (
				'key'   		=> 'banner_text',
				'label' 		=> __( 'Noi dung', 'htz' ),
				'name'  		=> 'banner_text',
				'type'  		=> 'textarea',	
			),

			/*haloween*/
			array (
				'key'   		=> 'haloween_general',
				'label' 		=> __( 'Chuyen muc khuyen mai', 'htz' ),
				'name'  		=> 'haloween_general',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),

		    array (
				'key'   		=> 'haloween_header',
				'label' 		=> __( 'Header chuyen muc', 'htz' ),
				'name'  		=> 'haloween_header',
				'type'  		=> 'textarea',	
			),
			array (
			'key'   		=> 'haloween_header_menu',
			'label' 		=> __( 'menu khuyen mai', 'htz' ),
			'name'  		=> 'haloween_header_menu',
			'type'  		=> 'repeater',
			'layout'	   => 'table',
			'button_label' => __( 'Thêm', 'htz' ),
			'sub_fields' => array (
			 	array (
					'key'   		=> 'haloween_header_text',
					'label' 		=> __( 'text menu', 'htz' ),
					'name'  		=> 'haloween_header_text',
					'type'  		=> 'text',
				 
				),
			 	array (
					'key'   		=> 'haloween_header_link',
					'label' 		=> __( 'Link', 'htz' ),
					'name'  		=> 'haloween_header_link',
					'type'  		=> 'text',
					),
				),
			),
			

			/*litte*/
			array (
			'key'   		=> 'litte_general',
			'label' 		=> __( 'Chuyen muc unknown', 'htz' ),
			'name'  		=> 'litte_general',
			'type'  		=> 'tab',
			'placement' 	=> 'left',
			),

			array (
			'key'   		=> 'litte_header',
			'label' 		=> __( 'Header chuyen muc', 'htz' ),
			'name'  		=> 'litte_header',
			'type'  		=> 'textarea',	
			),
			array (
			'key'   		=> 'litte_header_menu',
			'label' 		=> __( 'menu khuyen mai', 'htz' ),
			'name'  		=> 'litte_header_menu',
			'type'  		=> 'repeater',
			'layout'	   => 'block',
			'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'litte_header_image',
						'label' 		=> __( 'anh dai dien', 'htz' ),
						'name'  		=> 'litte_header_image',
						'type'  		=> 'image',
					),
					array (
						'key'   		=> 'litte_header_text',
						'label' 		=> __( 'title chinh', 'htz' ),
						'name'  		=> 'litte_header_text',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'litte_header_link',
						'label' 		=> __( 'link chinh', 'htz' ),
						'name'  		=> 'litte_header_link',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'litte_header_text1',
						'label' 		=> __( 'title 1', 'htz' ),
						'name'  		=> 'litte_header_text1',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'litte_header_link1',
						'label' 		=> __( 'Link 1', 'htz' ),
						'name'  		=> 'litte_header_link1',
						'type'  		=> 'text',
					),
					array (
						'key'   		=> 'litte_header_text2',
						'label' 		=> __( 'title 2', 'htz' ),
						'name'  		=> 'litte_header_text2',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'litte_header_link2',
						'label' 		=> __( 'Link 2', 'htz' ),
						'name'  		=> 'litte_header_link2',
						'type'  		=> 'text',
					),
				),
			),
			/*match*/
			array (
			'key'   		=> 'match_general',
			'label' 		=> __( 'Chuyen muc match', 'htz' ),
			'name'  		=> 'match_general',
			'type'  		=> 'tab',
			'placement' 	=> 'left',
			),
			array (
			'key'   		=> 'match_header_menu',
			'label' 		=> __( 'menu khuyen mai', 'htz' ),
			'name'  		=> 'match_header_menu',
			'type'  		=> 'repeater',
			'layout'	   => 'block',
			'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'match_header_image',
						'label' 		=> __( 'anh dai dien', 'htz' ),
						'name'  		=> 'match_header_image',
						'type'  		=> 'image',
					),
					array (
						'key'   		=> 'match_header_text',
						'label' 		=> __( 'title chinh', 'htz' ),
						'name'  		=> 'match_header_text',
						'type'  		=> 'textarea',
				 
					),
					array (
						'key'   		=> 'match_header_link',
						'label' 		=> __( 'link chinh', 'htz' ),
						'name'  		=> 'match_header_link',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'match_header_text1',
						'label' 		=> __( 'title 1', 'htz' ),
						'name'  		=> 'match_header_text1',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'match_header_link1',
						'label' 		=> __( 'Link 1', 'htz' ),
						'name'  		=> 'match_header_link1',
						'type'  		=> 'text',
					),
					array (
						'key'   		=> 'match_header_text2',
						'label' 		=> __( 'title 2', 'htz' ),
						'name'  		=> 'match_header_text2',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'match_header_link2',
						'label' 		=> __( 'Link 2', 'htz' ),
						'name'  		=> 'match_header_link2',
						'type'  		=> 'text',
					),
					array (
						'key'   		=> 'match_header_text3',
						'label' 		=> __( 'title 3', 'htz' ),
						'name'  		=> 'match_header_text3',
						'type'  		=> 'text',
				 
					),
					array (
						'key'   		=> 'match_header_link3',
						'label' 		=> __( 'Link 3', 'htz' ),
						'name'  		=> 'match_header_link3',
						'type'  		=> 'text',
					),
				),
			),
			/*skip_hop*/
			array (
			'key'   		=> 'skip_hop_general',
			'label' 		=> __( 'Chuyen muc skip_hop', 'htz' ),
			'name'  		=> 'skip_hop_general',
			'type'  		=> 'tab',
			'placement' 	=> 'left',
			),
			array (
				'key'   		=> 'skip_hop_header_image',
				'label' 		=> __( 'anh dai dien', 'htz' ),
				'name'  		=> 'skip_hop_header_image',
				'type'  		=> 'image',
			),
			
			array (
				'key'   		=> 'skip_hop_header_link',
				'label' 		=> __( 'link chinh', 'htz' ),
				'name'  		=> 'skip_hop_header_link',
				'type'  		=> 'text',
		 
			),
			array (
					'key'   		=> 'skip_hop_header_right_image',
					'label' 		=> __( 'anh dai dien', 'htz' ),
					'name'  		=> 'skip_hop_header_right_image',
					'type'  		=> 'image',
				),
				array (
					'key'   		=> 'skip_hop_header_right_text',
					'label' 		=> __( 'text shop', 'htz' ),
					'name'  		=> 'skip_hop_header_right_text',
					'type'  		=> 'text',
			 
				),
				array (
					'key'   		=> 'skip_hop_header_right_link',
					'label' 		=> __( 'link shop', 'htz' ),
					'name'  		=> 'skip_hop_header_right_link',
					'type'  		=> 'text',
			 
				),
			/*slider middle*/
		  array (
				'key'   		=> 'slider_middle_general',
				'label' 		=> __( 'slider middle', 'htz' ),
				'name'  		=> 'slider_middle_general',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
	
				array (
				'key'   		=> 'slider_middle',
				'label' 		=> __( 'Hình slider middle (1110x480)', 'htz' ),
				'name'  		=> 'slider_middle',
				'type'  		=> 'repeater',
				'layout'	   => 'block',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'slider_middle_image',
						'label' 		=> __( 'Hình ảnh', 'htz' ),
						'name'  		=> 'slider_middle_image',
						'type'  		=> 'image',
					),
	
					array (
						'key'   		=> 'slider_middle_link',
						'label' 		=> __( 'Link', 'htz' ),
						'name'  		=> 'slider_middle_link',
						'type'  		=> 'text',
					 
					),
					
				 	array (
						'key'   		=> 'slider_middle_text',
						'label' 		=> __( 'text 1', 'htz' ),
						'name'  		=> 'slider_middle_text',
						'type'  		=> 'textarea',
					 
					),
				 
				),
			),
			/*two_line*/
			array (
			'key'   		=> 'two_line_general',
			'label' 		=> __( 'Chuyen muc two_line', 'htz' ),
			'name'  		=> 'two_line_general',
			'type'  		=> 'tab',
			'placement' 	=> 'left',
			),
			array (
				'key'   		=> 'two_line_header_image',
				'label' 		=> __( 'icon', 'htz' ),
				'name'  		=> 'two_line_header_image',
				'type'  		=> 'image',
			),
			array (
					'key'   		=> 'two_line_header_text',
					'label' 		=> __( 'text', 'htz' ),
					'name'  		=> 'two_line_header_text',
					'type'  		=> 'text',
				),
			array (
				'key'   		=> 'two_line_header_link',
				'label' 		=> __( 'link', 'htz' ),
				'name'  		=> 'two_line_header_link',
				'type'  		=> 'text',
			),
			
			/*partner*/
			array (
				'key'   		=> 'section_partner',
				'label' 		=> __( 'section partner', 'htz' ),
				'name'  		=> 'partner_header_genaral',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),

		    array (
				'key'   		=> 'partner_header',
				'label' 		=> __( 'Tiêu đề đối tác', 'htz' ),
				'name'  		=> 'partner_header',
				'type'  		=> 'text',	
			),
	 		array (
				'key'   		=> 'partner_caption',
				'label' 		=> __( 'Mô tả', 'htz' ),
				'name'  		=> 'partner_caption',
				'type'  		=> 'textarea',
			),

		    
			array (
				'key'   		=> 'partner_image',
				'label' 		=> __( 'Hình logo', 'htz' ),
				'name'  		=> 'partner_image',
				'type'  		=> 'repeater',
				'layout'	   => 'table',
				'button_label' => __( 'Thêm', 'htz' ),
				'sub_fields' => array (
					array (
						'key'   		=> 'image_partner',
						'label' 		=> __( 'Hình ảnh', 'htz' ),
						'name'  		=> 'image_partner_thumb',
						'type'  		=> 'image',
					),
					 
					 
					 
					array (
						'key'   		=> 'link_partner_logo',
						'label' 		=> __( 'Link', 'htz' ),
						'name'  		=> 'link_partner_logo',
						'type'  		=> 'text',
					 
					),
					
				),
			),
			array (
				'key'   		=> 'tab_contact',
				'label' 		=> __( 'section contact', 'htz' ),
				'name'  		=> 'section_contact',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
			 array (
				'key'   		=> 'section_contact_left',
				'label' 		=> __( 'Ghi chu contact', 'htz' ),
				'name'  		=> 'contact_note',
				'type'  		=> 'textarea',	
			),
			 array (
				'key'   		=> 'section_contact_bg',
				'label' 		=> __( 'Anh nen backgroup', 'htz' ),
				'name'  		=> 'contact_img_background',
				'type'  		=> 'image',	
			),
			 /*sidebar*/
			
		
			/* consultant */
			array (
				'key'   		=> 'consultant_background',
				'label' 		=> __( 'Tu van cuoi trang', 'htz' ),
				'name'  		=> 'consultant_background',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
			array (
				'key'   		=> 'consultant_background_image',
				'label' 		=> __( 'Hình ảnh (1920x600)', 'htz' ),
				'name'  		=> 'consultant_background_image',
				'type'  		=> 'image',
			),
			array (
				'key'   		=> 'consultant_background_html',
				'label' 		=> __( 'html', 'htz' ),
				'name'  		=> 'consultant_background_html',
				'type'  		=> 'textarea',
			 
			),
		
			 /*tab trang lien he*/
				
			  array (
					'key'   		=> 'carousel',
					'label' 		=> __( 'chuyen muc san pham', 'htz' ),
					'name'  		=> 'carousel',
					'type'  		=> 'tab',
					'placement' 	=> 'left',
				),
				array (
					'key'   		=> 'carousel_header1',
					'label' 		=> __( 'Chuyen muc 1', 'htz' ),
					'name'  		=> 'carousel_header1',
					'type'  		=> 'text',
				), 
				array (
					'key'   		=> 'carousel_header2',
					'label' 		=> __( 'Chuyen muc 2', 'htz' ),
					'name'  		=> 'carousel_header2',
					'type'  		=> 'text',
				 
				),
				
			/*Footer*/
			array (
				'key'   		=> 'tab_footer',
				'label' 		=> __( 'Footer', 'htz' ),
				'name'  		=> 'tab_footer',
				'type'  		=> 'tab',
				'placement' 	=> 'left',
			),
		 
		 	 array (
				'key'   		=> 'footer_logo',
				'label' 		=> __( 'logo footer', 'htz' ),
				'name'  		=> 'footer_logo',
				'type'  		=> 'image',	
			), 
		 	 array (
				'key'   		=> 'footer_header',
				'label' 		=> __( 'tieu de', 'htz' ),
				'name'  		=> 'footer_header',
				'type'  		=> 'text',	
			), 
		  	array (
				'key'   		=> 'footer_desc',
				'label' 		=> __( 'Mo ta van tat', 'htz' ),
				'name'  		=> 'footer_desc',
				'type'  		=> 'textarea',	
			), 
		    array (
				'key'   		=> 'footer_address',
				'label' 		=> __( 'dia chi', 'htz' ),
				'name'  		=> 'footer_address',
				'type'  		=> 'textarea',	
			), 
			array (
				'key'   		=> 'footer_email',
				'label' 		=> __( 'email', 'htz' ),
				'name'  		=> 'footer_email',
				'type'  		=> 'text',	
			), 
		 	array (
				'key'   		=> 'footer_phone',
				'label' 		=> __( 'dien thoai', 'htz' ),
				'name'  		=> 'footer_phone',
				'type'  		=> 'text',	
			), 
		 
		    array (
				'key'   		=> 'footer_time',
				'label' 		=> __( 'Thoi gian lam viec', 'htz' ),
				'name'  		=> 'footer_time',
				'type'  		=> 'text',	
			), 
		  
		   
		   array (
				'key'   		=> 'footer_column1',
				'label' 		=> __( 'tieu de 1', 'htz' ),
				'name'  		=> 'footer_column1',
				'type'  		=> 'text',	
			), 
		  	array (
				'key'   		=> 'footer_column2',
				'label' 		=> __( 'tieu de 2', 'htz' ),
				'name'  		=> 'footer_column2',
				'type'  		=> 'text',	
			), 
			array (
				'key'   		=> 'footer_column3',
				'label' 		=> __( 'tieu de 3', 'htz' ),
				'name'  		=> 'footer_column3',
				'type'  		=> 'text',	
			), 
		  	 array (
				'key'   		=> 'footer_facebook',
				'label' 		=> __( 'Fanpage', 'htz' ),
				'name'  		=> 'footer_facebook',
				'type'  		=> 'text',	
			), 
		  
		    array (
				'key'   		=> 'footer_youtube',
				'label' 		=> __( 'Kênh youtube', 'htz' ),
				'name'  		=> 'footer_youtube',
				'type'  		=> 'text',	
			), 
		  
		  
		   array (
				'key'   		=> 'footer_twiter',
				'label' 		=> __( 'Twiter', 'htz' ),
				'name'  		=> 'footer_twiter',
				'type'  		=> 'text',	
			), 
		   array (
				'key'   		=> 'footer_intagram',
				'label' 		=> __( 'Intergram', 'htz' ),
				'name'  		=> 'footer_intagram',
				'type'  		=> 'text',	
			), 

			/*===============================================*/
			
			
		),
		'location' => array (
			array (
				array (
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'customizer',
				),
			),
		),
	));
}