# PHP 框架适配器

## 核心目标

开发一套代码，可以无缝运行于多个 PHP 框架。

通过统一的接口抽象，让您的业务代码与具体框架解耦，实现一次开发、多处运行。

## 支持框架

- Laravel
- Webman
- ThinkPHP

## 安装方式

```bash
composer require nece001/php-framework-adapter-laravel  # Laravel 适配器
composer require nece001/php-framework-adapter-webman    # Webman 适配器
composer require nece001/php-framework-adapter-thinkphp  # ThinkPHP 适配器
```

## 设计理念

### 统一契约，框架无关

定义标准化的接口契约，屏蔽不同框架的实现差异：

```php
// 业务代码仅依赖契约接口
use Nece\Framework\Adapter\Contract\Controller;
use Nece\Framework\Adapter\Contract\Facade\Db;
use Nece\Framework\Adapter\Contract\Facade\Container;

class UserController implements Controller
{
    public function index()
    {
        // 统一的数据库操作
        $users = Db::query()->table('users')->get();
        
        // 统一的响应方式
        return $this->success(['users' => $users]);
    }
}
```

### 核心契约接口

| 接口 | 作用 | 统一能力 |
|------|------|----------|
| `Controller` | 控制器契约 | json/success/failure/redirect/download |
| `Db` | 数据库门面 | 查询/事务/聚合函数 |
| `Model` | 模型契约 | 数据读写/属性操作/验证 |
| `Container` | 容器门面 | 依赖注入/服务解析 |
| `Paginator` | 分页器 | 统一分页数据结构 |

## 使用示例

以下示例基于实际项目实现，展示如何基于抽象契约开发框架无关的代码。

### 1. 控制器实现

```php
use Nece\Framework\Adapter\Controller;
use Nece\Gears\Agreement\Service\AgreementService;

class AgreementController extends Controller
{
    public function document()
    {
        $find_key = $this->request()->input('find_key');

        $service = new AgreementService();
        $content = $service->getDocumentContent($find_key);

        return $this->success($content);
    }

    public function sign()
    {
        $find_key = $this->request()->input('find_key');
        $signatory_id = $this->request()->input('signatory_id');
        $signatory = $this->request()->input('signatory');
        $signing_data = $this->request()->input('signing_data', []);

        $service = new AgreementService();
        $record = $service->signing($find_key, $signatory_id, $signatory, $signing_data);

        return $this->success($record);
    }
}
```

### 2. 服务层实现

```php
use Nece\Framework\Adapter\DbAdapter\Model;
use Nece\Framework\Adapter\Exception\NotFoundException;
use Nece\Gears\Agreement\Model\AgreementDocument;
use Nece\Gears\Agreement\Model\AgreementSigningRecord;
use Nece\Gears\Agreement\Model\Agreement;

class AgreementService
{
    public function signing(int $agreement_id, int $signatory_id, string $signatory, array $signing_data = []): AgreementSigningRecord
    {
        $document = Model::instance(AgreementDocument::class)
            ->where('agreement_id', $agreement_id)
            ->where('is_published', 1)
            ->find();
            
        if (!$document) {
            throw new NotFoundException('协议文档不存在');
        }

        $content = $document->content;
        if ($signing_data) {
            foreach ($signing_data as $key => $value) {
                $content = str_replace('{' . $key . '}', $value, $content);
            }
        }

        $record = Model::instance(AgreementSigningRecord::class);
        $record->agreement_id = $agreement_id;
        $record->agreement_document_id = $document->id;
        $record->signatory_id = $signatory_id;
        $record->signatory = $signatory;
        $record->content = $content;
        $record->signing_data = $signing_data;
        $record->save();

        return $record;
    }
}
```

### 3. 模型定义

```php
use Nece\Framework\Adapter\BaseModel;
use Nece\Framework\Adapter\DbAdapter\SoftDelete;

class Agreement extends BaseModel
{
    use SoftDelete;
}

class AgreementDocument extends BaseModel
{
    // 模型属性自动映射数据库字段
}

class AgreementSigningRecord extends BaseModel
{
    // 模型属性自动映射数据库字段
}
```

