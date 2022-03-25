# よく使うコマンドのまとめ

## docker系
#### コンテナ起動
`docker-compose up -d`

#### コンテナに入る
docker psでコンテナ確認<br>
`docker-compose exec コンテナ名 bash`


## git系
#### ローカルブランチの削除
`git branch --delete ブランチ名`

#### リモートブランチの削除
`git push --delete origin ブランチ名`


## MVC作成
#### コントローラーの作成
`php artisan make:controller hogeController`

#### モデルの作成
`php artisan make:model Hoge`


## Seeder/Factoryのテストデータ作成
#### sedder file作成
`php artisan make:seeder hogeSeeder`

#### seeder全て実行
`php artisan db:seed --class=DatabaseSeeder`

#### seeder単体実行
`php artisan db:seed --class=hogeSeeder`


## キャッシュクリア系
#### env変更後のキャッシュクリア
`php artisan cache:clear`

#### env変更後のコンフィグクリア
`php artisan config:cache`
