<?php

// ここでfuncフォルダーのそれぞれの機能を読み込んでいる（重くならないためと見やすいように）

require_once get_theme_file_path('/func/base.php'); //基本の設定

require_once get_theme_file_path('/func/styles.php'); //styleシートの読み込み系

require_once get_theme_file_path('/func/setting.php'); //管理画面の設定

require_once get_theme_file_path('/func/ogp.php'); //ogpの設定

// require_once get_theme_file_path('/func/custom.php'); //カスタム投稿自作の設定

// require_once get_theme_file_path('/func/img.php'); //カスタム投稿自作の設定
