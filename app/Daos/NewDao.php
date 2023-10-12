<?php

namespace App\Daos;

use App\Models\News;
use Illuminate\Support\Facades\Log;

class NewDao
{
    public function create($title, $descripcion, $image_path)
    {
        return News::create([
            "title" => $title,
            "description" => $descripcion,
            "image_path" => $image_path
        ]);
    }

    public function getAll()
    {
        return News::all();
    }

    public function getById($id)
    {
        return News::where("id", $id)->first();
    }

    public function deleteById($id)
    {
        return News::where("id", $id)->delete();
    }
    public function updateById($id, $title, $descripcion, $image_path)
    {
        return News::where("id", $id)->update([
            "title" => $title,
            "description" => $descripcion,
            "image_path" => $image_path
        ]);
    }
}
