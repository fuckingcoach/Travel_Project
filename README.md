# TravelGuide 旅遊導覽網站

TravelGuide 是一套以 Laravel 開發的台灣旅遊導覽網站，整合景點資訊、地方美食、會員收藏及後台管理功能。前台採用響應式設計，並以暖奶油色、勃艮第紅與紙張顆粒打造復古文藝風格。

## 專案特色

- 首頁景點圖片輪播，自動讀取 `public/images/views`，最多顯示 20 張圖片
- 景點列表、分類篩選與景點詳細資訊
- 串接農業部開放資料，呈現台灣地方特色美食
- 會員註冊、登入、個人資料與密碼管理
- 景點收藏清單與收藏狀態查詢
- 管理員登入及權限驗證
- 後台景點、分類、圖片及會員資料管理
- RESTful API，供前端非同步存取資料
- 支援桌面、平板與手機版面

## 視覺設計

前台使用 Vintage Artsy 復古文藝風格：

- 暖奶油色背景：`#F5F0E8`
- 深勃艮第紅主色：`#6F263D`
- 亞麻色輔色：`#B79B75`
- Hero 圖片具暖色濾鏡、暗角及膠卷顆粒效果
- 卡片使用紙張質感、細框線與非對稱錯位排列

主要主題樣式位於 `public/css/front/vintage.css`。

## 技術架構

| 類別 | 技術 |
| --- | --- |
| 後端框架 | PHP 8.3、Laravel 13 |
| 資料庫 | SQLite |
| 前端 | Blade、HTML5、CSS3、Bootstrap 5 |
| 互動功能 | JavaScript、jQuery、Vue 3、Axios |
| 圖片輪播 | Swiper 11 |
| 身分驗證 | Laravel Auth、Sanctum |
| 驗證碼 | mews/captcha |
| 測試 | PHPUnit 12 |

## 主要功能

### 前台

| 頁面 | 路徑 | 功能 |
| --- | --- | --- |
| 首頁 | `/` | Hero 輪播、熱門景點與特色美食 |
| 景點列表 | `/views` | 瀏覽及篩選景點 |
| 景點詳細頁 | `/views/{id}` | 顯示景點介紹、地址、圖片與收藏功能 |
| 美食列表 | `/travelfood` | 顯示農業部開放資料中的地方美食 |
| 美食詳細頁 | `/travelfood/{id}` | 顯示美食詳細資訊 |
| 關於本站 | `/about` | 網站介紹 |
| 會員登入 | `/member/login` | 會員登入 |
| 會員註冊 | `/member/register` | 建立會員帳號 |
| 會員中心 | `/member/home` | 管理個人資料及收藏內容 |

### 後台

| 功能 | 路徑 |
| --- | --- |
| 管理員登入 | `/admin` |
| 管理首頁 | `/admin/home` |
| 景點管理 | `/admin/views/list` |
| 新增景點 | `/admin/views/add` |
| 景點分類管理 | `/admin/viewstype` |
| 會員管理 | `/admin/member/list` |

除登入頁外，後台功能均由 `manager` middleware 保護。

## 資料表

| 資料表 | 用途 | 主要欄位 |
| --- | --- | --- |
| `views` | 景點資料 | `name`、`city`、`town`、`address`、`typeId`、`brief`、`content`、`tel`、`like` |
| `views_types` | 景點分類 | `typeName` |
| `imgs` | 景點圖片 | `viewsId`、`imgSrc` |
| `members` | 前台會員 | `memberName`、`email`、`pwd`、`tel`、`address`、`birthday`、`avatar`、`status` |
| `member_wishlists` | 會員收藏 | `memberId`、`viewsId` |
| `manager` | 後台管理員 | `userName`、`pwd` |
| `users` | Laravel 使用者 | `name`、`email`、`password` |
| `personal_access_tokens` | Sanctum Token | Token 名稱、權限及有效期限 |

專案另包含 Laravel 預設的 session、cache、queue 與 password reset 資料表。

## API

API 預設以 `/api` 為前綴。

### 景點

