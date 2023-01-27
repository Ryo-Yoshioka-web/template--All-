<?php

//  /の後にパスを入力！！　　　cssやJsの読み込み
function my_script_init()
{ // WordPressに含まれているjquery.jsを読み込まない
    wp_deregister_script('jquery');
    // jQueryとJavascript読み込み
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.1.min.js', "", "1.0.1", true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.1', true);
    // google fontsの読み込み
    wp_enqueue_style(
        'googlefonts',
        'fontのURL',
        array(),
        '1.0.0'
    );
    // cssの読み込み
    wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css', array(), '1.0.1');
    wp_enqueue_style('style-css', get_template_directory_uri() . '/', array(), '1.0.1');
}
add_action('wp_enqueue_scripts', 'my_script_init');


// CDNを読み込むために必要なフック

// wp_enqueue_script(
//     'jquery',
//     'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js',
//     array(),
//     '3.4.1',
//     true //</body> 終了タグの前で読み込み
// );
// wp_enqueue_script(
//     'slick',
//     'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
//     array(),
//     true //</body> 終了タグの前で読み込み
// );


// 特定のページで読み込ませたいとき　この場合フロントページになる　 https://wpdocs.osdn.jp/%E6%9D%A1%E4%BB%B6%E5%88%86%E5%B2%90%E3%82%BF%E3%82%B0
// function add_styles()
// {
//     if (is_front_page()) {
//         wp_enqueue_style('front-css', get_template_directory_uri() . 'css/front-style.css');
//     }
// }
// add_action('wp_enqueue_scripts', 'add_styles');



// トップページのディスクリプションを空文字にして、失くす
function custom_title_text($results)
{
    if (is_front_page()) {
        $results['tagline'] = '';
    }
    return $results;
}
add_filter('document_title_parts', 'custom_title_text', 11);
