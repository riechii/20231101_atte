# Atte
勤怠管理アプリです。会員登録することで勤怠情報を記録できます。
また、日付別に勤怠の記録を閲覧することができます。
![Atte_top](https://github.com/riechii/20231101_atte/blob/main/Atte_top.png)
## 作成した目的
laravel学習のために制作しました。成果物の機能やイメージをいただきそれに沿って作成しました。
## 機能一覧
・会員登録機能(名前、メールアドレス、パスワード、確認用パスワード)

・メール認証機能(会員登録後メールが送られてきます。)

・ログイン(メールアドレス、パスワードで認証)

・ログアウト

・打刻機能

　出勤、退勤、休憩開始、休憩終了

　(出勤、退勤は1日に1度まで。休憩は1日に何度も取れる仕様になっています。)

・日付別勤怠記録の表示

・ユーザー一覧ページ

・ユーザー毎の月別勤怠記録の表示
## 使用技術(実行環境)
・laravel 8.83.27

・mysql 10.3.39

・PHP 7.4.9
## テーブル設計
![Atte_table](https://github.com/riechii/20231101_atte/blob/main/Atte_table.png)
## ER図
![Atte_ER](https://github.com/riechii/20231101_atte/blob/main/Atte_ER.png)
## 環境構築
①laravelプロジェクトを実行したいディレクトリに移動

②$ git clone git@github.com:riechii/20231101_atte.git .

③.evnの作成　$ cp .env.sample .env

④Dockerのコンテナに入る $ docker-compose exec php bash

⑤composerをインストール　$ composer install

⑥$ ls でartisanディレクトリがあることを確認

⑦APP_KEYを作成　$ php artisan key:generate

⑧.envの設定を変える

DB_HOST=DBコンテナのサービス名、 DB_DATABASE、DB_USERNAME、DB_PASSWORD、docker-compose.ymlで作成したデータベース名、ユーザ名、パスワードを記述

⑨localhost:80（Nginxコンテナのポートを80にした場合）にアクセスすると表示されます。
## aws
18.177.213.207

awsではバックエンドをEC2、データベースをRDS(Mysql)、ストレージをS3で作成しております。
ストレージをS3にしているのですが、今回画像保存などの必要がないので設定のみしております。
