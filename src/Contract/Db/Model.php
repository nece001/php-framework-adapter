<?php

namespace Nece\Framework\Adapter\Contract\Db;

interface Model
{
    public static function query(): string;

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollback(): void;

    public function save(array $data): bool;

    public function update(array $data): bool;

    public function delete(): bool;

    public function find(int $id): self|null;

    public function toArray(): array;
}
