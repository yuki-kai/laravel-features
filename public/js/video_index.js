
// もっと見るの処理
let show = 10; // 最初に表示する件数
let add = 10;  // 「もっと見る」で表示したい件数
let contents = '.list li'; // 対象のlist
$(contents + ':nth-child(n + ' + (show + 1) + ')').addClass('is-hidden');
$('.more-show').on('click', function () {
$(contents + '.is-hidden').slice(0, add).removeClass('is-hidden');
    if ($(contents + '.is-hidden').length == 0) {
        $('.more-show').fadeOut();
    }
});


