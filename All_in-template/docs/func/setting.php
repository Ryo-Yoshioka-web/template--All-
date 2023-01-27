<?php

// ブログやお知らせを公開する際に確認ボックスを表示させる機能
$c_message = '記事を公開していいですか？';
function confirm_publish()
{

    global $c_message;
    echo '<script type="text/javascript"><!--
var publish = document.getElementById("publish");
if (publish !== null) publish.onclick = function(){
return confirm("' . $c_message . '");
};
// --></script>';
}
add_action('admin_footer', 'confirm_publish');




// 管理バーの非表示
// add_filter('show_admin_bar', '__return_false');



// ナビゲーションメニューの登録　名前のところに表示名を登録
function register_my_menus()
{
    register_nav_menus(array( //複数のナビゲーションメニューを登録する関数
        //'「メニューの位置」の識別子' => 'メニューの説明の文字列',
        'main-menu' => '名前',
        'footer-menu'  => '名前',
    ));
}
add_action('after_setup_theme', 'register_my_menus');



// 投稿者のアーカイブページを無効にする
add_filter('author_rewrite_rules', '__return_empty_array');



/* スマホだけに対応　初期設定だとスマホ、タブレット・PCに分けられるため、ここでスマホだけの対応に変更する */
function is_mobile()
{
    $useragents = array(
        'iPhone',          // iPhone
        'iPod',            // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream',           // Pre 1.5 Android
        'CUPCAKE',         // 1.5+ Android
        'blackberry9500',  // Storm
        'blackberry9530',  // Storm
        'blackberry9520',  // Storm v2
        'blackberry9550',  // Storm v2
        'blackberry9800',  // Torch
        'webOS',           // Palm Pre Experimental
        'incognito',       // Other iPhone browser
        'webmate'          // Other iPhone browser
    );
    $pattern = '/' . implode('|', $useragents) . '/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

// 表側の管理画面のブロックエディターを表示画面と同じにする。
add_action('after_setup_theme', 'custom_theme_setup');
function custom_theme_setup()
{
    /* ブロックエディタ用のcssを有効化 */
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    // 指定のファイルを読み込むため、1つ目に投稿個別ページや固定ページのスタイルが書かれたCSSファイル　
    add_editor_style(array('style.css', 'editor-style.css'));
    // /* head内にフィードリンクを出力 */
    // add_theme_support('automatic-feed-links');

    // ブロックベースのウィジェットを無効化
    // remove_theme_support('widgets-block-editor');
}

//、管理画面の全画面でedirot-style.cssを読み込みます
add_action('admin_print_scripts', function ($hook_suffix) {
    // CSSディレクトリの設定
    $uri = get_template_directory_uri() . "/css/editor-style.css";
    // CSSファイルの読み込み
    wp_enqueue_style("smart-style", $uri, array(), wp_get_theme()->get('Version'));
});



// 絵文字を削除する　読み込みスピードを早くするため
remove_action('wp_head', 'print_emoji_detection_script', 7);

remove_action('wp_print_styles', 'print_emoji_styles');

remove_filter('comment_text_rss', 'wp_staticize_emoji');

remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

remove_action('admin_print_styles', 'print_emoji_styles');

remove_filter('the_content_feed', 'wp_staticize_emoji');

remove_action('admin_print_scripts', 'print_emoji_detection_script');


//  固定ページのブロックエディターを非表示にする
// add_filter('use_block_editor_for_post',function($use_block_editor,$post){
//     if($post->post_type==='page'){
//         if(in_array($post->post_name,['slug'])){
//             remove_post_type_support('page','editor');
//             return false;
//         }
//     }
//     return $use_block_editor;
// },10,2);



// /* メンテナンス表示 */
// function maintenance_mode()
// {
// 	if (!current_user_can('edit_themes') || !is_user_logged_in()) {
// 		wp_die('ただいまメンテナンス中です。');
// 	}
// }
// add_action('get_header', 'maintenance_mode');


// ファビコン指定 img/にfavicon.jpgで画像を入れる
add_filter('get_site_icon_url', 'my_site_icon_url');

function my_site_icon_url($url)
{
    return get_theme_file_uri('img/favicon.jpg');
}


// 管理画面の投稿・固定ページ一覧にIDを表示
// function manage_posts_columns_id( $columns ) {
// 	$columns['wps_post_id'] = 'ID';
// 	return $columns;
// }

// function add_column_id( $column_name, $post_id ) {
// 	if( $column_name == 'wps_post_id' ) {
// 		echo $post_id;
// 	}
// }
// 投稿一覧
// add_filter( 'manage_posts_columns', 'manage_posts_columns_id', 5 );
// add_action( 'manage_posts_custom_column', 'add_column_id', 5, 2 );
// 固定ページ一覧
// add_filter( 'manage_pages_columns', 'manage_posts_columns_id', 5 );
// add_action( 'manage_pages_custom_column', 'add_column_id', 5, 2 );


// SVGをアップロード可能に
function enable_svg($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'enable_svg');



// ログイン画面のロゴを変更する ◯◯にパスを入れる
// function custom_login_logo()
// {
//     echo '<style type="text/css">h1 a { background: url(' . get_bloginfo('template_directory') . '/img/◯◯) no-repeat center center !important; }</style>';
// }
// add_action('login_head', 'custom_login_logo');


//ログイン画面の背景をつける
/*
function login_custom() { ?>

    <style>
        .login {
        background: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/background.jpg) no-repeat center center;
        background-size: cover;
        }
    </style>

*/


// 自動でアップロードをさせる。

//本体のメジャーアップデート
// add_filter( 'allow_major_auto_core_updates', '__return_true' );
//本体のマイナーアップデート
// add_filter( 'allow_minor_auto_core_updates', '__return_true' );
//テーマ
// add_filter( 'auto_update_theme', '__return_true' );
//プラグイン
// add_filter( 'auto_update_plugin', '__return_true' );


// 管理画面のfooterを変更
function change_admin_footer()
{
    $echo = 'このwordpressは最高にかっこいい<a href="" >吉岡</a>が作成したので、なにかあれば連絡ください';
    return $echo;
}
add_filter('admin_footer_text', 'change_admin_footer');
