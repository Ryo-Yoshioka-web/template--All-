<?php

function setup_my_theme()
{
    // タイトルを出力
    add_theme_support('title-tag');
    //  アイキャッチ画像の有効化
    add_theme_support('post-thumbnails');
    // デバイスの解像度ごとに表示する画像サイズを無効化する
    add_filter('wp_calculate_image_srcset_meta', '__return_null');
    // 　画像のサイズを指定　 php the_post_thumbnail( '名前' );　でサイズの画像を出力
    // add_image_size('名前', 50, 50, true);
    // html5による出力をしたい
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
        'caption',
    ));
    //YouTubeなどの埋め込みコンテンツをレスポンシブ対応
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'setup_my_theme');


// 　投稿記事が一定期間内（一週間以内）に投稿されたらNEWと出す
function my_add_new_to_title($title)
{
    if (in_the_loop() && !is_singular()) {
        if (date('U') - get_the_time('U') < 60 * 60 * 24 * 7) {
            $title .= ' <span class="new_entry">New</span>';
        }
    }
    return $title;
}
add_filter('the_title', 'my_add_new_to_title');



// 抜粋の文字数を30文字
function change_my_excerpt_mblength($length)
{
    return 30;
}
add_filter('excerpt_mblength', 'change_my_excerpt_mblength');


/* メインクエリのカスタマイズでトップページの記事一覧の表示件数を5件に設定 　表示から設定を行うとアーカイブページにも反映されるため*/
function custom_main_query($query)
{
    if (is_admin() || !$query->is_main_query()) :
        return;
    endif;
    if ($query->is_home()) :
        $query->set('posts_per_page', 5);
    endif;
}
add_action('pre_get_posts', 'custom_main_query');
