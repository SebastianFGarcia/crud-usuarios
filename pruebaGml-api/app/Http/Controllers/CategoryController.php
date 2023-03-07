<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Category::paginate(10));
    }

    public function categoryAll(): JsonResponse
    {
        return response()->json(Category::all());
    }

    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|min:5|max:100',
        ];
        try {
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validacion fallida',
                'errors' => $e->errors(),
            ], 422);
        }

        $category = Category::create($request->all());

        return response()->json([
            'message' => 'Categoria creada exitosamente',
            'category' => $category,
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $rules = [
            'name' => 'required|string|min:5|max:100',
        ];
        try {
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validacion fallida',
                'errors' => $e->errors(),
            ], 422);
        }

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json([
            'message' => 'Categoria actualizada exitosamente',
            'category' => $category,
        ]);
    }

    public function destroy(string $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Categoria eliminada exitosamente',
            'category' => $category,
        ]);
    }
}
