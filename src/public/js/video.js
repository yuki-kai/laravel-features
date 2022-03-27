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
