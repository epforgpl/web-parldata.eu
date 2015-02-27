<?php pakb_search(); ?>
<?php
 //   $i=1;
    while(pakb_have_posts()) : pakb_the_post();
?>
    <article id="kb-<?php pakb_the_ID(); ?>" class="knowledgebase-archive"><a href="<?php pakb_the_permalink(); ?>"><i class="<?php echo knowledgebase_icon(); ?>"></i> <?php pakb_the_title(); ?></a></article>
<?php
    endwhile;
?>

