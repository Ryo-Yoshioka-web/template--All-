#　　style.cssのTheme name　や　Description を変更

#　screenshot.pngを作成してstyle.cssと同じ階層に入れる
テーマのサムネイルを変更が可能

#　パーツごとに分ける

# cssやjsなどパスをfunctions.phpに記載する

# setting.phpの名前の所に入力し、「メニューの位置」の識別子を''に入れて　表示したい場所に以下のコードを入れる。
#  テンプレートファイルのメニューを表示したい場所に記述 
<?php
$args = array(
    'theme_location' => 'main-menu',
    'menu_class' => 'ulタグのクラス名',
    'container' => nav,
    'container_class' => 'navタグのクラス名',
);
wp_nav_menu($args);
?>


# wp-configの最後の方に以下を追加する　　一応切ることは忘れない
define( 'WP_DEBUG', true );

if ( WP_DEBUG ) {
  define( 'WP_DEBUG_LOG', true );
  define( 'WP_DEBUG_DISPLAY', false );
  @ini_set( 'display_errors', 0 );
}

#　.htaccessに以下のコードを記述
<Files debug.log>
Order allow,deny
Deny from all
</Files>


# ページの説明　
404.php →　ページが存在しないときに見せるページ
archive-〇〇.php →　カスタム投稿を使った際に見せるページ
footer.php →　footerをパーツ化したモノ
front-page.php → 一番最初に出てくるトップページ
functions.php →　機能などを入力するページではあるが、今回はテンプレート化しておりfuncファイルの中身を読み込んでいる
func/base.php →　基本の設定を入れ込んでいる
func/setting.php →　wordpress管理画面の設定を入れ込んでいる
func/styles.php →　style(css,jsの読み込みを行う)　cssは複数のファイルを読み込ませている
header.php → headerをパーツ化したモノ ここにheadの中身などを入れる（titleやlinkタグなどは除く） header-〇◯.phpを作成して<?php get_header(); ?>の()の中に◯◯を入れることで専用headerできる。
home.php →　このテンプレートにおいてトップページをfront-page.phpで補っているため記事一覧ページ（Wordpressの初期搭載）としている
index.php →　上記と同様でトップページをfront-page.phpで補っているので、このindexはwordpressの初期ファイルとしておいている。
page-〇〇 →　固定ページを表示させるためのモノで、頻繁に更新されないようなページを作成している。そのため、下層ページがある分だけ作成したらよい
page.php →　固定ページ用のテンプレートを作成のため、必要だった場合だけおいておく　こちらの場合は管理画面でページを作る際に必要なモノ　
single-〇〇 →　カスタム投稿個別ページでカスタム投稿で新しいループを作成した際に必要なモノで、〇〇にはslag名を入れる　そのためarchive-〇〇.phpと同じ名前になる
single.php →　記事一覧ページにある個別ページを表示する際のページ
style.css →　自作テーマだと認識させる際に必要なモノ 
template.php →　様々な関数をおいている

# ページの設定　
<!-- 今回はfront-page.php,home.phpがあるため、
固定ページの新規作成でHOME,BLOGの二つを作成。

表示設定で固定ページを選択してHOME,BLOGを登録！ -->

# page-slug→page-id→page.php

