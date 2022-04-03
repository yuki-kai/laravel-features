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

#### リモートリポジトリのファイルをgit管理から外す
`git rm --cached 削除したいファイル`

#### リモートリポジトリのブランチをローカルにクローン
`git branch -r`
`git checkout -b develop origin/develop`


## MySQL系
#### rootユーザーでログイン
`mysql -u root -p`

#### データベース作成
`CREATE DATABASE データベース名;`

## MVC作成
#### コントローラーの作成
`php artisan make:controller HogeController`

#### モデルの作成
`php artisan make:model Hoge`

#### マイグレーションの作成
`php artisan make:migration create_テーブル名(hoges)_table`

#### マイグレーションのやり直し (テストデータも作成)
`php artisan migrate:fresh --seed`



## Seeder/Factoryのテストデータ作成
#### seeder作成
`php artisan make:seeder HogeSeeder`

#### seeder全て実行
`php artisan db:seed --class=DatabaseSeeder`

#### seeder単体実行
`php artisan db:seed --class=HogeSeeder`

#### factory作成
`php artisan make:factory HogeFactory`



## キャッシュクリア系
#### env変更後のキャッシュクリア
`php artisan cache:clear`

#### env変更後のコンフィグクリア
`php artisan config:cache`
