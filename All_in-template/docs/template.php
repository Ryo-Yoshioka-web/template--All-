<!-- 使う関数のまとめ-->

<!-- アーカイブ（一覧）ページでのメインループの例 -->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <!-- ループ内（ここから） -->
        <div class="">
            <h3 class=""><?php the_title(); ?></h3><!-- タイトルを出力 -->
            <p class=""><?php echo get_the_date(); ?></p><!-- 日付を出力 -->
            <div class="">
                <!-- 抜粋を出力 -->
                <?php the_excerpt(); ?>
                <p><a href="<?php the_permalink(); ?>">続きを読む</a></p>
            </div>
        </div>
        <!-- ループ内（ここまで） -->
    <?php endwhile; ?>
<?php else : ?>
    　<p>投稿がありません。</p>　　//投稿がない場合

<?php endif; ?>



<?php
// 固定ページに特定のカテゴリーを表示
$args = array(
    'post_type' => 'post', //もしくはこの中にカスタム投稿名（新しいループを作成したとき）
    'category_name' => 'news',
    'posts_per_page' => 3, // 表示件数　-1ならすべての投稿を取得
    'order' => 'DESC', // 降順(日付の場合、日付が新しい順)
    // 'meta_key' => '',        // カスタムフィールドのキーを指定 絞り込み可能
    // 'meta_value' => '',    // カスタムフィールドの値を指定 絞り込み可能v
);
$the_query = new WP_Query($args);
if ($the_query->have_posts()) :
?>

    <ul>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <li><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php endwhile; ?>
    </ul>
<?php endif;
wp_reset_postdata(); ?>


<!-- 固定ページに出力するための関数  https://www.nishi2002.com/30365.html -->
<?php
/*
template name:
*/
get_header();
?>
<main class=""></main>
<?php get_footer(); ?>


<!--　固定ページのリンク　〇〇にパーマリンクを入力 -->
<?php echo esc_url(home_url('/')); ?>〇〇
<?php bloginfo('url'); ?>

<!-- 画像へのパス -->
<?php echo esc_url(get_theme_file_uri('img/')); ?>

<!-- ホームに戻るとき用のリンク -->
<?php echo　esc_url(home_url()); ?>




<!-- is_mobileがtureの時はスマホ、falseの時はタブレットとPC -->
<?php
if (is_mobile()) {
    //スマホの時
} else {
    //タブレット・PCの時
}
?>

<!-- サムネイルがあったらサムネイル出力する ループ分の中に入れる　（）の中はadd_image_sizeで作成した名前を入れる。-->　
<?php if (has_post_thumbnail()) : ?>
    <?php the_post_thumbnail(); ?>
<?php else : ?>
    <img src="<?php echo esc_url(get_theme_file_uri('img/')); ?>" alt="">
<?php endif; ?>

<!-- ページネーションをパーツ化しているので、template-parts/parts-pagination.phpに格納している。　クラス名のところにクラス名を埋める -->
<?php get_template_part('template-parts/parts', 'pagination'); ?>



<!-- 条件分岐するための関数　ex ページによって画像を変更したい時など -->
<!-- トップページ -->
<?php if (is_front_page()) { ?>
    <!-- html -->
    <!-- 固定ページ -->
<?php } elseif (is_page('url')) { ?>
    <!-- html -->
<?php } else {
} ?>


<!-- 現在表示されている固定ページのIDを取得 -->
<?php
$page_id = get_the_ID();
echo $page_id;
?>

<!--テスト関数 -->
<pre>
<?php var_dump($wp_query); ?>
</pre>

<!-- 配列でまわすための関数 -->

<?php

$arr = array('じゃがいも', 'ニンジン', '玉ねぎ', 'ブロッコリー');

foreach ($prefecture as $key) {
    if ($key == $strUserAddress1) {
        echo "<option value='$key' selected='selected'>$key</option>";
    } else {
        echo "<option value='$key'>$key</option>";
    }
}
