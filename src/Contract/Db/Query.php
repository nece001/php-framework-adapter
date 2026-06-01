<?php

namespace Nece\Framework\Adapter\Contract\Db;

use Closure;

interface Query extends Stringable
{
    /**
     * 指定当前数据表名（不含前缀）.
     *
     * @param string $name 不含前缀的数据表名字
     *
     * 使用方法：
     * - name('user')  // 使用表前缀后的表名
     *
     * @return $this
     */
    public function name(string $name): Query;

    /**
     * 指定当前操作的数据表.
     *
     * @param string $table 表名（支持完整表名，可包含前缀）
     *
     * 使用方法：
     * - table('think_user')  // 指定完整表名
     * - table('db.user')  // 指定数据库和表名
     *
     * @return $this
     */
    public function table(string $table): Query;

    /**
     * 指定数据表别名.
     *
     * @param string $alias 数据表别名
     *
     * 使用方法：
     * - alias('u')  // 将当前表设置别名为u
     *
     * @return $this
     */
    public function alias(string $alias): Query;

    /**
     * 获取数据表别名.
     *
     * @param string $table 数据表（留空取当前表）
     *
     * 使用方法：
     * - getAlias()  // 获取当前表的别名
     * - getAlias('think_user')  // 获取指定表的别名
     *
     * @return string
     */
    public function getAlias(string $table = ''): string;

    /**
     * 指定查询字段.
     *
     * @param array $field 字段信息（支持字段名数组或键值对数组）
     *
     * 使用方法：
     * - field(['id', 'name'])
     * - field(['id', 'name' => 'username'])
     *
     * @return $this
     */
    public function field(array $field): Query;

    /**
     * 表达式方式指定查询字段.
     *
     * @param string $field 字段名（支持SQL表达式）
     *
     * 使用方法：
     * - fieldRaw('COUNT(*) as total')
     * - fieldRaw('CONCAT(first_name, last_name) as full_name')
     *
     * @return $this
     */
    public function fieldRaw(string $field): Query;

    /**
     * 指定要排除的查询字段.
     *
     * @param array $field 要排除的字段（字段名数组）
     *
     * 使用方法：
     * - withoutField(['password', 'token'])
     *
     * @return $this
     */
    public function withoutField(array $field): Query;

    /**
     * 指定其它数据表的查询字段.
     *
     * @param array  $field     字段信息（字段名数组）
     * @param string $tableName 数据表名
     * @param string $prefix    字段前缀
     * @param string $alias     别名前缀
     *
     * 使用方法：
     * - tableField(['id', 'name'], 'user')
     *
     * @return $this
     */
    public function tableField(array $field, string $tableName, string $prefix = '', string $alias = ''): Query;

    /**
     * COUNT查询.
     *
     * @param string $field 字段名
     *
     * 使用方法：
     * - count()  // COUNT(*)
     * - count('id')  // COUNT(id)
     *
     * @return int
     */
    public function count(string $field = '*'): int;

    /**
     * SUM查询.
     *
     * @param string $field 字段名
     *
     * 使用方法：
     * - sum('price')  // SUM(price)
     *
     * @return float
     */
    public function sum(string $field): float;

    /**
     * MIN查询.
     *
     * @param string $field 字段名
     * @param bool   $force 是否强制转为数字类型
     *
     * 使用方法：
     * - min('price')  // MIN(price)
     *
     * @return float
     */
    public function min(string $field, bool $force = true): float;

    /**
     * MAX查询.
     *
     * @param string $field 字段名
     * @param bool   $force 是否强制转为数字类型
     *
     * 使用方法：
     * - max('price')  // MAX(price)
     *
     * @return float
     */
    public function max(string $field, bool $force = true): float;

    /**
     * AVG查询.
     *
     * @param string $field 字段名
     *
     * 使用方法：
     * - avg('score')  // AVG(score)
     *
     * @return float
     */
    public function avg(string $field): float;

