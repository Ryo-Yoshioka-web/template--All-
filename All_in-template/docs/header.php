<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="thumbnail" content="URL" />
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <!-- ここにheadタグの中身を入れる -->
    <!-- タイトルタグに関してはadd_theme_support(); を使ってタイトルタグを出力することが推奨さえているため、functions.phpで記載 -->
    <!--  -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>><?php wp_body_open(); ?>
    <header>
        <!-- ここにheaderの中身を記載 -->
    </header>