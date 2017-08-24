## composer 安装
```json
  {
        "repositories" : [
            {
                "type": "vcs",
                "url": "git@git.oschina.net:hitmanxiii/toolbox.git"
            }
        ]
    }
```

## 使用
### 添加至 app.php
```php
Hitman\Toolbox\ToolboxServiceProvider::class,

// 添加后台管理 auth.php

```
### 工具模板导出
```php
php artisan vendor:publish
```

## 功能描述
### 后台母板
```
/resources/views/vendor/master.blade.php
```
### 后台管理生成
```
migration -> 2017_08_24_080433_create_table_admins.php
Model -> Admin.php
Controller -> Admin/AdminController
Route -> route/amdin.php
```

### 工具命令
