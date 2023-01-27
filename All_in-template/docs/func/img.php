<!-- 写真のカスタムフィールドを作る -->

<?php

add_action('admin_menu', 'create_custom_fields');
function create_custom_fields()
{
    add_meta_box(
        'sample_setting', //編集画面セクションのHTML ID
        'サンプルカスタムフィールド', //編集画面セクションのタイトル
        'insert_custom_fields', //編集画面セクションにHTML出力する関数
        'page', //投稿タイプ名(postにすると、デフォルトである投稿に追加)
        'normal' //編集画面セクションが表示される部分
    );
}

function insert_custom_fields()
{
    global $post;
    $sampleMedia = get_post_meta($post->ID, 'sampleMedia', true); ?>

    <form method="post" action="admin.php?page=site_settings">
        <div id="media">
            <img src="<?php echo $sampleMedia; ?>" alt="">
        </div>
        <input style="width:0;height:0;padding:0;margin:0;visibility:hidden" name="sampleMedia" type="text" value="<?php echo $sampleMedia ?>" />
        <input style="width:80px" type="button" name="media" value="画像選択" />
        <input style="width:80px" type="button" name="media-clear" value="削除" />
    </form>

    <script>
        (function($) {
            var custom_uploader;
            //メディアアップローダーボタン 
            $("input:button[name=media]").click(function(e) {
                e.preventDefault();
                if (custom_uploader) {
                    custom_uploader.open();
                    return;
                }
                custom_uploader = wp.media({
                    title: "画像を選択", //タイトルのテキストラベル
                    button: {
                        text: "画像を設定" //ボタンのテキストラベル
                    },
                    library: {
                        type: "image" //imageにしておく。
                    },
                    multiple: false //選択できる画像を1つだけにする。
                });
                custom_uploader.on("select", function() {
                    var images = custom_uploader.state().get("selection");
                    /* file の中に選択された画像の各種情報が入っている */
                    images.each(function(file) {
                        $("input:text[name=sampleMedia]").val(""); //テキストフォームをクリア
                        $("#media").empty(); //id mediaタグの中身をクリア
                        $("input:text[name=sampleMedia]").val(file.attributes.url); //テキストフォームに選択したURLを追加
                        $("#media").append('<img src="' + file.attributes.url + '" />'); //プレビュー用にメディアアップローダーで選択した画像を表示させる
                    });
                });
                custom_uploader.open();
            });
            //クリアボタンを押した時の処理
            $("input:button[name=media-clear]").click(function() {
                $("input:text[name=sampleMedia]").val(""); //テキストフォームをクリア
                $("#media").empty(); //id mediaタグの中身をクリア
            });
        })(jQuery);
    </script>

<?php
} ?>

<?php
function save_custom_img_fields($post_id)
{
    if (isset($_POST['sampleMedia'])) {
        update_post_meta($post_id, 'sampleMedia', $_POST['sampleMedia']);
    }
}
add_action('save_post', 'save_custom_img_fields');
