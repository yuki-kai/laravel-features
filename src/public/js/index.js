$(function() {

    let user_id;

    // 削除ボタンを押したらユーザーIDを取得
    $('#deleteModal').on('shown.bs.modal', function(e) {
        user_id = e.relatedTarget.id;
    });

    // 削除モーダルのOKボタンを押したら
    $('#deleteSubmit').on('click', function(e) {
        const form = document.getElementById('delete_form');
        form.action = '/delete/user/' + user_id;
        console.log(form)
        form.submit();
    });

});
