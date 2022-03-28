$(function() {

    // BOM
    const BOM  = new Uint8Array([0xEF, 0xBB, 0xBF]);

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


    const save = () => {
        console.log('download処理');
        workCsvData = [];
        // ユーザー情報作成
        // createUserArray();
        // ファイル保存
        download();
    };

    // const createUserArray = () => {
    //     createHeaderArray();
    //     createBodyArray();
    // };

    // const createHeaderArray = () => {
    // };

    // const createBodyArray = () => {
    //     const body = document.querySelectorAll('tbody > tr > td.name');
    //     console.log(body)
    //     console.log(body[0].innerHTML)
    // };


    // ファイル保存
    const download = () => {
        // CSVデータ整形
        let csvString = createCsvString();
        let blob = new Blob([BOM, csvString], {type: 'text/csv'});

        // ダウンロード
        const a = document.createElement('a');
        a.download = createFileName();
        a.href = (window.URL || window.webkitURL).createObjectURL(blob);;
        a.click();
    };

    // ファイル名を生成 「ユーザー一覧_YYYY年MM月DD日」の形式で取得
    const createFileName = () => {
        const today = new Date();
        const month = ('00' + (today.getMonth() + 1)).slice(-2);
        const date  = ('00' + (today.getDate() + 1)).slice(-2);
        return `ユーザー一覧_${today.getFullYear()}年${month}月${date}日`;
    };

    // CSV用配列から文字列に変換
    const createCsvString = () => {
        let csvString = workCsvData;
        console.log(csvString);
        return csvString;
    };

    $('#output_file').on('click', function() {
        // console.log('download処理');
        // if () { // バリデーション
        save();
        // }
    });

    // 省略されている長文をクリックで表示・非表示に切り替え
    const msg = document.getElementsByName('msg')
    for (let i = 0; i < msg.length; i++) {
        msg[i].addEventListener('dblclick', (e) => {
            if (msg[i].id === e.target.id){
                msg[i].classList.toggle('omitted');
            }
        });
    }

});
