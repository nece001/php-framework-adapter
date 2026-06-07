<?php

namespace Nece\Framework\Adapter\Contract;

interface UploadFile
{
    /**
     * 创建上传文件实例
     *
     * @author nece001@163.com
     * @create 2026-06-04 16:53:33
     *
     * @param T $file
     * @return self
     */
    public static function instance($file): static;

    /**
     * 创建上传文件实例数组
     *
     * @author nece001@163.com
     * @create 2026-06-04 17:01:35
     *
     * @param array $files
     * @return array
     */
    public static function instances(array $files): array;

    /**
     * 获取上传文件名
     *
     * @return string|null
     */
    public function getUploadName(): ?string;

    /**
     * 获取上传文件的MIME类型
     *
     * @return string|null
     */
    public function getUploadMimeType(): ?string;

    /**
     * 获取上传文件的扩展名
     *
     * @return string
     */
    public function getUploadExtension(): string;

    /**
     * 获取上传错误码
     *
     * @return int|null
     */
    public function getUploadErrorCode(): ?int;

    /**
     * 检查上传是否有效
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * 移动文件到指定位置
     *
     * @param string $destination
     * @return \SplFileInfo
     */
    public function move(string $destination): \SplFileInfo;

    /**
     * 获取文件路径（不含文件名）
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * 获取文件名
     *
     * @return string
     */
    public function getFilename(): string;

    /**
     * 获取完整路径
     *
     * @return string
     */
    public function getPathname(): string;

    /**
     * 获取文件扩展名
     *
     * @return string
     */
    public function getExtension(): string;

    /**
     * 获取文件基本名
     *
     * @param string|null $suffix
     * @return string
     */
    public function getBasename(?string $suffix = null): string;

    /**
     * 是否为文件
     *
     * @return bool
     */
    public function isFile(): bool;

    /**
     * 是否为目录
     *
     * @return bool
     */
    public function isDir(): bool;

    /**
     * 是否为符号链接
     *
     * @return bool
     */
    public function isLink(): bool;

    /**
     * 获取文件大小（字节）
     *
     * @return int|false
     */
    public function getSize(): int|false;

    /**
     * 获取文件所有者
     *
     * @return int|false
     */
    public function getOwner(): int|false;

    /**
     * 获取文件所属组
     *
     * @return int|false
     */
    public function getGroup(): int|false;

    /**
     * 获取最后访问时间
     *
     * @return int|false
     */
    public function getATime(): int|false;

    /**
     * 获取最后修改时间
     *
     * @return int|false
     */
    public function getMTime(): int|false;

    /**
     * 获取创建时间
     *
     * @return int|false
     */
    public function getCTime(): int|false;

    /**
     * 获取文件权限
     *
     * @return int|false
     */
    public function getPerms(): int|false;

    /**
     * 是否可读
     *
     * @return bool
     */
    public function isReadable(): bool;

    /**
     * 是否可写
     *
     * @return bool
     */
    public function isWritable(): bool;

    /**
     * 是否可执行
     *
     * @return bool
     */
    public function isExecutable(): bool;

    /**
     * 获取真实路径
     *
     * @return string|false
     */
    public function getRealPath(): string|false;

    /**
     * 获取原生上传文件对象
     *
     * @return mixed
     */
    public function getRealUploadFile();
}