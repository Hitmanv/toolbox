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
```
### 工具模板导出
```php
php artisan vendor:publish
```

## 功能描述
### 后台模板
/resources/views/vendor/master.blade.php

### 工具命令