| 方法 | 端點 | 說明 |
| --- | --- | --- |
| GET | `/api/views` | 取得景點列表 |
| GET | `/api/views10` | 取得熱門景點 |
| GET | `/api/views&types` | 取得景點及分類資料 |
| GET | `/api/views/{id}` | 取得單一景點 |
| POST | `/api/views` | 新增景點 |
| PUT | `/api/views/{id}` | 更新完整景點資料 |
| PATCH | `/api/views/patch/{id}` | 更新部分景點資料 |
| DELETE | `/api/views/{id}` | 刪除景點 |

### 分類與圖片

| 資源 | 支援操作 |
| --- | --- |
| `/api/viewstype` | 查詢、新增、更新、刪除景點分類 |
| `/api/imgs` | 查詢、新增、更新、刪除景點圖片 |

### 會員與收藏

| 方法 | 端點 | 說明 |
| --- | --- | --- |
| GET | `/api/member/profile` | 取得目前會員資料 |
| POST | `/api/member/update` | 更新會員資料 |
| GET | `/api/member/checkEmail` | 檢查電子郵件 |
| POST | `/api/member/updatePwd` | 更新密碼 |
| GET | `/api/wishlist/list` | 取得收藏清單 |
| POST | `/api/wishlist/add` | 新增收藏 |
| DELETE | `/api/wishlist/delete` | 移除收藏 |
| GET | `/api/wishlist/checkLiked` | 檢查收藏狀態 |
| GET | `/api/wishlist/getLikes` | 取得收藏統計 |

### 美食

| 方法 | 端點 | 說明 |
| --- | --- | --- |
| GET | `/api/travelfoods` | 取得地方美食列表 |
| GET | `/api/travelfoods/{id}` | 取得單筆美食資料 |

## 安裝方式

### 環境需求

- PHP 8.3 以上
- Composer
- PHP SQLite 擴充套件

### 1. 安裝相依套件

```powershell
composer install
```

### 2. 建立環境設定

如果預設的.env環境設定檔不能使用，請從.env.example複製：
```powershell
Copy-Item .env.example .env
php artisan key:generate
```

預設使用 SQLite。如資料庫檔案尚未建立：

```powershell
New-Item database/database.sqlite -ItemType File
```

### 3. 建立資料表及測試資料

```powershell
php artisan migrate --seed
```

若要重新建立所有資料：

```powershell
php artisan migrate:fresh --seed
```

此操作會清除目前資料庫內容，請勿在含有正式資料的環境執行。
並載入範例資料表：
database/seeders/DatabaseSeeder.php
database/seeders/ManagerSeeder.php
database/seeders/MemberSeeder.php
database/seeders/WishlistSeeder.php

### 4. 啟動專案

使用 Composer 開發指令：

```powershell
composer run dev
```

或直接啟動 Laravel：

```powershell
php artisan serve
```

開啟瀏覽器前往：

```text
http://127.0.0.1:8000
```

若使用 Laravel Herd，可直接透過 Herd 設定的本機網域開啟專案。

## 圖片管理

- 網站 Logo：`public/images/logo.png`
- 景點原圖：`public/images/views/`
- 景點縮圖：`public/images/views/S/`
- 會員頭像：`public/images/member/`

首頁輪播會依檔名自然排序，自動選取 `public/images/views/` 根目錄內前 20 張 JPG、JPEG、PNG 或 WebP 圖片，不會讀取 `S` 子資料夾。

## 常用指令

```powershell
# 執行測試
php artisan test

# 清除 Laravel 快取
php artisan optimize:clear

# 自動格式化 PHP 程式碼
vendor/bin/pint
```

## 專案目錄

```text
app/
├── Http/Controllers/    # 前台、後台及 API 控制器
└── Models/              # Eloquent Models
database/
├── migrations/          # 資料表結構
└── seeders/             # 測試與初始資料
public/
├── css/                 # 前後台樣式
├── images/              # Logo、景點圖片及會員頭像
└── js/                  # 前端 JavaScript
resources/views/
├── front/               # 前台 Blade 頁面
└── admin/               # 後台 Blade 頁面
routes/
├── front/               # 前台路由
├── admin/               # 後台路由
└── api/                 # API 路由
```

## 外部資料來源

地方特色美食資料取自農業部開放資料平台的「農村地方美食小吃特色料理」資料集。首頁與美食頁載入時需要可用的網路連線；若外部服務暫時無法使用，相關美食內容可能為空。

## 授權

本專案以 Laravel 框架為基礎開發。Laravel 採用 [MIT License](https://opensource.org/licenses/MIT) 授權。
