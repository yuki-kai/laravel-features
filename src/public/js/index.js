$(function() {

    let user_id;

    // 削除ボタンを押したらユーザーIDを取得
    $('#deleteModal').on('shown.bs.modal', function(e) {
        user_id = e.relatedTarget.id;
    });

    // 削除モーダルのOKボタンを押したら
    $('#deleteSubmit').on('click', function() {
        // 二重送信を防止
        $(this).prop('disabled', true);
        const form = document.getElementById('delete_form');
        form.action = '/delete/user/' + user_id;
        form.submit();
    });

});
