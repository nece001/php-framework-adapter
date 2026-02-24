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
    final public function load($entity): void
    {
        $this->startTrans();
        try {
            $this->loadBefore($entity);
            $model = $this->loadEntity($entity);
            $this->loadAfter($entity, $model);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    final public function save($entity): void
    {
        $this->startTrans();
        try {
            $this->saveBefore($entity);
            $model = $this->saveEntity($entity);
            $this->saveAfter($entity, $model);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * @inheritDoc
     */
    final public function delete($entity): void
    {
        $this->startTrans();
        try {
            $this->deleteBefore($entity);
            $model = $this->deleteEntity($entity);
            $this->deleteAfter($entity, $model);
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
     * @param Entity $entity
     * @return void
     */
    protected function loadBefore($entity) {}

    /**
     * 加载后
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:48:57
     *
     * @param Entity $entity
     * @param IModel $model
     * @return void
     */
    protected function loadAfter($entity, $model) {}

    /**
     * 加载实体（填充聚合根数据）
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:49:10
     *
     * @param Entity $entity
     * @return IModel
     */
    protected function loadEntity($entity): IModel
    {
        $model = $this->getModelName()::find($entity->getId());
        if ($model) {
            $entity->updateData($model->toArray());
        }

        return $model;
    }

    /**
     * 保存前
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:49:33
     *
     * @param Entity $entity
     * @return void
     */
    protected function saveBefore($entity) {}

    /**
     * 保存后
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:49:46
     *
     * @param Entity $entity
     * @param IModel $model
     * @return void
     */
    protected function saveAfter($entity, $model)
    {
        $this->dispatchModelEvents('saved', $model);
    }

    /**
     * 保存聚合根（创建或更新）
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:00
     *
     * @param Entity $entity
     * @return IModel
     */
    protected function saveEntity($entity): IModel
    {
        $model = $this->getModelName()::find($entity->getId());
        if (!$model) {
            $model = $this->createModel();
        }
        $model->save($entity->toArray());
        $entity->setId($model->id);

        return $model;
    }

    /**
     * 删除前
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:13
     *
     * @param Entity $entity
     * @return void
     */
    protected function deleteBefore($entity) {}

    /**
     * 删除后
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:26
     *
     * @param Entity $entity
     * @param IModel $model
     * @return void
     */
    protected function deleteAfter($entity, $model)
    {
        $this->dispatchModelEvents('deleted', $model);
    }

    /**
     * 删除聚合根（根据聚合根ID）
     *
     * @author nece001@163.com
     * @create 2025-11-22 20:50:39
     *
     * @param Entity $entity
     * @return IModel
     */
    protected function deleteEntity($entity): IModel
    {
        $model = $this->getModelName()::find($entity->getId());
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
        $action = isset(self::$model_events[$action]) ? self::$model_events[$action] : [];
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
     * 查询构建器
     *
     * @author nece001@163.com
     * @create 2025-11-25 12:07:28
     *
     * @param string $alias
     * @return IQuery
     */
    abstract public function query(string $alias = ''): IQuery;
}
