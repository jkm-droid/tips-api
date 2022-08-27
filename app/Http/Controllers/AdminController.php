<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Services\Api\AdminService;
use App\Services\Api\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminController extends Controller
{
    /**
     * @var UserService
     */
    private $_adminService;

    public function __construct(AdminService $adminService)
    {
        $this->_adminService = $adminService;
    }

    /**
     * Register a new admin
     *
     * This endpoint lets you add a new admin into the storage
     * @param AdminRegisterRequest $request
     * @return JsonResponse
     */
    public function registerAdmin(AdminRegisterRequest $request)
    {
        return $this->_adminService->registerAdmin($request->validated());
    }

    /**
     * Display all the admins
     *
     * This endpoint lets you get all the registered admins from the storage
     * @return AnonymousResourceCollection
     * @throws CustomException
     */
    public function viewAllAdmins()
    {
        return $this->_adminService->getAllAdmins();
    }

    /**
     * Login admin into the system
     *
     * This endpoint lets you sign in an admin into the system
     * Throws an error if the login credentials are incorrect
     * @param AdminLoginRequest $loginRequest
     * @return JsonResponse
     */
    public function loginAdmin(AdminLoginRequest $loginRequest)
    {
        return $this->_adminService->loginAdmin($loginRequest->validated());
    }

    /**
     * Logout an admin
     *
     * This endpoint lets you sign out an admin from the system
     * @return JsonResponse
     */
    public function logoutAdmin()
    {
        return $this->_adminService->logoutAdmin();
    }
}
