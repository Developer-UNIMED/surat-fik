<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangeUserRoleRequest;
use App\Services\UserRoleService;

class ChangeUserRoleController extends Controller
{
    public function __construct(private readonly UserRoleService $userRoleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->userRoleService->findAllAvailableRole(select: ['id', 'name']);
        $usersWithRole = $this->userRoleService->findAllUserWithRole(select: ['id', 'name', 'role_id']);

        return view('welcome', [
            'roles' => $roles,
            'users_with_role' => $usersWithRole,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChangeUserRoleRequest $request)
    {
        $form = $request->validated();
        $userRole = $this->userRoleService->updateRole(
            userId: $form['user_id'], roleId: $form['role_id']);

        return redirect()->back()->with([
            'code' => 201,
            'message' => "Role: {$form['role_id']} ditambahkan ke User: {$form['user_id']}",
            'data' => $userRole,
        ]);
    }
}
