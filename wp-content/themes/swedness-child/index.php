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
        <div class="row">
            <div class="col-lg-8">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="blog_left_sidebar">
                            <article class="blog_style1">
                                <div class="blog_img">
                                    <?php echo the_post_thumbnail(); ?>
                                </div>
                                <div class="blog_text">
                                    <div class="blog_text_inner">
                                        <a class="cat" href="#">Gadgets</a>
                                        <a href="<?php the_permalink(); ?>">
                                            <h4><?php the_title(); ?></h4>
                                        </a>
                                        <?php the_excerpt(); ?>
                                        <div class="date">
                                            <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date(); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                    <?php endwhile;
                else : ?>

                    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>

                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- <aside class="single_sidebar_widget search_widget">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Posts">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div>
                        <div class="br"></div>
                    </aside> -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Post Catgories</h4>
                        <ul class="list cat-list">
                        <?php
                        $categories = get_categories();

                        foreach ($categories as $category):
                            ?>
                            <li>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="d-flex justify-content-between">
                                    <p><?php echo esc_html( $category->name ); ?></p>
                                    <p><?php echo esc_html( $category->count ); ?></p>
                                </a>
                            </li>
                           <?php endforeach; ?>
                        </ul>
                        <div class="br"></div>
                    </aside>
                    <!-- <aside class="single-sidebar-widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            <li><a href="#">Technology</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Architecture</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Technology</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Art</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Adventure</a></li>
                        </ul>
                    </aside> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
?>