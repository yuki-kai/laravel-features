# laravel-features
PHP/LaravelやJavaScriptの開発で使えそうな機能をまとめた

# 環境構築
`cp .env.example .env`
`docker compose exec app composer install`


## 一覧画面の機能全般
1. 検索
2. ページネーション<br>
    参考記事<br>
    https://biz.addisteria.com/laravel8_pagination/
3. ソート<br>
    参考記事<br>
    https://qiita.com/apprentice123/items/ac0645f79d877a0bd33d<br>
    https://qiita.com/haserror/items/e7daeae404b675f739e1
4. 更新・削除時の状態を保持してリダイレクト<br>
5. 省略された文章の表示・非表示切り替え<br>

## 画像・動画登録の機能
1. ajaxの非同期通信
2. ファイル名とパスを指定した保存
3. アップロードをパーセンテージで見える化
4. ファイル名重複時の自動ファイル名変換
5. サムネイル自動生成
6. もっと見るで追加表示

