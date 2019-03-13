<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$post_class             = array('loop-item','grid-item', 'blog_item');

?>
<article <?php post_class($post_class); ?>>
    <div class="blog_item--inner item-inner">
        <div class="blog_item--inner2 item-inner-wrap">
            <div class="blog_item--info clearfix">
                <header class="blog_item--title entry-header">
                    <?php the_title( sprintf( '<h5 class="entry-title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h5>' ); ?>
                </header>
                <div class="blog_item--meta entry-meta clearfix"><?php
                    lapa_entry_meta_item_author();
                    lapa_entry_meta_item_postdate();
                ?></div><!-- .entry-meta -->
                <div class="blog_item--excerpt entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <footer class="blog_item--meta-footer clearfix">
                    <a class="btn btn-readmore" href="<?php the_permalink();?>"><?php echo esc_html_x('Read more', 'front-view', 'lapa'); ?></a>
                </footer>
            </div>
        </div>
    </div>
</article>