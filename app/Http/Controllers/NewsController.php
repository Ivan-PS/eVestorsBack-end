<?php

namespace App\Http\Controllers;
use App\Services\NewService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newService;
    public function __construct(NewService $newService)
    {
        $this->newService = $newService;

    }

    public function create(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        return response()->json([
            'message' => "create new",
            'response' => $this->newService->createNew($title, $description, "")
        ], 200);

    }

    public function getAll(Request $request)
    {
        return response()->json([
            'message' => "get all news",
            'response' => $this->newService->getAll()
        ], 200);
    }

    public function getById(Request $request)
    {
        $id = $request->id;

        return response()->json([
            'message' => "get news by id",
            'response' => $this->newService->getById($id)
        ], 200);

    }

    public function deleteById(Request $request)
    {
        $id = $request->id;

        return response()->json([
            'message' => "get news by id",
            'response' => $this->newService->deleteById($id)
        ], 200);

    }

    public function updateById(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $description = $request->description;

        return response()->json([
            'message' => "get news by id",
            'response' => $this->newService->updateNewById($id, $title, $description, "")
        ], 200);

    }





}
