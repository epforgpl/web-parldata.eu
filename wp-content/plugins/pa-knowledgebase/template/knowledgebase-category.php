<?php
global $pakb_settings; 

if (isset($pakb_settings['columns'])) {
    $columns = $pakb_settings['columns'];
} else {
    $columns = 2;
}
?>
<div class="knowledgebase-columns-<?php echo $columns; ?>">
    <h2><i class="pakb-icon-folder-empty"></i><a href="<?php pakb_the_catLink(); ?>"><?php pakb_the_catName(); ?> <?php if(pakb_is_catCount_enable()): ?> (<?php pakb_the_catCount(); ?>) <?php endif; ?></a></h2>
    <ul>
        <?php
        while(pakb_subcat_have_posts()) {
            pakb_subcat_the_post();
            ?>
            <li><i class="<?php echo pakb_icon(); ?>"></i> <a href="<?php pakb_subcat_the_permalink(); ?>"><?php pakb_subcat_the_title(); ?></a></li>
            <?php
        }
        ?>
    </ul>
</div>