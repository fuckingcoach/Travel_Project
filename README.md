# Taiwan Travel Website

## 專題簡介

本專題是一個以「台灣旅遊」為主題的旅遊景點資訊平台，使用 Bootstrap 製作 RWD 前端頁面，使用 JavaScript 與 Axios 呼叫 Laravel API，並透過 Laravel Eloquent ORM 與資料庫進行資料管理。

系統提供景點瀏覽、景點分類、關鍵字查詢、景點詳細內容、會員登入、會員資料管理與景點收藏等功能，另外建立後台管理系統，提供景點資料、景點圖片與相關資料的管理，以及 Dashboard 統計資訊與景點排行。

## 使用技術

| 類別     | 技術                                             |
| -------- | ------------------------------------------------ |
| 前端     | HTML、CSS、Bootstrap 5、JavaScript、Axios、Blade |
| 後端     | PHP、Laravel                                     |
| ORM      | Laravel Eloquent                                 |
| API      | Laravel REST API                                 |
| 驗證     | Laravel Auth                                     |
| 資料庫   | SQLite                                           |
| 圖表     | Chart.js                                         |
| 版本管理 | Git、GitHub                                      |
| 開發工具 | VS Code、Figma                                   |

## 系統功能說明

| 頁面或功能   | 說明                                                     | 截圖位置                           |
| ------------ | -------------------------------------------------------- | ---------------------------------- |
| 首頁         | 顯示台灣旅遊主題、網站介紹與景點相關內容。               | `docs/screenshots/home.png`        |
| 景點列表     | 以卡片呈現景點資料，可依景點分類及關鍵字查詢景點。       | `docs/screenshots/views.png`       |
| 景點詳細內容 | 顯示單一景點的圖片、名稱、分類、地址、簡介與詳細介紹。   | `docs/screenshots/view-detail.png` |
| 地方美食     | 利用OpenData抓取全台美食小吃，可分區篩選想找尋的區域美食 | `docs/screenshots/views.png`       |
| 會員登入     | 提供會員登入功能，登入後可使用會員相關功能。             | `docs/screenshots/login.png`       |
| 會員中心     | 顯示會員資料，並提供會員資料修改與密碼修改功能。         | `docs/screenshots/member.png`      |
| 景點收藏     | 使用者可以收藏或取消收藏景點，並在會員中心查看收藏列表。 | `docs/screenshots/wishlist.png`    |
| 後台管理     | 提供管理者管理會員、景點、景點分類與景點圖片等資料。     | `docs/screenshots/admin.png`       |
| Dashboard    | 顯示網站統計資訊與景點排行，協助管理者快速了解網站資料。 | `docs/screenshots/dashboard.png`   |

### 截圖說明

請將實際截圖放在 `docs/screenshots/` 資料夾，建議檔名如下：

| 檔名              | 說明                 |
| ----------------- | -------------------- |
| `home.png`        | 前台首頁             |
| `views.png`       | 景點列表、搜尋與分類 |
| `view-detail.png` | 景點詳細內容         |
| `login.png`       | 會員登入             |
| `member.png`      | 會員中心             |
| `wishlist.png`    | 收藏景點             |
| `admin.png`       | 後台景點管理         |
| `dashboard.png`   | 後台 Dashboard       |
| `rwd-1200.png`    | 桌機寬度 1200px      |
| `rwd-768.png`     | 平板寬度 768px       |
| `rwd-375.png`     | 手機寬度 375px       |

### 專案畫面截圖

#### 首頁

#### 景點列表

#### 景點詳細內容

#### 會員登入

#### 會員中心

#### 收藏景點

#### 後台管理

#### Dashboard

### RWD 檢查截圖

#### 桌機寬度 1200px

#### 平板寬度 768px

#### 手機寬度 375px

## 資料庫設計說明

本專題使用資料庫儲存會員、景點、景點分類、景點圖片與會員收藏資料。

主要資料表包含：

- `members`：會員資料
- `views`：景點資料
- `views_types`：景點分類資料
- `imgs`：景點圖片資料
- `member_wishlists`：會員收藏資料

### members 會員資料表

| 欄位         | 說明         |
| ------------ | ------------ |
| `id`         | 會員主鍵     |
| `memberName` | 會員名稱     |
| `email`      | 會員 Email   |
| `pwd`        | 會員密碼     |
| `tel`        | 電話         |
| `birthday`   | 生日         |
| `address`    | 地址         |
| `avatar`     | 會員頭像路徑 |
| `status`     | 會員狀態     |

