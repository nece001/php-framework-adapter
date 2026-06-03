<?php

namespace Nece\Framework\Adapter;

use ArrayAccess;
use Countable;
use Iterator;
use JsonSerializable;

class Collection implements ArrayAccess, Countable, Iterator, JsonSerializable
{
    /**
     * 数据容器
     *
     * @var array
     */
    protected $items = [];

    /**
     * 当前迭代位置
     *
     * @var int
     */
    protected $position = 0;

    /**
     * 构造函数
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * 创建Collection实例
     *
     * @param array $items
     * @return static
     */
    public static function make(array $items = [])
    {
        return new static($items);
    }

    /**
     * 获取所有元素
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * 获取指定键的元素
     *
     * @param string|int $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null): mixed
    {
        if ($this->offsetExists($key)) {
            return $this->items[$key];
        }

        return $default;
    }

    /**
     * 设置元素
     *
     * @param string|int $key
     * @param mixed $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;

        return $this;
    }

    /**
     * 检查键是否存在
     *
     * @param string|int $key
     * @return bool
     */
    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * 删除元素
     *
     * @param string|int $key
     * @return $this
     */
    public function forget($key)
    {
        if ($this->offsetExists($key)) {
            unset($this->items[$key]);
        }

        return $this;
    }

    /**
     * 获取第一个元素
     *
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public function first(callable $callback = null, $default = null)
    {
        if ($callback === null) {
            return empty($this->items) ? $default : reset($this->items);
        }

        foreach ($this->items as $key => $value) {
            if (call_user_func($callback, $value, $key)) {
                return $value;
            }
        }

        return $default;
    }

    /**
     * 获取最后一个元素
     *
     * @param callable|null $callback
     * @param mixed $default
     * @return mixed
     */
    public function last(callable $callback = null, $default = null)
    {
        if ($callback === null) {
            return empty($this->items) ? $default : end($this->items);
        }

        return $this->reverse()->first($callback, $default);
    }

    /**
     * 获取指定位置的元素
     *
     * @param int $index
     * @return mixed
     */
    public function nth($index)
    {
        $array = array_values($this->items);

        return isset($array[$index]) ? $array[$index] : null;
    }

    /**
     * 遍历并转换每个元素
     *
     * @param callable $callback
     * @return static
     */
    public function map(callable $callback)
    {
        $result = [];

        foreach ($this->items as $key => $value) {
            $result[$key] = call_user_func($callback, $value, $key);
        }

        return new static($result);
    }

    /**
     * 过滤元素
     *
     * @param callable $callback
     * @return static
     */
    public function filter(callable $callback)
    {
        $result = [];

        foreach ($this->items as $key => $value) {
            if (call_user_func($callback, $value, $key)) {
                $result[$key] = $value;
            }
        }

        return new static($result);
    }

    /**
     * 归约元素
     *
     * @param callable $callback
     * @param mixed $initial
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * 检查是否包含指定元素
     *
     * @param mixed $value
     * @return bool
     */
    public function contains($value)
    {
        return in_array($value, $this->items, true);
    }

    /**
     * 检查是否包含指定键
     *
     * @param string|int $key
     * @return bool
     */
    public function containsKey($key)
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * 获取元素索引
     *
     * @param mixed $value
     * @return int|string|null
     */
    public function indexOf($value)
    {
        foreach ($this->items as $key => $item) {
            if ($item === $value) {
                return $key;
            }
        }

        return null;
    }

    /**
     * 反转元素顺序
     *
     * @return static
     */
    public function reverse()
    {
        return new static(array_reverse($this->items, true));
    }

    /**
     * 排序元素
     *
     * @param callable|null $callback
     * @return static
     */
    public function sort(callable $callback = null)
    {
        $items = $this->items;

        if ($callback === null) {
            sort($items);
        } else {
            usort($items, $callback);
        }

        return new static($items);
    }

    /**
     * 按键排序
     *
     * @param int $sortFlags
     * @return static
     */
    public function sortByKeys($sortFlags = SORT_REGULAR)
    {
        $items = $this->items;
        ksort($items, $sortFlags);

        return new static($items);
    }

    /**
     * 截取元素
     *
     * @param int $offset
     * @param int|null $length
     * @return static
     */
    public function slice($offset, $length = null)
    {
        return new static(array_slice($this->items, $offset, $length, true));
    }

