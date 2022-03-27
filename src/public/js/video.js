// アップロードされた動画のプレビュー
$('#video_upload').on('change', function(e) {
    if ($(this).val() === '') {
        $('#video_preview').attr('src', '');
        $('#video_preview').attr('hidden', true);
    } else {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#video_preview').attr('src', e.target.result);
            $('#video_preview').attr('hidden', false);
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});

// アップロードされたサムネイルのプレビュー
$('#thumb_upload').on('change', function(e) {
    if ($(this).val() === '') {
        $('#thumb_preview').attr('src', '');
        $('#thumb_preview').attr('hidden', true);
    } else {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#thumb_preview').attr('src', e.target.result);
            $('#thumb_preview').attr('hidden', false);
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});

// 動画のプレビューが開始されたら動画の先頭を切り取り、自動サムネイル作成準備
const video_preview = document.querySelector('#video_preview');
video_preview.addEventListener('playing', function () {
    let canvas = document.getElementById('canvas');
    let cCtx = canvas.getContext('2d');
    let video = document.getElementById('video_preview');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    // canvasに関数実行時の動画のフレームを描画
    cCtx.drawImage(video, 0, 0);
}, false);

// 「登録」ボタン押下時のハンドラー
$('#submit').on('click', function() {
    let title_check = titleValidation();
    let video_check = videoValidation();
    console.log(title_check, video_check)
    if (title_check && video_check) {
        console.log('通過')
        confirmModal();
        removeValidation();
    } else {
        console.log('バリデーション失敗')
    }
});

// 動画名のバリデーション
const titleValidation = () => {
    if (!$('#title').val()) {
        $('#title').addClass('validation');
        $('#title').attr('placeholder', '動画タイトルは必須です');
        return false;
    }
    return true;
}

// 動画ファイルのバリデーション
const videoValidation = () => {
    if (!$('#video_upload').val()) {
        $('#video_upload').addClass('validation');
        return false;
    }
    return true;
}

// バリデーションを解除
const removeValidation = () => {
    $('#title').removeClass('validation');
    $('#video_upload').removeClass('validation');
}

// 再入力でバリデーション解除
$('#title').on('click', function() {
    if (this.classList.contains('validation')) {
        $(this).removeClass('validation');
        $(this).attr('placeholder', '');
    }
});

const confirmModal = () => {
    // モーダルを表示
    $('#confirm_modal').modal('show');
    // 入力した値をモーダルに反映させる
    $('#confirm_title').text($('#title').val());
    $('#confirm_video').text($('#video_upload').prop('files')[0].name);
    if ($('#thumb_upload').prop('files')[0]) {
        const thumb = $('#thumb_upload').prop('files')[0].name;
        $('#confirm_thumb').text(thumb);
    } else {
        $('#confirm_thumb').text('未選択');
    }
}
