<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="single_post">
            <div class="wrapper">
                <div class="single_post_header">
                    <h5> <?php the_title(); ?></h5>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="main_blog_details">
                            <?php echo the_post_thumbnail(); ?>
                                <a href="#">
                                    <h4><?php the_title(); ?></h4>
                                </a>
                                <div class="user_details">
                                    <div class="float-left">
                                    <?php echo get_the_category_list( ', ' ); ?>
                                    </div>
                                    <div class="float-right">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5><?php the_author(); ?></h5>
                                                <p><?php echo get_the_date(); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php the_content(); ?>
                            </div>
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

                                        foreach ($categories as $category) :
                                        ?>
                                            <li>
                                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="d-flex justify-content-between">
                                                    <p><?php echo esc_html($category->name); ?></p>
                                                    <p><?php echo esc_html($category->count); ?></p>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="br"></div>
                                </aside>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php get_footer(); ?>