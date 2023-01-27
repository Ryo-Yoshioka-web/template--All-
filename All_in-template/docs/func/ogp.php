<?php

/*********************
メタタグ＆OGPタグ設定
 *********************/
function set_meta_ogp()
{
    global $post;
    $insert = '';
    $ogp_url = '';
    $ogp_img = 'urlを記載（サムネイル画像として）';
    $ogp_description = '';
    $ogp_title = '';


    if (is_front_page() || is_home()) {
        // トップページ
        $my_descr = get_option('home_description');
        $ogp_description = $my_descr ? $my_descr : get_bloginfo('description');
        $insert .= '<meta name="description" content="' . esc_attr($ogp_description) . '" />' . "\n";
        // $insert .= '<meta name="keywords" content="' . esc_attr($ogp_description) . '" />' . "\n";
        // $catchy = (get_bloginfo('description')) ? get_bloginfo('description') . '｜' : ""; //キャッチフレーズ
        $ogp_title = get_bloginfo('name');
        $ogp_url = home_url();
    } elseif (is_singular()) {
        // 記事＆固定ページ
        setup_postdata($post);
        $ogp_title = $post->post_title;
        $ogp_description = mb_substr(get_the_excerpt(), 0, 100);
        $ogp_url = get_permalink();


        if (get_post_meta($post->ID, 'description', true)) {
            //投稿ページでデスクリプションが入力されている場合
            $descr = get_post_meta($post->ID, 'description', true);
            $insert .= '<meta name="description" content="' . esc_attr($descr) . '" />' . "\n";
        } else {
            setup_postdata($post);
            $descr = get_the_excerpt();
            wp_reset_postdata();
            $insert .= '<meta name="description" content="' . esc_attr($descr) . '" />' . "\n";
        }
        if (get_post_meta($post->ID, 'keywords', true)) {
            //投稿ページでキーワードが入力されている場合
            $insert .= '<meta name="keywords" content="' . esc_attr(get_post_meta($post->ID, 'keywords', true)) . '" />' . "\n";
        } else {
            $insert .= '<meta name="keywords" content="' . esc_attr($post->post_title) . '" />' . "\n";
        }
    } elseif (is_category()) {
        //カテゴリーページ
        $cats = get_the_category();
        if (!empty($cats['category_description'])) {
            $descr = esc_attr($cats['category_description']);
            $insert .= '<meta name="description" content="' . $descr . '" />' . "\n";
        } else {
            //カテゴリーページで本文が入力されていない場合はog:descriptionに以下の文を出力
            $descr = get_bloginfo('name') . 'の「' . single_cat_title('', false) . '」についての投稿一覧です。';
            $insert .= '<meta name="description" content="' . esc_attr($descr) . '" />' . "\n";
        }
        $insert .= '<meta name="keywords" content="' . single_cat_title('', false) . '" />' . "\n";
        $ogp_title = $descr;
        $ogp_description = mb_substr(get_the_excerpt(), 0, 100);
        $ogp_url = get_category_link($cats[0]->cat_ID);
    }


    // og:image
    if (is_singular() && has_post_thumbnail()) {
        $ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $ogp_img = $ps_thumb[0];
    }


    // og:type
    $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';


    //出力するOGPタグをまとめる
    $insert .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
    $insert .= '<meta property="og:description" content="' . esc_attr($ogp_description) . '" />' . "\n";
    $insert .= '<meta property="og:type" content="' . $ogp_type . '" />' . "\n";
    $insert .= '<meta property="og:url" content="' . esc_url($ogp_url) . '" />' . "\n";
    $insert .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
    $insert .= '<meta property="og:image" content="' . esc_url($ogp_img) . '" />' . "\n";
    // TwitterのOGPタグ
    $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    $insert .= '<meta name="twitter:site" content="@">' . "\n";
    $insert .= ' <meta name="twitter:description" content="' . esc_attr($ogp_description) . '" />' . "\n";
    $insert .= '<meta name="twitter:image" content="' . esc_url($ogp_img) . '" />' . "\n";
    //facebookのappdid
    if (get_option('fb_app_id')) {
        $insert .= '<meta property="fb:app_id" content="' . get_option('fb_app_id') . '">';
    }


    echo $insert;
}


add_action('wp_head', 'set_meta_ogp');



// タイトルの区切り文字を変更
function my_document_title_separator($separator)
{
    $separator = '|';
    return $separator;
}
add_filter('document_title_separator', 'my_document_title_separator');

// 固定ページで抜粋を使用できるようにする
add_post_type_support('page', 'excerpt');
remove_filter('the_excerpt', 'wpautop');
remove_filter('term_description', 'wpautop');

// head区間の中に、ページの形式ごとに適切なmeta descriptionが出力されるようにする これを有効化した場合は20行目を消す
// 固定ページでは抜粋がディスクリプションになる。

/*
if( is_home() || is_front_page() ): ?>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php elseif( is_category() ): ?>
    <meta name="description" content="<?php echo category_description(); ?>">
    <?php elseif( is_tag() ): ?>
    <meta name="description" content="<?php echo tag_description(); ?>">
    <?php elseif( is_singular() ): ?>
    <meta name="description" content="<?php echo get_the_excerpt(); ?>">
    <?php endif; ?>
*/