### 4. 请求处理

```php
use Nece\Framework\Adapter\Controller;

class UserController extends Controller
{
    public function index()
    {
        // 获取 GET 参数
        $page = $this->request()->get('page', 1);
        
        // 获取 POST 参数
        $username = $this->request()->post('username');
        
        // 获取所有输入参数
        $data = $this->request()->input();
        
        // 获取请求方法
        $method = $this->request()->method();
        
        // 获取请求 URI
        $uri = $this->request()->uri();
        
        return $this->success(['page' => $page]);
    }
}
```

### 5. 响应处理

```php
use Nece\Framework\Adapter\Controller;

class ResponseController extends Controller
{
    public function jsonResponse()
    {
        // 返回 JSON 响应
        return $this->json(['code' => 0, 'message' => 'success']);
    }
    
    public function successResponse()
    {
        // 返回成功响应
        return $this->success(['data' => 'value'], '操作成功');
    }
    
    public function failureResponse()
    {
        // 返回失败响应
        return $this->failure('操作失败', -1);
    }
    
    public function redirectResponse()
    {
        // 重定向
        return $this->redirect('/login');
    }
    
    public function downloadResponse()
    {
        // 文件下载
        return $this->download('/path/to/file.pdf');
    }
}
```

### 6. 框架迁移示例

**Laravel 项目中的控制器**：
```php
use Nece\Framework\Adapter\Controller;

class UserController extends Controller
{
    public function list()
    {
        $keyword = $this->request()->input('keyword');
        // 业务逻辑...
        return $this->success($data);
    }
}
```

**无需修改代码，直接在 Webman 中运行**：
```php
// 同一个 UserController.php 文件
// 直接复制到 Webman 项目即可运行
// 框架适配器会自动适配底层实现
```

**无需修改代码，直接在 ThinkPHP 中运行**：
```php
// 同一个 UserController.php 文件
// 直接复制到 ThinkPHP 项目即可运行
// 框架适配器会自动适配底层实现
```

## 架构优势

1. **一次开发，多处运行**：业务代码无需修改即可在 Laravel/Webman/ThinkPHP 间切换
2. **框架迁移成本极低**：更换框架只需替换适配器包，核心业务代码保持不变
3. **统一开发体验**：无论使用哪个框架，API 调用方式完全一致
4. **降低学习成本**：掌握一套接口即可开发多个框架的项目

## 利弊分析

### 优势（利）

| 方面 | 说明 |
|------|------|
| **跨框架复用** | 同一套业务代码可在多个框架中运行，无需重复开发 |
| **降低迁移风险** | 框架迁移时业务代码保持不变，减少回归测试工作量 |
| **团队协作高效** | 团队成员只需学习一套接口，降低沟通成本 |
| **封装底层差异** | 屏蔽不同框架的实现细节，专注业务逻辑 |
| **灵活技术选型** | 可根据项目需求选择最适合的框架，不受历史代码限制 |
| **代码质量统一** | 统一的接口规范有助于保持代码风格一致 |

### 局限性（弊）

| 方面 | 说明 |
|------|------|
| **学习曲线** | 需要额外学习适配器的抽象接口和使用方式 |
| **功能受限** | 适配器只提供通用功能，框架特有高级功能无法直接使用 |
| **性能开销** | 适配器层会增加一层调用开销，虽微小但存在 |

### 适用场景建议

**推荐使用**：
- 需要开发跨框架的组件库或 SDK
- 团队同时维护多个框架的项目
- 不确定未来是否需要更换框架的新项目
- 需要快速在不同框架间原型验证

**不建议使用**：
- 项目明确只使用单一框架且长期稳定
- 需要深度使用框架特有功能的项目
- 对性能有极致要求的高性能场景

## 依赖要求

- PHP >= 8.0
- psr/simple-cache >= 3.0
- psr/log >= 3.0

## 许可证

MIT License