<?php
/**
 * Plugin Name:     Db Recent Posts Slideshow
 * Plugin URI:      https://daniilborovkov.site/db-recent-posts-slideshow
 * Description:     Recent posts shortcode output
 * Author:          Daniil Borovkov
 * Author URI:      https://daniilborovkov.site
 * Text Domain:     db-recent-posts-slideshow
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Db_Recent_Posts_Slideshow
 */
add_action('init', function () {
    add_shortcode('db-recent-posts', 'db_recent_posts_slideshow');
});

function db_recent_posts_slideshow($atts)
{
    $query = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'order'          => 'DESC',
        'meta_query' => array( 
            array(
                'key' => '_thumbnail_id'
            ) 
        )
    ));
    ?>

  <section id="slid__section" class="def">
    <section class="slide-container">

        <div class="arrow" id="ar1" onclick="clickLeft()">❮</div>

        <?php foreach ($query->posts as $key => $post): ?>

          <div class="slide" style="display: <?php $key === 0 ? 'flex' : 'none'; ?>;">
            <div class="img_div">
              <?php echo get_the_post_thumbnail( $post->ID, array('390', '250') ); ?>
            </div>
            <div class="slide-text" style="padding-top: 3%; font-size: 14px;">
              <?php echo $post->post_title; ?>
              <br>
              <br>
              <a href="<?php echo get_permalink( $post->ID ); ?>" class="sl_btn" s=""><?php echo __('Подробнее') ?></a></div>
          </div>
        <?php endforeach; ?>

        <div class="arrow" id="ar2" onclick="clickRight()">❯</div>

  </section>

  <?php
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('db-recent-posts-slideshow-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), date('Y'), true);
    wp_enqueue_style('db-recent-posts-slideshow-style', plugin_dir_url(__FILE__) . 'slideshow-style.css', array(), date('Y'));
});