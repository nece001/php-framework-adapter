<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

/**
 * 查询范围管理器
 *
 * @author nece001@163.com
 * @create 2025-11-10 19:56:48
 */
class ScopeManager
{
    /**
     * 查询范围
     *
     * @var array
     */
    private static $scope = [];

    /**
     * 添加查询范围
     *
     * @author nece001@163.com
     * @create 2025-11-10 19:56:48
     *
     * @param string $type 查询范围类型
     * @param string $name 查询范围名称
     * @param callable $scope 查询范围回调函数
     * @return void
     */
    public static function addScope(string $type, string $name, callable $scope): void
    {
        $type = strtolower($type);
        self::$scope[$type][$name] = $scope;
    }

    /**
     * 获取查询范围
     *
     * @author nece001@163.com
     * @create 2025-11-10 19:56:48
     *
     * @param string $type 查询范围类型
     * @return array 查询范围回调函数数组
     */
    public static function getScopes(string $type): array
    {
        $type = strtolower($type);
        return self::$scope[$type] ?? [];
    }
}