### views 景點資料表

| 欄位      | 說明         |
| --------- | ------------ |
| `id`      | 景點主鍵     |
| `name`    | 景點名稱     |
| `typeId`  | 景點分類編號 |
| `city`    | 城市         |
| `town`    | 鄉鎮         |
| `address` | 景點地址     |
| `brief`   | 景點簡介     |
| `content` | 景點詳細介紹 |
| `tel`     | 電話         |
| `like`    | 瀏覽數       |

### views_types 景點分類資料表

| 欄位   | 說明     |
| ------ | -------- |
| `id`   | 分類主鍵 |
| `name` | 分類名稱 |

### imgs 景點圖片資料表

| 欄位      | 說明         |
| --------- | ------------ |
| `id`      | 圖片主鍵     |
| `viewsId` | 景點編號     |
| `imgSrc`  | 景點圖片路徑 |

### member_wishlists 會員收藏資料表

| 欄位         | 說明         |
| ------------ | ------------ |
| `id`         | 收藏資料主鍵 |
| `memberId`   | 會員編號     |
| `viewsId`    | 景點編號     |
| `created_at` | 收藏建立時間 |

### 資料表關聯

景點分類與景點為一對多關係：

```text
views_types
    │
    │ 1 : N
    ▼
  views
```

景點與景點為一對多關係：

```text
views
  │
  │ 1 : N
  ▼
 imgs
```

會員與景點透過收藏資料表建立多對多關係：

```text
members
    │
    │ 1 : N
    ▼
member_wishlists
    ▲
    │ N : 1
    │
  views
```

## API 說明

本專題部分前端功能透過 Axios 呼叫 Laravel API，API 負責處理資料查詢、會員資料與收藏等功能。

### 景點 API

| 方法 | 路徑                 | 功能                               | 前端使用位置 |
| ---- | -------------------- | ---------------------------------- | ------------ |
| GET  | `/api/views/getView` | 查詢景點資料，可依分類與關鍵字篩選 | 景點列表     |
| GET  | `/api/views/...`     | 景點相關資料操作                   | 景點管理     |

### 會員 API

| 方法 | 路徑                       | 功能                 | 前端使用位置 |
| ---- | -------------------------- | -------------------- | ------------ |
| GET  | `/api/member/home/profile` | 取得目前登入會員資料 | 會員中心     |

### 收藏 API

| 方法   | 路徑                   | 功能             | 前端使用位置       |
| ------ | ---------------------- | ---------------- | ------------------ |
| GET    | `/api/wishlist/list`   | 取得會員收藏列表 | 會員中心           |
| POST   | `/api/wishlist/add`    | 新增景點收藏     | 景點頁面           |
| DELETE | `/api/wishlist/delete` | 刪除景點收藏     | 景點頁面、收藏列表 |

實際 API 路由會依照專案目前的 `routes/api.php` 設定為準。

## 會員驗證說明

本專案建立會員登入與權限驗證機制。

使用者登入後才能使用會員相關功能，例如：

- 查看會員資料
- 修改會員資料
- 修改密碼
- 查看收藏景點
- 新增收藏
- 取消收藏

需要登入的頁面與 API 會透過 Middleware 進行驗證，避免未登入使用者直接存取會員相關功能。

## 前端資料串接

前端使用 Axios 與 Laravel API 進行非同步資料傳輸。

例如景點列表：

```text
使用者操作
    ↓
JavaScript / Axios
    ↓
Laravel API
    ↓
Controller
    ↓
Eloquent ORM
    ↓
Database
    ↓
JSON Response
    ↓
JavaScript 更新畫面
```

收藏功能則透過 API 完成新增與刪除：

```text
點擊收藏
    ↓
Axios POST
    ↓
Laravel API
    ↓
MemberWishlist
    ↓
Database
    ↓
更新收藏狀態
```

## 後台管理功能

後台提供管理者進行網站資料管理。

### 會員管理

可以進行 :

- 會員修改
- 會員刪除

### 景點管理

可以進行：

- 新增景點
- 查看景點
- 修改景點
- 刪除景點
- 管理景點分類
- 管理景點圖片

### Dashboard

