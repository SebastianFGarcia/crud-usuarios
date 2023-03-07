<?php

namespace App\Http\Controllers;

use App\Events\NewUserRegisteredEvent;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
// DB
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        $users->load('category');
        return response()->json($users);
    }

    public function searchUser(string $search): JsonResponse
    {
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('country', 'like', '%' . $search . '%')
            ->orWhere('nit', 'like', '%' . $search . '%')
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $users->load('category');
       
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|alpha|min:5|max:100',
            'last_name' => 'required|alpha|max:100',  
            'email' => 'required|email|unique:users,email|max:150',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|string|max:180',
            'country' => 'required|string',
            'nit' => 'required|string|unique:users,nit',
            'is_admin' => 'required|boolean',
            'password' => 'required|string|confirmed',
            'category_id' => 'required|numeric',
        ];
        try {
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validación fallida',
                'errors' => $e->errors(),
            ], 422);
        }

        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());

        event(new NewUserRegisteredEvent($user));

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $user = User::findOrFail($id);
        $user->load('category');

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $rules = [
            'name' => 'required|alpha|min:5|max:100',
            'last_name' => 'required|alpha|max:100',  
            'email' => 'required|email|max:150|unique:users,email,' . $id,
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|string|max:180',
            'country' => 'required|string',
            'nit' => 'required|string|unique:users,nit,' . $id,
            'is_admin' => 'required|boolean',
            'password' => 'confirmed',
            'category_id' => 'required|numeric',
        ];

        try {
            $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validación fallida',
                'errors' => $e->errors(),
            ], 422);
        }

        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente',
            'user' => $user,
        ]);
    }

    public function quantityUsersCountry() 
    {
        $usersByCountry = User::select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();

        return view('quantity_users_country', compact('usersByCountry'));
    }
}
