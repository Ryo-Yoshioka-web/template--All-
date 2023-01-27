<!-- カスタム投稿などを自作した場合に書くためのファイル　普段は使わないためfunctions.phpでコメントアウトしている -->
<?php

add_action('init', function () {
    register_post_type('', [
        'label' => '',
        'public' => true,
        'menu_position' => 10,
        'supports' => ['thumbnail', 'title', 'editor', 'page-attributes'],
        'has_archive' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
    register_taxonomy('genre', '', [
        'label' => '制作実績ジャンル',
        'hierarchical' => true,
        'show_in_rest' => true,
    ]);
});


// function cpt_register_works(){
//     $labels = [
//         "singular_name" => "works",
//         "edit_item" => "works",
//     ];
//     $args = [

//     ]
// }










//カスタムフィールドのメタボックスを追加するコード
function add_custom_fields()
{
    add_meta_box(
        'custom_field_01', //セクションのID
        '店舗住所', //セクションのタイトル
        'insert_shop_fields', //フォーム部分を指定する関数
        'page', //投稿タイプの場合は「post」、カスタム投稿タイプの場合は「スラッグ名」、固定ページの場合は「page」
        'normal', //セクションの表示場所
        'high'  //優先度
    );
}
add_action('admin_menu', 'add_custom_fields');

//カスタムフィールドの入力エリア
function insert_shop_fields()
{
    global $post;
    //nounceフィールドの追加
    wp_nonce_field('custom_field_save_meta_box_data', 'custom_field_meta_box_nonce');
    echo '
<table class="custom-fields">
  <tr class="border-top border-bottom">
     <th scope="row">
       <label for="shop_a">店舗A</label>
     </th>
     <td> 
       <input type="text" id="shop_a" name="shop_a" value="' . get_post_meta($post->ID, 'shop_a', true) . '" />
     </td>
   </tr>
   <tr class="border-bottom">
      <th scope="row">
        <label for="shop_b">店舗B</label>
      </th>
      <td> 
        <input type="text" id="shop_b" name="shop_b" value="' . get_post_meta($post->ID, 'shop_b', true) . '" />
      </td>
   </tr>
   <tr class="border-bottom">
   <th scope="row">
     <label for="shop_c">店舗C</label>
   </th>
   <td> 
     <input type="text" id="shop_c" name="shop_c" value="' . get_post_meta($post->ID, 'shop_c', true) . '" />
   </td>
</tr>
</table>
';
}

//カスタムフィールドの値を保存
function save_custom_fields($post_id)
{
    //nonceがセットされているか確認
    if (!isset($_POST['custom_field_meta_box_nonce'])) {
        return;
    }
    //nounceが正しいか検証
    if (!wp_verify_nonce($_POST['custom_field_meta_box_nonce'], 'custom_field_save_meta_box_data')) {
        return;
    }
    if (!empty($_POST['shop_a'])) { //入力済みの場合
        update_post_meta($post_id, 'shop_a', $_POST['shop_a']); //値を保存
    } else { //未入力の場合
        delete_post_meta($post_id, 'shop_a'); //値を削除
    }
    if (!empty($_POST['shop_b'])) { //入力済みの場合
        update_post_meta($post_id, 'shop_b', $_POST['shop_b']); //値を保存
    } else { //未入力の場合
        delete_post_meta($post_id, 'shop_b'); //値を削除
    }
    if (!empty($_POST['shop_c'])) { //入力済みの場合
        update_post_meta($post_id, 'shop_c', $_POST['shop_c']); //値を保存
    } else { //未入力の場合
        delete_post_meta($post_id, 'shop_c'); //値を削除
    }
}
add_action('save_post', 'save_custom_fields');
?>