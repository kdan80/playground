<?php
/**
 * Default Page Template
 *
 * This is the default page.php template, modified to exclude the page title.
 */

//get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
            while (have_posts()) :
                the_post();
                ?>
                <div class="page-content">
                    <?php the_content(); ?>
                </div>
                <?php
                // Load comments template if comments are open or if there's at least one comment
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
            endwhile;
        ?>
    </div>
</main>

<?php 
//get_footer(); 
?>
