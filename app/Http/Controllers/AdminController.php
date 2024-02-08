<?php

namespace App\Http\Controllers;

use App\Http\Services\UserInfoService;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected UserInfoService $userInfoService;

    public function __construct(UserInfoService $userInfoService)
    {
        $this->userInfoService = $userInfoService;

    }

    public function index(): Renderable
    {
//        $users = User::paginate(10);

        $users = User::all();

        return view('admin.users', compact('users'));
    }

    public function userProfile($userId): JsonResponse|View
    {
        try {
            $userInfoData = $this->userInfoService->getUserInfoByUserId($userId);
            return view('user-info.index', compact('userInfoData'));
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function userReports(): View
    {
        return view('admin.report');
    }
}
