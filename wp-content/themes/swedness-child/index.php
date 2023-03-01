<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header(); ?>
<div class="wrapper">
    
    <div class="blog_header">
        <h3>Blogs</h3>
        <p>All the lates blogs</p>
    </div>
    <div class="container">
        <div class="blog_aside">
            <div class="main_blogs">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <article>
                            <div class="blog_image">
                                <?php echo the_post_thumbnail(); ?>
                            </div>
                            <div class="blog_content">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <div class="post-meta">
                                    <span class="post-date"><?php echo get_the_date(); ?></span>
                                    <span class="post-author"><?php the_author_posts_link(); ?></span>
                                </div>
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </article>

                    <?php endwhile;
                else : ?>

                    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>

                <?php endif; ?>

            </div>
            <div class="blog_sidebar">
                <!-- blog_sidebar -->
                <ul>
                    <?php
                    $args = array(
                        'orderby' => 'name',
                        'show_count' => true,
                        'hierarchical' => true,
                        'depth' => 1
                    );
                    wp_list_categories($args);
                    ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<?php

get_footer();
?>