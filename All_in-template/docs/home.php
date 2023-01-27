<!-- 記事一覧ページ -->

<?php get_header(); ?>

<main class="main">
    <?php
    // 　------------------------------------スマホとPCでの表記変更 開始--------------------------------------------------------- 
    if (wp_is_mobile()) {
        $num = 3; // スマホの表示数(全件は-1)
    } else {
        $num = 5; // PCの表示数(全件は-1)
    }
    // ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓サブループ　開始　書かなくてもよい↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
    // $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    // $args = [
    //     'post_type' => 'post', // 投稿タイプのスラッグ(通常投稿なので'post')
    //     'paged' => $paged, // ページネーションがある場合に必要
    //     'posts_per_page' => $num, // 表示件数 
    // ];
    // $wp_query = new WP_Query($args);
    // ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑サブループ　終了　↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
    // 　------------------------------------スマホとPCでの表記変更　終了--------------------------------------------------------- 
    if (have_posts()) : while (have_posts()) : the_post();
    ?>
            <!-- ループ内（ここから） -->
            <article <?php post_class(''); ?>>
                <h3 class=""><?php the_title(); ?></h3><!-- タイトルを出力 -->
                <p class=""><?php echo get_the_date(); ?></p><!-- 日付を出力　ex 'Y/m/d'→ 2022/10/04 https://www.communitycom.jp/2012/09/23/time-date/-->
                <div class="">
                    <!-- 抜粋を出力 -->
                    <?php the_excerpt(); ?>
                    <p class=""><a href="<?php the_permalink(); ?>">続きを読む</a></p>
                </div>

            </article>

            <!-- ループ内（ここまで） -->
        <?php endwhile; ?>
    <?php else : ?>
        <p>まだ記事がありません</p>
    <?php endif ?>
    <?php wp_reset_postdata(); ?>
    <!-- 記事のループ処理終了 -->
    <!-- ページネーション -->
    <div class="">
        <?php
        the_posts_pagination(array(
            'mid_size' => 1,
            'prev_text' => '前へ',
            'next_text' => '次へ'
        ));
        ?>
    </div>
</main>
<?php get_footer(); ?>