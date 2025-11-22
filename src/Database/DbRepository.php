<?php

namespace Nece\Framework\Adapter\Contract\DataBase;

use Nece\Framework\Adapter\Contract\DataBase\IModel;
use Nece\Framework\Adapter\Contract\DataBase\IQuery;

/**
 * 数据库仓储基类
 *
 * @author nece001@163.com
 * @create 2025-11-22 20:47:33
 */
abstract class DbRepository implements IRepository
{
    protected static $model_global_scopes = [];
    protected static $model_events = [];

    /**
     * @inheritDoc
     */
    public static function registerModelGlobalScope($type, IRepostoryModelScope $scope): void
    {
        self::$model_global_scopes[$type][] = $scope;
    }

    /**
     * @inheritDoc
     */
    public static function registerModelSavedEvent($type, $event): void
    {
        self::$model_events['saved'][$type][] = $event;
    }

    /**
     * @inheritDoc
     */
    public static function registerModelDeletedEvent($type, $event): void
    {
        self::$model_events['deleted'][$type][] = $event;
    }

    /**
     * @inheritDoc
     */
    final public function load($aggregateRoot): void
    {
        $this->startTrans();
        try {
            $this->loadBefore($aggregateRoot);
            $model = $this->loadEntity($aggregateRoot);
            $this->loadAfter($aggregateRoot, $model);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    final public function save($aggregateRoot): void
    {
        $this->startTrans();
        try {
            $this->saveBefore($aggregateRoot);
            $model = $this->saveEntity($aggregateRoot);
            $this->saveAfter($aggregateRoot, $model);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    final public function delete($aggregateRoot): void
    {
        $this->startTrans();
        try {
            $this->deleteBefore($aggregateRoot);
            $model = $this->deleteEntity($aggregateRoot);
            $this->deleteAfter($aggregateRoot, $model);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * 加载前
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:48:24
     *
     * @param AggregateRoot $aggregateRoot
     * @return void
     */
    protected function loadBefore($aggregateRoot) {}

    /**
     * 加载后
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:48:57
     *
     * @param AggregateRoot $aggregateRoot
     * @param IModel $model
     * @return void
     */
    protected function loadAfter($aggregateRoot, $model) {}

    /**
     * 加载实体（填充聚合根数据）
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:49:10
     *
     * @param AggregateRoot $aggregateRoot
     * @return IModel
     */
    protected function loadEntity($aggregateRoot): IModel
    {
        $model = $this->getModelName()::find($aggregateRoot->getId());
        if ($model) {
            $aggregateRoot->updateData($model->toArray());
        }

        return $model;
    }

    /**
     * 保存前
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:49:33
     *
     * @param AggregateRoot $aggregateRoot
     * @return void
     */
    protected function saveBefore($aggregateRoot) {}

    /**
     * 保存后
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:49:46
     *
     * @param AggregateRoot $aggregateRoot
     * @param IModel $model
     * @return void
     */
    protected function saveAfter($aggregateRoot, $model)
    {
        $this->dispatchModelEvents('saved', $model);
    }

    /**
     * 保存聚合根（创建或更新）
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:00
     *
     * @param AggregateRoot $aggregateRoot
     * @return IModel
     */
    protected function saveEntity($aggregateRoot): IModel
    {
        $model = $this->getModelName()::find($aggregateRoot->getId());
        if (!$model) {
            $model = $this->createModel();
        }
        $model->save($aggregateRoot->toArray());

        return $model;
    }

    /**
     * 删除前
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:13
     *
     * @param AggregateRoot $aggregateRoot
     * @return void
     */
    protected function deleteBefore($aggregateRoot) {}

    /**
     * 删除后
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:26
     *
     * @param AggregateRoot $aggregateRoot
     * @param IModel $model
     * @return void
     */
    protected function deleteAfter($aggregateRoot, $model)
    {
        $this->dispatchModelEvents('deleted', $model);
    }

    /**
     * 删除聚合根（根据聚合根ID）
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:39
     *
     * @param AggregateRoot $aggregateRoot
     * @return IModel
     */
    protected function deleteEntity($aggregateRoot): IModel
    {
        $model = $this->getModelName()::find($aggregateRoot->getId());
        if ($model) {
            $model->delete();
        }
        return $model;
    }

    /**
     * 触发模型事件
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:52
     *
     * @param string $action
     * @param IModel $model
     * @return void
     */
    protected function dispatchModelEvents($action, $model)
    {
        $action = self::$model_events[$action] ?? [];
        foreach ($action as $type => $events) {
            if ($model instanceof $type) {
                foreach ($events as $event) {
                    $event->handle($model);
                }
            }
        }
    }

    /**
     * 获取模型类名
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:51:05
     *
     * @return string
     */
    abstract protected function getModelName(): string;

    /**
     * 创建模型
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:46
     *
     * @return IModel
     */
    abstract protected function createModel(): IModel;

    /**
     * @inheritDoc
     */
    abstract public function query(string $alias = ''): IQuery;
}
