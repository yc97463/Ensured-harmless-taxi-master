# 黑克松的啦

## Member

- @yc97463 
- @swchen1217 

## Design 

### 目的

### 對象

使用搭車APP之使用者

### 時機
在疫情爆發前騎，許多人會對共享經濟感到畏懼，畢竟不想因為與他人共享資源，而間接被病毒感染到。
此舉在要訂車的時候，會希望自己叫到的車會是已經消毒過的，而大多平台都有提供API資源，我們可以串接，並加入我們自己的消毒回報平台，讓使用者在使用我們的系統叫車時，在看到司機的消毒回報情形時，能多一份安心。

### 呈現方式

### 內容

### 流程

- 官方程序
    - 55688APP > 叫車 > 點選地區 > 等車 > 上車 > 付款(多元付款) > 下車

- 我們ㄉ
    - 確定有被消毒(?)
    - 拍照


### Frontend

- @yc97463 

### Backend

- @swchen1217 

## Skill

> 累計已有技能

### Design 

### Frontend

- React.js
- HTML
- CSS

### Backend

- PHP
- Laravel

## Banner
![](https://cdn.hackathontwjr.ml/www/images/logo/main_logo.png)

# 部屬方式

## 前端

## 後端

1. 網站伺服器根目錄指向 public 目錄
2. storage 和 bootstrap/cache 目錄中的目錄必須讓伺服器有寫入權限
3. 建立mysql
4. 使用資料夾內的 setup.sql
5. 將 .env.example 複製為 .env
6. 修改.env內的mysql連線資訊
4. composer install
8. php artisan key:generate
9. php artisan migrate
10. php artisan passport:install  並記住產出之
```
Client ID: 2
Client secret: ********
```
11. 複製進前端 config.json
12. 資料庫內users資料表執行
```
INSERT INTO `users` (`id`, `account`, `password`, `email`, `name`) VALUES
(1, '888888', '$2y$10$aijoxIHZPz9EhA8sEq992OsFcEB/znl21BS5ft35/0zXKjvUYxprS', 'swchen1217@gmail.com', 'SWC');
```

# API

## GET `/`

### Response

#### `200`

- success
    - boolean
    - working or not

---

## POST `/oauth/token`

### Body

- `password`
    - grant_type
        - string
        - type of the OAuth
        - Use `password` in the FIOS Frontend
    - client_id
        - string
        - id of the client
    - client_secret
        - string
        - secret of the client
    - username
        - string
        - account of the user
        - When `grant_type` is `password`
    - password
        - string
        - password of the user
        - When `grant_type` is `password`

- `refresh_token`
    - grant_type
        - string
        - type of the OAuth
        - Use `refresh_token` in the FIOS Frontend
    - client_id
        - string
        - id of the client
    - client_secret
        - string
        - secret of the client
    - refresh_token
        - string

### Response

#### `200` (have `access_token`)

- token_type
- expires_in
    - `access_token`
- access_token
    - expires `3 Hours`
- refresh_token
    - expires `1 Day`

#### `401`

- error
    - Username or Password Error
- error
    - invalid_client

## POST `/oauth/user`

### Response

#### `200`

- id
    - string
    - id of the user
- account
    - string
    - username of the user
- name
    - string
    - name of the user
- email
    - string
    - email of the user
- timestamp
    - datetime
- roles
    - array
    - role name of the user

## DELETE `/oauth/token`

### Body

- rememberme (optional)
    - boolean
    - 預設為`false`,若為`true`時,則`refresh_token`將不被刪除

### Response

#### `204`

## GET `/user`
## GET `/user/{user_id}`
## POST `/user`
## PATCH `/user/{user_id}`
## DELETE `/user/{user_id}`

## GET `/car`
## GET `/car/{car_id}`
## GET `/car/{license_plate}`
## GET `/car/{company_id}`
## GET `/car/{status}`
## POST `/car`
## PATCH `/car/{car_id}`
## DELETE `/car/{car_id}`

## GET `/status/{license_plate}`
## POST `/status`

## GET `/history`
## GET `/history/{car_id}`
## GET `/history/{license_plate}`
## GET `/history/{company_id}`

# Database

## users

| Column | Type | Modifier | Comment |
| :-: | :-: | :- | :- |
| id | INT | UNSIGNED, NOT NULL, AUTO_INCREMENT |  |
| account | VARCHAR(60) | NOT NULL | |
| name | VARCHAR | NOT NULL |  |
| email | EMAIL | NOT NULL | |
| created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |
| updated_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |

PRIMARY (id)
UNIQUE (account)
UNIQUE (email)

## RBAC (5 Tables)

## OAuth (5 Tables)

## cars

| Column | Type | Modifier | Comment |
| :-: | :-: | :- | :- |
| id | INT | UNSIGNED, NOT NULL, AUTO_INCREMENT |  |
| license_plate | VARCHAR | NOT NULL | |
| owner_user_id | INT | NOT NULL,UNSIGNED |  |
| status | VARCHAR | NOT NULL | |
| company_id | EMAIL | NOT NULL | |
| created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |
| updated_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |

PRIMARY (id)
FOREIGN KEY (owner_user_id) REFERENCES users(id) ON DELETE CASCADE

## history

| Column | Type | Modifier | Comment |
| :-: | :-: | :- | :- |
| id | INT | UNSIGNED, NOT NULL, AUTO_INCREMENT |  |
| car_id | INT | NOT NULL,UNSIGNED |  |
| status | VARCHAR | NOT NULL | |
| created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |
| updated_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |

PRIMARY (id)
FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE

## company

| Column | Type | Modifier | Comment |
| :-: | :-: | :- | :- |
| id | INT | UNSIGNED, NOT NULL, AUTO_INCREMENT |  |
| name | VARCHAR | NOT NULL | |
| created_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |
| updated_at | TIMESTAMP | NOT NULL, DEFAULT CURRENT_TIMESTAMP |  |

# Roles and Permission

## Roles

- SuperAdmin
- OfficeManager
- Driver

## Permission ==ToDo==
