<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="single_post">
            <div class="wrapper">
                <div class="single_post_header">
                    <h5> <?php the_title(); ?></h5>
                </div>
                <div class="container">
                    <div class="main_post">
                        <?php echo the_post_thumbnail(); ?>
                        <h5> <?php the_title(); ?></h5>
                        <?php the_content(); ?>
                        <?php echo get_the_date(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php get_footer(); ?>