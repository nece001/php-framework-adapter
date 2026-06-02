<?php

namespace Nece\Framework\Adapter\Contract\DbAdapter;

/**
 * 模型接口
 *
 * @author nece001@163.com
 * @create 2026-06-01 10:24:47
 */
interface Model
{
    /**
     * 创建模型实例.
     *
     * @param array $data 初始化数据
     *
     * 使用方法：
     * - $model = User::instance(new \think\Model())
     *
     * @return Model
     */
    public static function instance($dbModel): Model;

    /**
     * 设置单个属性值.
     *
     * @param string $name  属性名
     * @param mixed  $value 属性值
     *
     * 使用方法：
     * - $model->setAttr('name', '张三')
     *
     * @return $this
     */
    public function setAttr(string $name, $value): Model;

    /**
     * 获取单个属性值.
     *
     * @param string $name 属性名
     *
     * 使用方法：
     * - $model->getAttr('name')
     *
     * @return mixed
     */
    public function getAttr(string $name);

    /**
     * 设置多个属性值.
     *
     * @param array $data 属性数据
     *
     * 使用方法：
     * - $model->data(['name' => '张三', 'age' => 18])
     *
     * @return $this
     */
    public function data(array $data): Model;

    /**
     * 获取属性数据.
     *
     * @param string|null $name 属性名（留空返回全部数据）
     *
     * 使用方法：
     * - $model->getData()  // 获取全部属性数据
     * - $model->getData('name')  // 获取指定属性值
     *
     * @return array|mixed
     */
    public function getData(?string $name = null);

    /**
     * 保存数据.
     *
     * @param array $data 数据
     *
     * 使用方法：
     * - $model->save()  // 保存已有数据
     * - $model->save(['name' => '张三'])  // 设置数据并保存
     *
     * @return bool
     */
    public function save(array $data = []): bool;

    /**
     * 强制更新数据.
     *
     * @param array $data 数据
     *
     * 使用方法：
     * - $model->forceUpdate(['name' => '李四'])
     *
     * @return bool
     */
    public function forceUpdate(array $data = []): bool;

    /**
     * 删除数据.
     *
     * @param mixed $data 主键值或删除条件
     *
     * 使用方法：
     * - $model->delete()  // 删除当前模型
     * - Model::destroy(1)  // 删除指定主键
     *
     * @return bool
     */
    public function delete($data = null): bool;

    /**
     * 获取原始数据.
     *
     * @param string $name 属性名（留空返回全部原始数据）
     *
     * 使用方法：
     * - $model->getOriginal()  // 获取全部原始数据
     * - $model->getOriginal('name')  // 获取指定属性的原始值
     *
     * @return mixed
     */
    public function getOriginal(string $name = null);

    /**
     * 设置主键值.
     *
     * @param mixed $value 主键值
     *
     * 使用方法：
     * - $model->setKey(1)
     *
     * @return $this
     */
    public function setKey($value): Model;

    /**
     * 获取主键值.
     *
     * 使用方法：
     * - $id = $model->getKey()
     *
     * @return mixed
     */
    public function getKey();

    /**
     * 获取主键名.
     *
     * 使用方法：
     * - $keyName = $model->getKeyName()
     *
     * @return string
     */
    public function getKeyName(): string;

    /**
     * 获取数据表名.
     *
     * 使用方法：
     * - $table = $model->getTable()
     *
     * @return string
     */
    public function getTable(): string;

    /**
     * 获取模型名称.
     *
     * 使用方法：
     * - $name = $model->getModelName()
     *
     * @return string
     */
    public function getModelName(): string;

    /**
     * 获取错误信息.
     *
     * @param bool $all 是否获取全部错误
     *
     * 使用方法：
     * - $error = $model->getError()  // 获取第一条错误
     * - $errors = $model->getError(true)  // 获取全部错误
     *
     * @return mixed
     */
    public function getError(bool $all = false);

    /**
     * 设置错误信息.
     *
     * @param mixed $error 错误信息（支持字符串或数组）
     *
     * 使用方法：
     * - $model->setError('保存失败')
     * - $model->setError(['name' => '名称不能为空'])
     *
     * @return $this
     */
    public function setError($error): Model;

    /**
     * 数据验证.
     *
     * @param array  $data  数据
     * @param mixed  $rules 验证规则（支持数组或字符串场景名）
     * @param array  $msg   错误信息
     * @param string $scene 验证场景
     *
     * 使用方法：
     * - $model->validate(['name' => 'require'])
     * - $model->validate([], 'scene_name')
     *
     * @return bool
     */
    public function validate(array $data = [], $rules = [], array $msg = [], string $scene = ''): bool;

    /**
     * 开启自动写入时间戳.
     *
     * @param bool $auto 是否自动写入
     *
     * 使用方法：
     * - $model->autoWriteTimestamp()  // 开启自动写入
     * - $model->autoWriteTimestamp(false)  // 关闭自动写入
     *
     * @return $this
     */
    public function autoWriteTimestamp(bool $auto = true): Model;

    /**
     * 获取查询对象.
     *
     * 使用方法：
     * - User::query()->where('status', 1)->select()
     * - User::query()->with('posts')->find(1)
     *
     * @return ModelRelationQuery
     */
    public function query(): ModelRelationQuery;

    /**
     * 转换为数组.
     *
     * @author nece001@163.com
     * @create 2026-06-02 10:28:34
     *
     * @return array
     */
    public function toArray(): array;
}