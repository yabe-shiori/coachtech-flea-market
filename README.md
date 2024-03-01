# coachtechフリマ


# 概要
このアプリは、ユーザーが商品を出品し、他のユーザーが商品を購入することができるオンラインマーケットプレイスを提供します。　　
ユーザーはアカウントを作成し、商品の出品、購入、メッセージのやり取りなどの機能を利用することができます。



![トップ画像](https://github.com/yabe-shiori/coachtech-flea-market/assets/142664073/02abf2d8-da9f-4411-ba1c-0634021b3c7e)



## 主な機能　　
- 会員登録・ログイン
- 商品出品:ユーザーは新しい商品を出品することができます。商品の説明、価格、写真などを含めることができます。
- 商品検索:ユーザーは商品名やカテゴリ名、ブランド名などを使用して商品を検索することができます。
- 商品購入:ユーザーは興味のある商品を購入することができます。購入手続きは安全に行われます。
- お気に入り登録:お気に入りの商品を保存して、マイリストから確認できます。
- コメント機能:ユーザーと出品者との間でコメントのやり取りが可能です。質問や交渉などの目的で利用できます。
- ポイント機能:ログイン時や商品購入時にポイントが獲得でき、購入時に使用することができます。
- フォロー機能:フォローしたユーザーの出品している商品が確認できます。
- 管理者機能:管理者専用のダッシュボードで、管理者の作成、商品一覧の確認、出品者への送金額の確認、お知らせメールの送信が行えます。
- 
- 
- 

<br />

## インストール

### 1.プロジェクトのクローン  
git clone https://github.com/yabe-shiori/

  
### 2. プロジェクトディレクトリに移動    
`cd coachtech-flea-market`  

### 3. Composerパッケージのインストール
`composer install`  


### 4. 環境変数の設定
.env.exampleファイルをコピーして.envファイルを作成し、必要な環境変数を設定します。  
`cp .env.example .env`  

DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=coachtech_flea_market
DB_USERNAME=sail  
DB_PASSWORD=password  


### 5. Docker環境のセットアップ
laravelSailを使用してDocker環境をセットアップします。  
`./vendor/bin/sail up -d`  

  

### 6. アプリケーションキーの生成
`./vendor/bin/sail artisan key:generate`  

  
  
### 7. NPMパッケージのインストール
`./vendor/bin/sail npm install`  

  

### 8. データベースのセットアップと初期データの投入 
`./vendor/bin/sail artisan migrate:refresh --seed `  

  
### 9. アセットのコンパイル  
`./vendor/bin/sail npm run dev`  

  

### 10. アプリケーションの実行
・Webブラウザで[http://localhost](http://localhost)にアクセスして、アプリケーションが正しく動作していることを確認します。  


<br />  

## 注意事項: 

**利用者について**  
  
- メールアドレス-> user@example.com
- パスワード-> password
を入力して、ログインしてください。

 
**管理者について** 

/admin/loginにアクセスして管理者用のログイン画面を表示します。  
- メールアドレス-> amdmin@example.com
- パスワード ->  password
を入力し、ログイン。
管理者用のダッシュボード画面からメニューを選択してください。


  
**メール通知について**  
MailPitを利用しています。  
[http://localhost:8025](http://localhost:8025)にアクセスして通知メールを確認してください。  


<br />

## 使用技術

| Category          | Technology Stack                                     |
| ----------------- | --------------------------------------------------   |
| Frontend          | npm, Tailwind CSS                                    |
| Infrastructure    | Amazon Web Services                                  |
| Backend           | Laravel, PHP                                         |
| Infrastructure    | Amazon Web Services                                  |
| Database          | MySQL                                                |
| Environment setup | Docker, Laravel Sail                                 |
| etc.              | Git, GitHub                                          |

<br />

## AWS構成図

![AWS構成図]()

<br />

## ER図

<img width="913" alt="スクリーンショット 2024-02-29 151945" src="https://github.com/yabe-shiori/coachtech-flea-market/assets/142664073/0793a421-39e1-4c68-9cd6-6a60cc232a62">

<br />


