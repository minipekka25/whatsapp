<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $lapa_loop;
$index              = !empty($lapa_loop['special_index']) ? absint($lapa_loop['special_index']) : 0;
$thumbnail_size     = !empty($lapa_loop['image_size']) ? $lapa_loop['image_size'] : 'thumbnail';
$thumbnail_size2     = !empty($lapa_loop['image_size2']) ? $lapa_loop['image_size2'] : 'thumbnail';
$title_tag      = !empty($lapa_loop['title_tag']) ? $lapa_loop['title_tag'] : 'h3';
$show_excerpt   = ( isset($lapa_loop['excerpt_length']) && 0 < absint($lapa_loop['excerpt_length']) ) ? true : false;

$post_class     = array('loop-item', 'blog_item');
$post_class[]   = ( $show_excerpt ? 'show' : 'hide' ) .  '-excerpt';


$index++;
$lapa_loop['special_index'] = $index;
if($index > 1){
    $thumbnail_size = $thumbnail_size2;
}


?>
<article <?php post_class($post_class); ?>>
    <div class="blog_item--inner item-inner">
        <div class="blog_item--inner2 item-inner-wrap">
            <?php if(has_post_thumbnail()): ?>
                <div class="blog_item--thumbnail blog_item--thumbnail-with-effect">
                    <a href="<?php the_permalink();?>">
                        <?php Lapa()->images()->the_post_thumbnail(get_the_ID(), $thumbnail_size); ?>
                        <span class="pf-icon pf-icon-link"></span>
                        <div class="item--overlay"></div>
                    </a>
                </div>
            <?php endif; ?>
            <div class="blog_item--info clearfix">
                <?php
                lapa_entry_meta_item_category_list('<div class="blog_item--category-link">','</div>','');
                ?>
                <header class="blog_item--title entry-header">
                    <?php the_title( sprintf( '<%s class="entry-title"><a href="%s">',$title_tag, esc_url( get_the_permalink() ) ), sprintf('</a></%s>', $title_tag) ); ?>
                </header>
                <div class="blog_item--meta entry-meta clearfix"><?php
                    lapa_entry_meta_item_author();
                    lapa_entry_meta_item_postdate();
                    ?></div><!-- .entry-meta -->
                <?php if($show_excerpt): ?>
                    <div class="blog_item--excerpt entry-excerpt"><?php the_excerpt(); ?></div>
                <?php endif; ?>

                    <?php if($index == 1) : ?>
                    <footer class="blog_item--meta-footer clearfix">
                        <a class="btn btn-readmore" href="<?php the_permalink();?>"><?php echo esc_html_x('Read more', 'front-view', 'lapa'); ?></a>
                    </footer>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</article>
<?php if( $index == 1 ): ?>
    </div>
    <div class="blog-special-right col-xs-12 col-sm-6">
<?php endif; ?>