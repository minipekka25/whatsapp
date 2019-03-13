<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;
$layout = isset($lapa_loop['loop_layout']) ? $lapa_loop['loop_layout'] : 'grid';
$style = isset($lapa_loop['loop_style']) ? $lapa_loop['loop_style'] : 1;
$thumbnail_size = !empty($lapa_loop['image_size']) ? $lapa_loop['image_size'] : 'thumbnail';
$title_tag = !empty($lapa_loop['title_tag']) ? $lapa_loop['title_tag'] : 'h3';
$show_excerpt = (isset($lapa_loop['excerpt_length']) && 0 < absint($lapa_loop['excerpt_length'])) ? true : false;

$post_class = array('loop-item', 'grid-item', 'blog_item');
$post_class[] = ($show_excerpt ? 'show' : 'hide') . '-excerpt';
if (!has_post_thumbnail()) {
    $post_class[] = 'no-featured-image';
}

?>
<article <?php post_class($post_class); ?>>
    <div class="blog_item--inner item-inner">
        <div class="blog_item--inner2 item-inner-wrap">
            <?php
            if (($layout == 'grid' && $style == '4') || $layout == 'list' && $style == '2') {
                ?>
                <div class="thumb-overlay la-lazyload-image" data-background-image="<?php
                    if(has_post_thumbnail()){
                        echo Lapa()->images()->get_post_thumbnail_url(get_the_ID(), $thumbnail_size);
                    }
                ?>"></div>
                <?php
            }
            else{
                if (has_post_thumbnail()){
                    ?>
                    <div class="blog_item--thumbnail blog_item--thumbnail-with-effect">
                        <a href="<?php the_permalink(); ?>">
                            <?php Lapa()->images()->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                            <span class="pf-icon pf-icon-link"></span>
                            <div class="item--overlay"></div>
                        </a>
                    </div>
            <?php
                }
            }
            ?>
            <div class="blog_item--info clearfix">
                <?php lapa_entry_meta_item_category_list('<div class="blog_item--category-link">', '</div>', ''); ?>
                <div class="blog_item--info2">
                    <div class="blog_item--title entry-header">
                        <?php the_title(sprintf('<%s class="entry-title"><a href="%s">', $title_tag, esc_url(get_the_permalink())), sprintf('</a></%s>', $title_tag)); ?>
                    </div>
                    <div class="blog_item--meta entry-meta clearfix"><?php
                        lapa_entry_meta_item_author();
                        lapa_entry_meta_item_postdate();
                    ?></div><!-- .entry-meta -->
                    <?php if ($show_excerpt): ?>
                        <div class="blog_item--excerpt entry-excerpt"><?php the_excerpt(); ?></div>
                    <?php endif; ?>
                    <div class="blog_item--meta-footer clearfix">
                        <?php
                        if ($layout == 'grid' && $style == '2') {
                            ?>
                            <div class="la-sharing-posts">
                                <span><i class="fa fa-share-alt"></i></span>
                                <?php lapa_social_sharing(get_the_permalink(), get_the_title(), (has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '')); ?>
                            </div>
                            <?php
                            lapa_get_favorite_link();
                            lapa_entry_meta_item_comment_post_link_with_icon();
                        }
                        else{
                            $readmore_class = 'btn btn-readmore';
                            if ($layout == 'grid' && $style == '4') {
                                $readmore_class = 'btn-readmore';
                            }
                            printf(
                                '<a class="%3$s" href="%1$s">%2$s</a>',
                                get_the_permalink(),
                                esc_html_x('Read more', 'front-view', 'lapa'),
                                esc_attr($readmore_class)
                            );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>