Dashboard 使用統計卡片、圖表與排行方式呈現網站資料。

主要包含：

- 景點統計
- 會員相關統計
- 收藏相關統計
- 景點排行
- Top 10 景點

讓管理者可以快速了解目前網站的資料狀況。

## 開發過程中解決的問題

### API 驗證問題

開發會員系統與 API 時，曾遇到 `401 Unauthenticated` 問題。

透過檢查 Laravel 的：

- Middleware
- Session
- Authentication
- Sanctum
- Axios Request
- CSRF

重新整理會員登入與 API 驗證流程，確保登入後的會員資料與需要驗證的 API 可以正常使用。

### Eloquent Relationship

景點、景點圖片、景點分類與會員收藏之間存在不同的資料關聯，因此使用 Laravel Eloquent Relationship 管理資料。

例如：

```php
$views->imgs
```

取得景點相關圖片。

會員則可以透過：

```php
$member->wishlist()
```

取得會員收藏資料。

### Axios 非同步資料更新

會員中心與收藏功能使用 Axios 呼叫 API，在不重新載入整個頁面的情況下取得及更新資料。

透過前端 JavaScript 接收 API 回傳的 JSON 資料，再更新對應的畫面內容。

## 測試紀錄

| 測試項目   | 測試方法                               | 結果 |
| ---------- | -------------------------------------- | ---- |
| 景點列表   | 開啟景點列表並確認景點資料是否正常顯示 | 通過 |
| 景點分類   | 使用分類條件查詢景點                   | 通過 |
| 景點搜尋   | 使用關鍵字查詢景點                     | 通過 |
| 景點詳細頁 | 點擊景點後確認詳細資料與圖片           | 通過 |
| 會員登入   | 使用會員帳號進行登入                   | 通過 |
| 會員資料   | 登入後取得會員資料                     | 通過 |
| 收藏新增   | 將景點加入收藏                         | 通過 |
| 收藏刪除   | 取消已收藏景點                         | 通過 |
| 收藏列表   | 查看會員收藏景點                       | 通過 |
| 後台 CRUD  | 新增、修改、刪除景點資料               | 通過 |
| 景點圖片   | 新增、查看與刪除景點圖片               | 通過 |
| RWD        | 使用不同螢幕尺寸檢查版面               | 通過 |

## 安裝與執行方式

### 1. Clone 專案

```bash
git clone <https://github.com/fuckingcoach/Travel_Project.git>
cd <TravelGuide/backend>
```

### 2. 建立環境設定檔

複製 `.env.example` 並重新命名為 `.env`。

```bash
cp .env.example .env
```

### 3. 安裝 Composer 套件

```bash
composer install
```

### 4. 建立 database.sqlite 檔案

```text
在 /backend/database/ 底下新增檔案名稱為 `database.sqlite`
```

### 4. 產生 Application Key

```bash
php artisan key:generate
```

### 5. 設定資料庫

在 `.env` 中設定資料庫資訊。

目前本機開發使用 SQLite：

```env
DB_CONNECTION=sqlite
APP_URL=http://localhost:8000
```

### 6. 執行 Migration

```bash
php artisan migrate:fresh
```

### 7. 執行 Seeder

```bash
php artisan db:seed
```

### 8. 啟動 Laravel

```bash
php artisan serve
```

開啟：

```text
http://localhost:8000
```

## 部署說明

目前專案尚未部署至雲端環境，僅於本機進行開發與測試。

目前執行環境：

```text
Laravel
    ↓
PHP
    ↓
SQLite
    ↓
localhost:8000
```

後續可以將專案部署至雲端環境，並將資料庫由 SQLite 改為 PostgreSQL 等正式資料庫。

## 未來規劃

- 部署至雲端環境
- 前端逐步導入 Vue / Nuxt
- PostgreSQL
- Redis
- API 文件整理
- 增加自動化測試
- 完善權限管理
- 優化 Laravel API 架構
- Docker 化開發環境

## 開發者資訊

| 項目              | 內容                                                   |
| ----------------- | ------------------------------------------------------ |
| 開發者            | Yee                                                    |
| 專案名稱          | Taiwan Travel Website                                  |
| 開發框架          | Laravel                                                |
| GitHub Repository | `<https://github.com/fuckingcoach/Travel_Project.git>` |
| Demo              | 尚未部署                                               |
