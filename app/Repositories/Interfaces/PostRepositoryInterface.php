<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    // интерфейсы для публичной части:
    public function getPublishedPaginated(?string $search, int $perPage): LengthAwarePaginator; // метод для получения списка постов с пагинацией и с поиском

    public function findPublishedBySlugOrFail(string $slug): Post;  // найти опубликованный пост по полю slug,
                                                                    // либо выкидывает ModelNotFoundException если пост не найден либо не опубликован
    // интерфейсы для админской части:
    public function getPaginated(int $perPage): LengthAwarePaginator;

    public function allApi(): Collection;
    public function findApi(int $id): ?Post;
    public function createApi(array $data): Post;
    public function updateApi(Post $post, array $data): Post;
    public function softDelete(Post $post): bool;
    public function restore(int $id): ?Post;
    public function forceDelete(int $id): bool;
    public function getTrashed(): Collection;
}
