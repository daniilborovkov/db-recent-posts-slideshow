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
        'meta_query'     => array(
            array(
                'key' => '_thumbnail_id',
            ),
        ),
    ));

    $txt = '';

    $txt .= '<section id="slid__section" class="def">
    <section class="slide-container">

        <div class="arrow" id="ar1" onclick="clickLeft()">❮</div>';

    foreach ($query->posts as $key => $post):
        $display = $key === 0 ? 'flex' : 'none';

        $txt .= '<div class="slide" style="display: ' . $display . ';">
                  <div class="img_div">';

        $txt .= get_the_post_thumbnail($post->ID, array('390', '250'));

        $txt .= '</div>
                  <div class="slide-text" style="padding-top: 3%; font-size: 14px;">';

        $txt .= $post->post_title;

        $txt .= '
                    <br>
                    <br>';

        $txt .= '<a href="' . get_permalink($post->ID) . '" class="sl_btn" s="">' . __('Подробнее') . '</a></div>
                </div>';
    endforeach;

    $txt .= '<div class="arrow" id="ar2" onclick="clickRight()">❯</div>';

    $txt .= '</section></section>';

    $txt .= '<center><a class="sl_btn" href="' . get_permalink(get_option('page_for_posts')) . '"> ' . get_the_title(get_option('page_for_posts')) . '</a></center>';

    return $txt;
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('db-recent-posts-slideshow-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), date('Y'), true);
    wp_enqueue_style('db-recent-posts-slideshow-style', plugin_dir_url(__FILE__) . 'slideshow-style.css', array(), date('Y'));
});
