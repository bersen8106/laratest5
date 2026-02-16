<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    /**
     * Создание поста с опциональной загрузкой изображения
     * Атомарная операция: оборачиваем все операции БД в транзакцию
     * Если любая операция провалится - все изменения откатываются
     * Если успешно - изменения фиксируются
     * Либо все выполняется полностью, либо ничего.
     */
    public function create(array $data): Post
    {
        return DB::transaction(function () use ($data) {
            $image = $data['image'] ?? null;                // присваиваем переменной значение из массива, либо null
            unset($data['image'], $data['remove_image']);   // удаляем лишние поля:
                                                            // Поле image содержит объект загруженного файла, его нельзя сохранить в БД напрямую
                                                            // Поле remove_image — технический флаг для форм (удалить/не удалять)

            $slugBase = Str::slug($data['title']);  // создает человекочитаемый URL
            $slug = $slugBase . '-' . rand(1, 999999);  // гарантирует уникальность $slug
            $data['slug'] = $slug;

            $isPublished = (bool)$data['is_published'] ?? false;
            $data['is_published'] = $isPublished;
            $data['published_at'] = $isPublished ? now() : null;

            $post = Post::create($data);    // Создает запись в БД с уже очищенными данными (без image и remove_image).

            if ($image) {   // проверяем, было ли загружено изображение
                $path = $image->store('posts', 'public');   // сохраняет файл: Директория: storage/app/public/posts/
                                                            //                 Возвращает путь: "posts/имя_файла.jpg"
                $post->image = $path;                       // сохраняем путь в БД
                $post->save();                              // обновляем запись
            }

            return $post;
        });
    }

    public function update(Post $post, array $data): Post
    {
        return DB::transaction(function () use ($post, $data) {
            $newImage = $data['image'] ?? null;
            $removeImage = (bool)($data['remove_image'] ?? false);
            unset($data['image'], $data['remove_image']);

            $wasPublished = (bool)$post->is_published;
            $nowPublished = (bool)($data['is_published'] ?? $wasPublished);
            $data['is_published'] = $nowPublished;

            if (!$wasPublished && $nowPublished) {
                $data['is_published'] = now();
            } elseif ($wasPublished && !$nowPublished) {
                $data['is_published'] = null;
            }

            $slugBase = Str::slug($data['title']);  // создает человекочитаемый URL
            $slug = $slugBase . '-' . rand(1, 999999);  // гарантирует уникальность $slug
            $data['slug'] = $slug;

            $post->update($data);

            if ($removeImage && $post->image) {
                Storage::disk('public')->delete($post->image);
                $post->image = null;
            }

            if ($newImage) {
                if ($post->image){
                    Storage::disk('public')->delete($post->image);
                }
                $post->image = $newImage->store('posts', 'public');
            }

            $post->save();

            return $post;
        });
    }

    public function delete(Post $post): void
    {
        DB::transaction(function () use ($post) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->delete();
        });
    }
}