    /**
     * 查询SQL组装 join.
     *
     * @param string $join      关联的表名
     * @param string $condition 条件
     * @param string $type      JOIN类型（支持 INNER, LEFT, RIGHT, FULL）
     * @param array  $bind      参数绑定
     *
     * 使用方法：
     * - join('user', 'user.id = order.user_id')
     * - join('user', 'user.id = order.user_id', 'LEFT')
     *
     * @return $this
     */
    public function join(string $join, string $condition = null, string $type = 'INNER', array $bind = []): Query;

    /**
     * LEFT JOIN.
     *
     * @param string $join      关联的表名
     * @param string $condition 条件
     * @param array  $bind      参数绑定
     *
     * 使用方法：
     * - leftJoin('user', 'user.id = order.user_id')
     *
     * @return $this
     */
    public function leftJoin(string $join, string $condition = null, array $bind = []): Query;

    /**
     * RIGHT JOIN.
     *
     * @param string $join      关联的表名
     * @param string $condition 条件
     * @param array  $bind      参数绑定
     *
     * 使用方法：
     * - rightJoin('user', 'user.id = order.user_id')
     *
     * @return $this
     */
    public function rightJoin(string $join, string $condition = null, array $bind = []): Query;

    /**
     * FULL JOIN.
     *
     * @param string $join      关联的表名
     * @param string $condition 条件
     * @param array  $bind      参数绑定
     *
     * 使用方法：
     * - fullJoin('user', 'user.id = order.user_id')
     *
     * @return $this
     */
    public function fullJoin(string $join, string $condition = null, array $bind = []): Query;

    /**
     * 指定AND查询条件.
     *
     * @param mixed $field     查询字段（支持字符串字段名、数组条件、闭包、Query对象）
     * @param mixed $op        查询表达式（=, <, >, <=, >=, <>, !=, LIKE等）
     * @param mixed $condition 查询条件（支持字符串、数字、数组、闭包）
     *
     * 使用方法：
     * - where('name', 'like', '%test%')
     * - where(['name' => 'test', 'status' => 1])
     * - where(function($query) { $query->where('id', 1); })
     *
     * @return $this
     */
    public function where($field, $op = null, $condition = null): Query;

    /**
     * 指定OR查询条件.
     *
     * @param mixed $field     查询字段（支持字符串字段名、数组条件、闭包）
     * @param mixed $op        查询表达式（=, <, >, <=, >=, <>, !=, LIKE等）
     * @param mixed $condition 查询条件（支持字符串、数字、数组、闭包）
     *
     * 使用方法：
     * - whereOr('name', 'like', '%test%')
     * - whereOr(['name' => 'test', 'status' => 1])
     *
     * @return $this
     */
    public function whereOr($field, $op = null, $condition = null): Query;

    /**
     * 指定XOR查询条件.
     *
     * @param mixed $field     查询字段（支持字符串字段名、数组条件、闭包）
     * @param mixed $op        查询表达式（=, <, >, <=, >=, <>, !=, LIKE等）
     * @param mixed $condition 查询条件（支持字符串、数字、数组、闭包）
     *
     * 使用方法：
     * - whereXor('name', 'like', '%test%')
     * - whereXor(['name' => 'test', 'status' => 1])
     *
     * @return $this
     */
    public function whereXor($field, $op = null, $condition = null): Query;

    /**
     * 指定Null查询条件.
     *
     * @param string $field 查询字段
     * @param string $logic 查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereNull('deleted_at')  // 查询deleted_at为NULL的记录
     *
     * @return $this
     */
    public function whereNull(string $field, string $logic = 'AND'): Query;

    /**
     * 指定NotNull查询条件.
     *
     * @param string $field 查询字段
     * @param string $logic 查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereNotNull('deleted_at')  // 查询deleted_at不为NULL的记录
     *
     * @return $this
     */
    public function whereNotNull(string $field, string $logic = 'AND'): Query;