    /**
     * 拼接元素
     *
     * @param int $offset
     * @param int $length
     * @param array $replacement
     * @return static
     */
    public function splice($offset, $length = null, $replacement = [])
    {
        $items = $this->items;
        array_splice($items, $offset, $length, $replacement);

        return new static($items);
    }

    /**
     * 添加元素到末尾
     *
     * @param mixed $value
     * @return $this
     */
    public function push($value)
    {
        array_push($this->items, $value);

        return $this;
    }

    /**
     * 从末尾移除元素
     *
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * 添加元素到开头
     *
     * @param mixed $value
     * @return $this
     */
    public function unshift($value)
    {
        array_unshift($this->items, $value);

        return $this;
    }

    /**
     * 从开头移除元素
     *
     * @return mixed
     */
    public function shift()
    {
        return array_shift($this->items);
    }

    /**
     * 获取元素数量
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * 检查是否为空
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * 合并集合
     *
     * @param array|Collection $items
     * @return static
     */
    public function merge($items)
    {
        if ($items instanceof Collection) {
            $items = $items->all();
        }

        return new static(array_merge($this->items, $items));
    }

    /**
     * 获取唯一元素
     *
     * @return static
     */
    public function unique()
    {
        return new static(array_unique($this->items));
    }

    /**
     * 扁平化嵌套数组
     *
     * @param int $depth
     * @return static
     */
    public function flatten($depth = INF)
    {
        $result = [];

        foreach ($this->items as $item) {
            if (is_array($item) || $item instanceof Collection) {
                if ($depth > 1) {
                    if ($item instanceof Collection) {
                        $item = $item->all();
                    }
                    $result = array_merge($result, static::make($item)->flatten($depth - 1)->all());
                } else {
                    $result = array_merge($result, (array)$item);
                }
            } else {
                $result[] = $item;
            }
        }

        return new static($result);
    }

    /**
     * 获取指定键的值
     *
     * @param string|int $key
     * @return static
     */
    public function pluck($key)
    {
        $result = [];

        foreach ($this->items as $item) {
            if (is_array($item) && isset($item[$key])) {
                $result[] = $item[$key];
            } elseif (is_object($item) && property_exists($item, $key)) {
                $result[] = $item->$key;
            }
        }

        return new static($result);
    }

    /**
     * 分块元素
     *
     * @param int $size
     * @return static
     */
    public function chunk($size)
    {
        $chunks = array_chunk($this->items, $size);

        return new static(array_map(function ($chunk) {
            return new static($chunk);
        }, $chunks));
    }

    /**
     * 获取键名
     *
     * @return static
     */
    public function keys()
    {
        return new static(array_keys($this->items));
    }

    /**
     * 获取值
     *
     * @return static
     */
    public function values()
    {
        return new static(array_values($this->items));
    }

    /**
     * 转为数组
     *
     * @return array
     */
    public function toArray()
    {
        return $this->all();
    }

    /**
     * 转为JSON字符串
     *
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * JSON序列化
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->items;
    }

    /**
     * 数组访问：设置元素
     *
     * @param string|int $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    /**
     * 数组访问：检查元素是否存在
     *
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * 数组访问：删除元素
     *
     * @param string|int $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    /**
     * 数组访问：获取元素
     *
     * @param string|int $offset
     * @return mixed
     */
    public function offsetGet($offset): mixed
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    /**
     * 迭代器：重置位置
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * 迭代器：获取当前元素
     *
     * @return mixed
     */
    public function current(): mixed
    {
        $array = array_values($this->items);

        return isset($array[$this->position]) ? $array[$this->position] : null;
    }

    /**
     * 迭代器：获取当前键
     *
     * @return mixed
     */
    public function key(): mixed
    {
        $keys = array_keys($this->items);

        return $keys[$this->position] ?? null;
    }

    /**
     * 迭代器：移动到下一个元素
     */
    public function next(): void
    {
        $this->position++;
    }

    /**
     * 迭代器：检查是否还有元素
     *
     * @return bool
     */
    public function valid(): bool
    {
        $array = array_values($this->items);

        return isset($array[$this->position]);
    }

    /**
     * 魔术方法：获取属性
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * 魔术方法：设置属性
     *
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * 魔术方法：检查属性是否存在
     *
     * @param string $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->has($key);
    }

    /**
     * 魔术方法：删除属性
     *
     * @param string $key
     */
    public function __unset($key)
    {
        $this->forget($key);
    }

    /**
     * 魔术方法：转为字符串
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
