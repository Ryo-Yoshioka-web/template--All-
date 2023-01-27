<!-- 個別記事ページ -->

<?php get_header(); ?>
<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- ---------------------------ループ文の開始--------------------------- -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
                <!-- アイキャッチ -->
                <div class="">
                    <img src="<?php the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute('echo=0'))); ?>" />
                </div>
                <!-- 投稿日 -->
                <p class="">
                    <time datetime="<?php the_time('Y-m-d'); ?>">
                        <?php the_time('Y年m月d日'); ?>
                    </time>
                </p>
                <!-- カテゴリー名 -->
                <div class="">
                    <?php
                    $category = get_the_category();
                    echo '<span class="' . $category->slug . '">' . $category[0]->name . '</span>';
                    ?>
                </div>
                <!-- タイトル -->
                <h2 class="">
                    <?php the_title(); ?>
                </h2>
                <!-- 本文(全文) -->
                <div class="">
                    <?php the_content(); ?>
                </div>
            </article>
    <?php endwhile;
    endif; ?>
</main>
<?php get_footer(); ?>