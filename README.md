## composer 安装
```json
  {
    "repositories" : [
        {
            "type": "vcs",
            "url": "https://gitee.com/hitmanxiii/toolbox.git"
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
php artisan tb:init
```


### 工具命令
#### 数据库字典生成工具
```shell
# 生成数据库字典 md -> docs/db.md
php artisan tb:make_doc
```
