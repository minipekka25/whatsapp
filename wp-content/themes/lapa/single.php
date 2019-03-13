<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header();
do_action( 'lapa/action/before_render_main' );

$enable_related = Lapa()->settings()->get('blog_related_posts', 'off');
$related_style = Lapa()->settings()->get('blog_related_design', 1);
$max_related = (int) Lapa()->settings()->get('blog_related_max_post', 1);
$related_by = Lapa()->settings()->get('blog_related_by', 'category');

$single_post_thumbnail_size = Lapa_Helper::get_image_size_from_string(Lapa()->settings()->get('single_post_thumbnail_size', 'full'), 'full');
?>

<div id="main" class="site-main">
    <div class="container">
        <div class="row">
            <main id="site-content" class="<?php echo esc_attr(Lapa()->layout()->get_main_content_css_class('col-xs-12 site-content'))?>">
                <div class="site-content-inner">

                    <?php do_action( 'lapa/action/before_render_main_inner' );?>

                    <div class="page-content">

                        <div class="single-post-detail clearfix">
                            <?php

                            do_action( 'lapa/action/before_render_main_content' );

                            if( have_posts() ):  the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post-content'); ?>>

                                    <?php
                                        if(Lapa()->settings()->get('blog_post_title') != 'above' && Lapa()->settings()->get('blog_post_title') != 'below'){
                                            the_title( '<header class="entry-header single_post_item--title hidden"><h1 class="entry-title h2">', '</h1></header>' );
                                        }
                                    ?>

                                    <?php
                                    if('above' == Lapa()->settings()->get('blog_post_title')){
                                        the_title( '<header class="entry-header single_post_item--title"><h1 class="entry-title h2">', '</h1></header>' );
                                    }
                                    ?>
                                    <?php
                                        if(Lapa()->settings()->get('featured_images_single') == 'on'){
                                            lapa_single_post_thumbnail($single_post_thumbnail_size);
                                        }
                                    ?>
                                    <?php lapa_entry_meta_item_category_list('<div class="blog_item--category-link single_post_item--category-link">', '</div>', ''); ?>
                                    <?php
                                        if('below' == Lapa()->settings()->get('blog_post_title') ){
                                            the_title( '<header class="entry-header single_post_item--title"><h1 class="entry-title h2">', '</h1></header>' );
                                        }
                                    ?>

                                    <div class="single_post_item--meta blog_item--meta entry-meta clearfix"><?php
                                        lapa_entry_meta_item_author();
                                        lapa_entry_meta_item_postdate();
                                    ?></div><!-- .entry-meta -->

                                    <div class="entry-content">
                                        <?php

                                        the_content();

                                        wp_link_pages( array(
                                            'before'      => '<div class="clearfix"></div><div class="page-links"><span class="page-links-title">' . esc_html_x( 'Pages:', 'front-view', 'lapa' ) . '</span>',
                                            'after'       => '</div>',
                                            'link_before' => '<span>',
                                            'link_after'  => '</span>',
                                            'pagelink'    => '<span class="screen-reader-text">' . esc_html_x( 'Page', 'front-view', 'lapa' ) . ' </span>%',
                                            'separator'   => '<span class="screen-reader-text">, </span>',
                                        ) );
                                        ?>
                                    </div><!-- .entry-content -->
                                    <div class="clearfix"></div>
                                    <footer class="entry-footer text-color-secondary clearfix">
                                        <?php the_tags('<div class="entry-meta-footer"><div class="tags-list"><span><i class="fa fa-tags"></i></span><span class="tags-list-item">' ,', ','</span></div></div>') ;?>

                                        <?php
                                        if(Lapa()->settings()->get('blog_social_sharing_box') == 'on'){
                                            echo '<div class="la-sharing-single-posts">';
                                            echo sprintf('<span>%s <i class="fa fa-share-alt"></i></span>', esc_html_x('Share this post', 'front-view', 'lapa') );
                                            lapa_social_sharing(get_the_permalink(), get_the_title(), (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : ''));
                                            echo '</div>';
                                        }
                                        ?>

                                        <?php edit_post_link( null, '<span class="edit-link hidden">', '</span>' ); ?>
                                    </footer><!-- .entry-footer -->

                                </article><!-- #post-## -->

                                <div class="clearfix"></div>

                                <?php

                                if(Lapa()->settings()->get('blog_pn_nav') == 'on'){
                                    the_post_navigation( array(
                                        'next_text' => '<span class="post-title">%title</span><span class="meta-nav" aria-hidden="true">' . esc_html_x( 'Next post', 'front-view', 'lapa' ) . '</span> ',
                                        'prev_text' => '<span class="post-title">%title</span><span class="meta-nav" aria-hidden="true">' . esc_html_x( 'Previous post', 'front-view', 'lapa' ) . '</span>'
                                    ) );
                                    echo '<div class="clearfix"></div>';
                                }


                                if(Lapa()->settings()->get('blog_author_info') == 'on'){
                                    get_template_part( 'author-bio' );
                                    echo '<div class="clearfix"></div>';
                                }

                                if(Lapa()->settings()->get('blog_comments') == 'on' && ( comments_open() || get_comments_number() ) ){
                                    comments_template();
                                    echo '<div class="clearfix"></div>';
                                }

                                ?>

                        <?php endif; ?>

                            <?php

                            do_action( 'lapa/action/after_render_main_content' );

                            wp_reset_postdata();

                            ?>

                        </div>

                    </div>

                    <?php do_action( 'lapa/action/after_render_main_inner' );?>
                </div>
            </main>
            <!-- #site-content -->
            <?php get_sidebar();?>

            <?php if($enable_related == 'on'): ?>
            <div class="row">
                <?php
                    wp_reset_postdata();
                    $related_args = array(
                        'posts_per_page' => $max_related,
                        'post__not_in' => array( get_the_ID() )
                    );
                    if($related_by == 'random'){
                        $related_args['orderby'] = 'rand';
                    }
                    if($related_by == 'category'){
                        $cats = wp_get_post_terms( get_the_ID(), 'category' );
                        if ( is_array( $cats ) && isset( $cats[0] ) && is_object( $cats[0] ) ) {
                            $related_args['category__in'] = array($cats[0]->term_id);
                        }
                    }
                    if($related_by == 'tag'){
                        $tags = wp_get_post_terms( get_the_ID(), 'tag' );
                        if ( is_array( $tags ) && isset( $tags[0] ) && is_object( $tags[0] ) ) {
                            $related_args['tag__in'] = array($tags[0]->term_id);
                        }
                    }
                    if($related_by == 'both'){
                        $cats = wp_get_post_terms( get_the_ID(), 'category' );
                        if ( is_array( $cats ) && isset( $cats[0] ) && is_object( $cats[0] ) ) {
                            $related_args['category__in'] = array($cats[0]->term_id);
                        }
                        $tags = wp_get_post_terms( get_the_ID(), 'tag' );
                        if ( is_array( $tags ) && isset( $tags[0] ) && is_object( $tags[0] ) ) {
                            $related_args['tag__in'] = array($tags[0]->term_id);
                        }
                    }

                    $related_query = new WP_Query($related_args);

                    if($related_query->have_posts()){

                        ?>
                        <div class="clearfix"></div>
                        <div class="custom-product-wrap related">
                            <div class="row block_heading text-center">
                                <div class="col-xs-12">
                                    <h3 class="block_heading--title h2"><?php echo esc_html_x('Related Post', 'front-view', 'lapa') ?></h3>
                                    <div class="block_heading--subtitle"></div>
                                </div>
                            </div>
                        </div>
                        <div class="la-related-posts la-loop showposts-loop grid-3 showposts-grid grid-items xlg-grid-3-items lg-grid-3-items md-grid-3-items sm-grid-2-items xs-grid-1-items mb-grid-1-items">
                            <?php
                            while($related_query->have_posts()) {
                                $related_query->the_post();
                                $title_tag = 'h3';
                                $post_class   = array('loop-item','grid-item','blog_item', 'hide-excerpt');
                                ?>
                                <div <?php post_class($post_class); ?>>
                                    <div class="blog_item--inner item-inner">
                                        <div class="blog_item--inner2 item-inner-wrap">
                                            <?php if(has_post_thumbnail()): ?>
                                                <div class="blog_item--thumbnail blog_item--thumbnail-with-effect">
                                                    <a href="<?php the_permalink();?>">
                                                        <?php Lapa()->images()->the_post_thumbnail(get_the_ID(), array(370,280)); ?>
                                                        <span class="pf-icon pf-icon-link"></span>
                                                        <div class="item--overlay"></div>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="blog_item--info clearfix">
                                                <?php lapa_entry_meta_item_category_list('<div class="blog_item--category-link">', '</div>', ''); ?>
                                                <div class="blog_item--info2">
                                                    <div class="blog_item--title entry-header">
                                                        <?php the_title(sprintf('<%s class="entry-title h5"><a href="%s">', $title_tag, esc_url(get_the_permalink())), sprintf('</a></%s>', $title_tag)); ?>
                                                    </div>
                                                    <div class="blog_item--meta entry-meta clearfix"><?php
                                                        lapa_entry_meta_item_author();
                                                        lapa_entry_meta_item_postdate();
                                                        ?></div><!-- .entry-meta -->
                                                    <div class="blog_item--excerpt entry-excerpt"><?php the_excerpt(); ?></div>
                                                    <div class="blog_item--meta-footer clearfix">
                                                        <?php
                                                        $readmore_class = 'btn btn-readmore';
                                                        printf(
                                                            '<a class="%3$s" href="%1$s">%2$s</a>',
                                                            get_the_permalink(),
                                                            esc_html_x('Read more', 'front-view', 'lapa'),
                                                            esc_attr($readmore_class)
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>
                        </div>
                        <?php
                    }

                    wp_reset_postdata();
                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- .site-main -->
<?php do_action( 'lapa/action/after_render_main' ); ?>
<?php get_footer();?>
