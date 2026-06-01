<?php

namespace Nece\Framework\Adapter\Contract\DbAdapter;

interface ModelRelationQuery extends Query
{
    /**
     * 预加载关联数据.
     *
     * @param mixed $relation 关联方法名（支持字符串、数组、闭包）
     * @param mixed $callback 回调函数
     *
     * 使用方法：
     * - with('profile')  // 预加载profile关联
     * - with(['profile', 'posts'])  // 预加载多个关联
     * - with('posts', function($query) { $query->where('status', 1); })  // 带条件的预加载
     *
     * @return $this
     */
    public function with($relation, $callback = null): ModelRelationQuery;

    /**
     * 预加载关联数据（JOIN方式）.
     *
     * @param mixed $relation 关联方法名
     * @param mixed $callback 回调函数
     * @param bool  $joinType 是否使用LEFT JOIN
     *
     * 使用方法：
     * - withJoin('profile')
     * - withJoin('posts', function($query) { $query->where('status', 1); })
     *
     * @return $this
     */
    public function withJoin($relation, $callback = null, bool $joinType = false): ModelRelationQuery;

    /**
     * 预加载关联统计.
     *
     * @param mixed       $relation 关联方法名（支持字符串、数组）
     * @param string|null $field    统计字段
     * @param string|null $name     统计别名
     *
     * 使用方法：
     * - withCount('posts')  // 统计posts数量
     * - withCount(['posts', 'comments'])  // 统计多个关联
     * - withCount('posts', 'id', 'post_count')  // 指定字段和别名
     *
     * @return $this
     */
    public function withCount($relation, string $field = null, string $name = null): ModelRelationQuery;

    /**
     * 预加载关联求和.
     *
     * @param mixed       $relation 关联方法名（支持字符串、数组）
     * @param string|null $field    求和字段
     * @param string|null $name     求和别名
     *
     * 使用方法：
     * - withSum('orders', 'amount')  // 求和orders的amount字段
     * - withSum('orders', 'amount', 'total_amount')  // 指定别名
     *
     * @return $this
     */
    public function withSum($relation, string $field = null, string $name = null): ModelRelationQuery;

    /**
     * 预加载关联求平均值.
     *
     * @param mixed       $relation 关联方法名（支持字符串、数组）
     * @param string|null $field    字段名
     * @param string|null $name     别名
     *
     * 使用方法：
     * - withAvg('scores', 'score')  // 求平均值
     *
     * @return $this
     */
    public function withAvg($relation, string $field = null, string $name = null): ModelRelationQuery;

    /**
     * 预加载关联求最小值.
     *
     * @param mixed       $relation 关联方法名（支持字符串、数组）
     * @param string|null $field    字段名
     * @param string|null $name     别名
     *
     * 使用方法：
     * - withMin('prices', 'price')  // 求最小值
     *
     * @return $this
     */
    public function withMin($relation, string $field = null, string $name = null): ModelRelationQuery;

    /**
     * 预加载关联求最大值.
     *
     * @param mixed       $relation 关联方法名（支持字符串、数组）
     * @param string|null $field    字段名
     * @param string|null $name     别名
     *
     * 使用方法：
     * - withMax('prices', 'price')  // 求最大值
     *
     * @return $this
     */
    public function withMax($relation, string $field = null, string $name = null): ModelRelationQuery;

    /**
     * 延迟预加载关联数据.
     *
     * @param mixed $relation 关联方法名（支持字符串、数组、闭包）
     * @param mixed $callback 回调函数
     *
     * 使用方法：
     * - load('profile')  // 延迟加载profile关联
     *
     * @return $this
     */
    public function load($relation, $callback = null): ModelRelationQuery;

    /**
     * 查询单条记录.
     *
     * @param mixed $data 主键值或查询条件
     *
     * 使用方法：
     * - User::find(1)  // 根据主键查询
     * - User::find(['name' => '张三'])  // 根据条件查询
     *
     * @return mixed
     */
    public static function find($data = null);

    /**
     * 查询多条记录.
     *
     * @param mixed $data 查询条件
     *
     * 使用方法：
     * - User::select()  // 查询全部
     * - User::select([1, 2, 3])  // 查询指定主键
     * - User::select(['status' => 1])  // 根据条件查询
     *
     * @return array
     */
    public static function select($data = null): array;

    /**
     * 获取或创建记录.
     *
     * @param array $where 查询条件
     * @param array $data  创建数据
     *
     * 使用方法：
     * - User::firstOrCreate(['email' => 'test@example.com'], ['name' => '张三'])
     *
     * @return mixed
     */
    public static function firstOrCreate(array $where, array $data = []);

    /**
     * 更新或创建记录.
     *
     * @param array $where 查询条件
     * @param array $data  更新/创建数据
     *
     * 使用方法：
     * - User::updateOrCreate(['email' => 'test@example.com'], ['name' => '李四'])
     *
     * @return mixed
     */
    public static function updateOrCreate(array $where, array $data = []);

    /**
     * 设置查询范围.
     *
     * @param string $scope 范围名称
     * @param array  $args  参数
     *
     * 使用方法：
     * - $query->scope('active')  // 应用active查询范围
     * - $query->scope('status', [1])  // 带参数的查询范围
     *
     * @return $this
     */
    public function scope(string $scope, array $args = []): ModelRelationQuery;
}