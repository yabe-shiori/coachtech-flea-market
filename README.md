# coachtechフリマ


# 概要
**はじめに**　　



![トップ画像]()


## 主な機能　　
- 会員登録・ログイン
- 
- 
- 
- 
- 
- 
- 
- 
- 
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

 
**管理者について** 

 ログイン画面にて、
- メールアドレス-> amdmin@example.com
- パスワード ->  password
を入力し、ログイン。


  
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

![ER図]()

<br />


