# Atte
勤怠管理アプリです。会員登録することで勤怠情報を記録できます。
また、日付別に勤怠の記録を閲覧することができます。
![Atte_top](https://github.com/riechii/20231101_atte/blob/main/Atte_top.png)
## 作成した目的
laravel学習のために制作しました。要件定義や成果物の機能、イメージをいただきそれに沿って作成しました。
## 機能一覧
・会員登録機能(名前、メールアドレス、パスワード、確認用パスワード)
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
