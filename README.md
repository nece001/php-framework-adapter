# PHP 框架适配器

目前兼容框架：

- Laravel
- Webman
- ThinkPHP

适配器提供统一的接口，方便在不同框架之间切换。

具体实现:

```
composer require nece001/php-framework-adapter-laravel # Laravel 适配器
composer require nece001/php-framework-adapter-webman # Webman 适配器
composer require nece001/php-framework-adapter-thinkphp # ThinkPHP 适配器
```

## 核心接口说明

### 1. 控制器接口 (Controller)

提供统一的控制器操作方法：

```php
use Nece\Framework\Adapter\Contract\Controller;

interface MyController extends Controller
{
    public function index()
    {
        // 返回 JSON 响应
        return $this->json(['data' => 'hello']);
        
        // 返回成功响应
        return $this->success(['list' => []]);
        
        // 返回失败响应
        return $this->failure('操作失败');
        
        // 重定向
        return $this->redirect('/login');
        
        // 文件下载
        return $this->download('/path/to/file');
    }
}
```

### 2. 数据库门面接口 (Db)

提供统一的数据库操作方法：

```php
use Nece\Framework\Adapter\Contract\Facade\Db;

// 创建原始表达式
$raw = Db::raw('COUNT(*)');

// 创建聚合函数
$count = Db::rawCount('id', 'total');
$sum = Db::rawSum('amount', 'sum_amount');

// 事务操作
Db::startTrans();
try {
    // 执行操作
    Db::commit();
} catch (\Exception $e) {
    Db::rollback();
}

// 使用事务回调
Db::transaction(function() {
    // 事务内操作
});
```

### 3. 模型接口 (Model)

提供统一的模型操作方法：

```php
use Nece\Framework\Adapter\Contract\DbAdapter\Model;

class UserModel implements Model
{
    public function createUser()
    {
        // 设置属性
        $this->setAttr('name', '张三');
        $this->setAttr('age', 18);
        
        // 或批量设置
        $this->data(['name' => '张三', 'age' => 18]);
        
        // 保存
        $this->save();
        
        // 获取主键
        $id = $this->getKey();
        
        // 获取属性
        $name = $this->getAttr('name');
        
        // 验证
        $this->validate(['name' => 'require']);
    }
}
```

### 4. 容器接口 (Container)

提供统一的依赖注入操作：

```php
use Nece\Framework\Adapter\Contract\Facade\Container;

// 初始化应用
Container::initApp();

// 获取应用实例
$app = Container::getApp();

// 创建实例（依赖注入）
$service = Container::make(MyService::class);
```

### 5. 分页器 (Paginator)

提供统一的分页数据结构：

```php
use Nece\Framework\Adapter\Paginator;

// 创建分页器
$paginator = new Paginator(
    $items,       // 当前页数据
    $total,       // 总记录数
    $currentPage, // 当前页码
    $pageSize     // 每页数量
);

// 获取分页信息
$paginator->total();        // 总记录数
$paginator->pageSize();     // 每页数量
$paginator->currentPage();  // 当前页码
$paginator->lastPage();     // 总页数
$paginator->hasNextPage();  // 是否有下一页
$paginator->hasPreviousPage(); // 是否有上一页

// 转换为数组
$array = $paginator->toArray();
```

## 使用场景

### 场景一：开发框架无关的组件库

```php
// 框架无关的用户服务
class UserService
{
    public function __construct(
        protected Container $container,
        protected Db $db
    ) {}
    
    public function getUserById($id)
    {
        return $this->db->query()->where('id', $id)->find();
    }
}
```

### 场景二：统一响应格式

```php
// 基础控制器
abstract class BaseController implements Controller
{
    public function success($data = null, string $message = 'success')
    {
        return $this->json([
            'code' => 0,
            'message' => $message,
            'data' => $data
        ]);
    }
    
    public function failure(string $message = 'failure', $code = -1, $data = null)
    {
        return $this->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }
}
```

## 框架适配实现

本库仅提供契约定义，具体框架的适配实现需要另外提供：

- **Laravel**：参考 `laravel/` 目录
- **ThinkPHP**：参考 `thinkphp/` 目录  
- **Webman**：参考 `webman/` 目录

## 依赖要求

- PHP >= 8.0
- psr/simple-cache >= 3.0
- psr/log >= 3.0

## 许可证

MIT License