    /**
     * 指定In查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持数组或闭包子查询）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereIn('id', [1, 2, 3])
     * - whereIn('id', function($query) { $query->field('id')->table('other'); })
     *
     * @return $this
     */
    public function whereIn(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定NotIn查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持数组或闭包子查询）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereNotIn('id', [1, 2, 3])
     * - whereNotIn('id', function($query) { $query->field('id')->table('other'); })
     *
     * @return $this
     */
    public function whereNotIn(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定Like查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持字符串或数组）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereLike('name', '%test%')
     * - whereLike('name', ['%test%', '%demo%'])
     *
     * @return $this
     */
    public function whereLike(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定NotLike查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持字符串或数组）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereNotLike('name', '%test%')
     * - whereNotLike('name', ['%test%', '%demo%'])
     *
     * @return $this
     */
    public function whereNotLike(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定Between查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持数组或字符串）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereBetween('age', [18, 30])
     * - whereBetween('age', '18,30')
     *
     * @return $this
     */
    public function whereBetween(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定NotBetween查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持数组或字符串）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereNotBetween('age', [18, 30])
     * - whereNotBetween('age', '18,30')
     *
     * @return $this
     */
    public function whereNotBetween(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定Exists查询条件.
     *
     * @param mixed  $condition 查询条件（支持闭包子查询或SQL字符串）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereExists(function($query) { $query->table('other')->where('status', 1); })
     * - whereExists('SELECT * FROM other WHERE status = 1')
     *
     * @return $this
     */
    public function whereExists($condition, string $logic = 'AND'): Query;

    /**
     * 指定NotExists查询条件.
     *
     * @param mixed  $condition 查询条件（支持闭包子查询或SQL字符串）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereNotExists(function($query) { $query->table('other')->where('status', 1); })
     * - whereNotExists('SELECT * FROM other WHERE status = 1')
     *
     * @return $this
     */
    public function whereNotExists($condition, string $logic = 'AND'): Query;

    /**
     * 指定FIND_IN_SET查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持字符串或数组）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereFindInSet('tags', '1')
     * - whereFindInSet('tags', [1, 2])
     *
     * @return $this
     */
    public function whereFindInSet(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 指定json_contains查询条件.
     *
     * @param string $field     查询字段
     * @param mixed  $condition 查询条件（支持数组、对象、字符串）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereJsonContains('data', ['name' => 'test'])
     * - whereJsonContains('data', 'test')
     *
     * @return $this
     */
    public function whereJsonContains(string $field, $condition, string $logic = 'AND'): Query;

    /**
     * 比较两个字段.
     *
     * @param string $field1   查询字段
     * @param string $operator 比较操作符（支持=, <, >, <=, >=, <>, !=）
     * @param string $field2   比较字段
     * @param string $logic    查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereColumn('create_time', '>', 'update_time')
     *
     * @return $this
     */
    public function whereColumn(string $field1, string $operator, string $field2 = null, string $logic = 'AND'): Query;

    /**
     * 指定表达式查询条件.
     *
     * @param string $where 查询条件（支持SQL表达式）
     * @param array  $bind  参数绑定
     * @param string $logic 查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereRaw('status = 1 AND type = ?', [1])
     *
     * @return $this
     */
    public function whereRaw(string $where, array $bind = [], string $logic = 'AND'): Query;

    /**
     * 指定表达式查询条件 OR.
     *
     * @param string $where 查询条件（支持SQL表达式）
     * @param array  $bind  参数绑定
     *
     * 使用方法：
     * - whereOrRaw('status = ? OR type = ?', [1, 2])
     *
     * @return $this
     */
    public function whereOrRaw(string $where, array $bind = []): Query;

    /**
     * 指定Exp查询条件.
     *
     * @param string $field 查询字段
     * @param string $where 查询条件（支持SQL表达式）
     * @param array  $bind  参数绑定
     * @param string $logic 查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereExp('create_time', '> UNIX_TIMESTAMP() - 86400')
     *
     * @return $this
     */
    public function whereExp(string $field, string $where, array $bind = [], string $logic = 'AND'): Query;

    /**
     * 指定字段Raw查询.
     *
     * @param string $field     查询字段表达式（支持SQL表达式）
     * @param mixed  $op        查询表达式（支持=, <, >等操作符或作为条件值）
     * @param mixed  $condition 查询条件（支持字符串、数字，若为null则$op作为条件值）
     * @param string $logic     查询逻辑（支持 and, or, xor）
     *
     * 使用方法：
     * - whereFieldRaw('LEFT(name, 1)', 'LIKE', 'a%')
     * - whereFieldRaw('RAND()', '<', 0.5)
     * - whereFieldRaw('status', 1)  // 等同于 whereFieldRaw('status', '=', 1)
     *
     * @return $this
     */
    public function whereFieldRaw(string $field, $op, $condition = null, string $logic = 'AND'): Query;

    /**
     * 指定group查询.
     *
     * @param mixed $group GROUP字段（支持字符串或数组）
     *
     * 使用方法：
     * - group('status')
     * - group(['status', 'type'])
     *
     * @return $this
     */
    public function group($group): Query;

    /**
     * 指定排序 order('id','desc').
     *
     * @param string $field 排序字段
     * @param string $order 排序方向（支持 desc, asc，默认为空表示asc）
     *
     * 使用方法：
     * - order('id')  // 默认升序
     * - order('id', 'desc')  // 降序
     *
     * @return $this
     */
    public function order(string $field, string $order = ''): Query;

    /**
     * 表达式方式指定Field排序.
     *
     * @param string $field 排序字段（支持SQL表达式）
     * @param array  $bind  参数绑定
     *
     * 使用方法：
     * - orderRaw('FIELD(id, 3, 1, 2)')
     *
     * @return $this
     */
    public function orderRaw(string $field, array $bind = []): Query;

    /**
     * 指定Field排序 orderField('id',[1,2,3],'desc').
     *
     * @param string $field  排序字段
     * @param array  $values 排序值数组
     * @param string $order  排序方向（支持 desc, asc）
     *
     * 使用方法：
     * - orderField('id', [3, 1, 2])
     * - orderField('id', [3, 1, 2], 'desc')
     *
     * @return $this
     */
    public function orderField(string $field, array $values, string $order = ''): Query;

    /**
     * 随机排序.
     *
     * 使用方法：
     * - orderRand()  // 随机打乱结果集
     *
     * @return $this
     */
    public function orderRand(): Query;

    /**
     * 指定查询数量.
     *
     * @param int $offset 起始位置
     * @param int $length 查询数量
     *
     * 使用方法：
     * - limit(10)  // 获取前10条
     * - limit(10, 20)  // 从第10条开始，获取20条
     *
     * @return $this
     */
    public function limit(int $offset, int $length = null): Query;

    /**
     * 指定分页.
     *
     * @param int $page     页数
     * @param int $listRows 每页数量
     *
     * 使用方法：
     * - page(1, 10)  // 第1页，每页10条
     *
     * @return $this
     */
    public function page(int $page, int $listRows = null): Query;

    /**
     * 分页查询.
     *
     * @param int  $listRows 每页数量
     * @param bool $simple   是否简洁模式
     *
     * 使用方法：
     * - paginate()  // 默认每页15条
     * - paginate(20)  // 每页20条
     * - paginate(10, true)  // 简洁模式，仅返回数据
     *
     * @return Paginator
     */
    public function paginate(int $listRows = 15, bool $simple = false): Paginator;

    /**
     * 指定having查询.
     *
     * @param string $having HAVING条件（支持SQL表达式）
     *
     * 使用方法：
     * - having('COUNT(*) > 10')
     *
     * @return $this
     */
    public function having(string $having): Query;

    /**
     * 指定查询lock.
     *
     * @param mixed $lock 是否lock（支持bool或lock表达式字符串）
     *
     * 使用方法：
     * - lock(true)  // 共享锁
     * - lock(false)  // 不加锁
     * - lock('FOR UPDATE')  // 排他锁
     *
     * @return $this
     */
    public function lock($lock = false): Query;

    /**
     * 查询缓存 数据为空不缓存.
     *
     * @param mixed $key    缓存key（true自动生成，string指定key，false关闭缓存）
     * @param mixed $expire 缓存有效期（秒数或DateTime对象）
     * @param mixed $tag    缓存标签（支持字符串或数组）
     *
     * 使用方法：
     * - cache()  // 自动生成缓存key
     * - cache('my_cache_key')  // 指定缓存key
     * - cache('my_key', 3600)  // 指定key和有效期
     * - cache(3600)  // 指定有效期，自动生成key
     *
     * @return $this
     */
    public function cache($key = true, $expire = null, $tag = null): Query;

    /**
     * 查询缓存 允许缓存空数据.
     *
     * @param mixed $key    缓存key（true自动生成，string指定key）
     * @param mixed $expire 缓存有效期（秒数或DateTime对象）
     * @param mixed $tag    缓存标签（支持字符串或数组）
     *
     * 使用方法：
     * - cacheAlways()  // 自动生成缓存key
     * - cacheAlways('my_cache_key', 3600)
     *
     * @return $this
     */
    public function cacheAlways($key = true, $expire = null, $tag = null): Query;

    /**
     * 强制更新缓存
     *
     * @param mixed $key    缓存key（true自动生成，string指定key）
     * @param mixed $expire 缓存有效期（秒数或DateTime对象）
     * @param mixed $tag    缓存标签（支持字符串或数组）
     *
     * 使用方法：
     * - cacheForce()  // 强制更新缓存
     * - cacheForce('my_cache_key', 3600)
     *
     * @return $this
     */
    public function cacheForce($key = true, $expire = null, $tag = null): Query;

    /**
     * 指定查询SQL组装 union.
     *
     * @param string $union UNION查询（支持SQL字符串或Query对象）
     * @param bool   $all   是否使用UNION ALL
     *
     * 使用方法：
     * - union('SELECT id, name FROM table2')
     * - union($query, true)
     *
     * @return $this
     */
    public function union(string $union, bool $all = false): Query;

    /**
     * 查询SQL组装 union all.
     *
     * @param string $union UNION查询（支持SQL字符串或Query对象）
     *
     * @return $this
     */
    public function unionAll(string $union): Query;

    /**
     * 指定distinct查询.
     *
     * @param bool $distinct 是否唯一
     *
     * 使用方法：
     * - distinct()  // 去重查询
     * - distinct(false)  // 取消去重
     *
     * @return $this
     */
    public function distinct(bool $distinct = true): Query;

    /**
     * 指定强制索引.
     *
     * @param string $force 索引名称
     *
     * 使用方法：
     * - force('idx_name')  // 强制使用idx_name索引
     *
     * @return $this
     */
    public function force(string $force): Query;

    /**
     * 查询注释.
     *
     * @param string $comment 注释内容
     *
     * 使用方法：
     * - comment('查询用户列表')
     *
     * @return $this
     */
    public function comment(string $comment): Query;

    /**
     * 设置从主服务器读取数据.
     *
     * @param bool $readMaster 是否从主服务器读取
     *
     * 使用方法：
     * - master()  // 强制从主库读取
     *
     * @return $this
     */
    public function master(bool $readMaster = true): Query;

    /**
     * 设置是否严格检查字段名.
     *
     * @param bool $strict 是否严格检查字段
     *
     * 使用方法：
     * - strict()  // 严格检查字段名
     * - strict(false)  // 关闭严格检查
     *
     * @return $this
     */
    public function strict(bool $strict = true): Query;

    /**
     * 条件查询.
     *
     * @param mixed $condition 满足条件（支持闭包、布尔值、非空值）
     * @param mixed $query     满足条件后执行的查询表达式（闭包或数组）
     * @param mixed $otherwise 不满足条件后执行（支持闭包或数组）
     *
     * 使用方法：
     * - when($name, function($query) { $query->where('name', $name); })
     * - when($name, ['name' => $name])
     *
     * @return $this
     */
    public function when($condition, $query, $otherwise = null): Query;
}