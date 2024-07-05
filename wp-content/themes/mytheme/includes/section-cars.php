<?php if( have_posts() ): while( have_posts() ): the_post();?>

    <?php the_content();?>


    <?php
    $tags = get_the_tags();
    foreach($tags as $tag):?>

        <a class="badge bg-success" href="<?php echo get_tag_link($tag->term_id);?>">
            <?php echo $tag->name;?>
        </a>

    <?php endforeach;?>

    <?php
    $categories = get_the_category();
    if($tags):
    foreach($categories as $cat):?>
        
        <a class="badge bg-success" href="<?php echo get_category_link($cat->term_id);?>">
            <?php echo $cat->name;?>
        </a>
        
    <?php endforeach; endif; ?>

    

<?php endwhile; else: endif;?>