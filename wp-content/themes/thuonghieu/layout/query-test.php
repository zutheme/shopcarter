 <?php
$curentid = get_the_ID();
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
$category = get_category($category_id);
$count = $category->category_count;
$listid = array();
for ($i = $curentid; $i < ($curentid + 4); $i++) { 
 	if($i < $count){
 		$listid[] = $i;
 	}
 }
 $args = array(
'post_type' => 'post',
'category__in' => array($cat_id),
'post__in' => $listid,
);                                                                           
$team_query = new WP_Query($args);