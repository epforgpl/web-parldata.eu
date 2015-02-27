<?php
global $pakb_settings; 
$i    = 0;
$skip = TRUE;
$page_link = get_page_link();

if (isset($pakb_settings['columns'])) {
    $columns = $pakb_settings['columns'];
} else {
    $columns = 2;
}
?>

<?php pakb_search(); ?>

<div class="knowledgebase-main">

    <?php
    foreach(pakb_get_cats() as $cat){
        pakb_setup_cat($cat);
        if(!pakb_subcat_have_posts())
            continue;
    ?>

		<?php
		if($i++%$columns==0 && $skip){
		    ?>
		    <div class="knowledgebase-row clearfix">
		    <?php
		}
		$skip = TRUE;
		?>

	    	<?php
	        
	        pakb_print_the_cat();
	        ?>

		<?php
		if($i%$columns==0){
		    echo '</div>';
		}
		?>

    <?php
    }
    ?>

	<?php
	if($i%$columns!=0){
	    echo "</div>";
	} 
	?>
	    
</div>


    
