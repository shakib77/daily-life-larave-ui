<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Http\Services\UserInfoService;
use App\Models\UserInfo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserInfoController extends Controller
{

    protected UserInfoService $userInfoService;

    public function __construct(UserInfoService $userInfoService)
    {
        $this->userInfoService = $userInfoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse|View
    {
        try {
            $userInfo = $this->userInfoService->getUserInfo();
//            dd($userInfo);
            return view('user-info.index', compact('userInfo'));
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse|View
    {
        try {
            $userInfoData = $this->userInfoService->getUserInfo();
            return view('user-info.add-edit', compact('userInfoData'));
        } catch (\Throwable $exception) {
            Log::debug($exception->getMessage());
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserInfoRequest $request): RedirectResponse
    {
//        dd('ddcd');
        /*if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }*/
        $userInfo = $this->userInfoService->storeOrUpdate($request);

        return redirect()->route('user-info.index')->with('user-info', $userInfo);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInfo $userInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserInfo $userInfo)
    {
//        $user-info = $this->userInfoService->getUserInfoById($user-info);
//
//        return view('user_infos.edit', compact('user-info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserInfo $userInfo)
    {
//        $this->userInfoService->updateUserInfo($request, $user-info);
//
//        return redirect()->route('user_infos.index')->with('success', 'UserInfo updated successfully.');
    }

    /*public function storeOrUpdate(UserInfoRequest $request): RedirectResponse
    {
        $user-info = $this->userInfoService->storeOrUpdate($request);

        return redirect()->route('uerInfo.user-info.index')->with('user-info', $user-info);
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInfo $userInfo)
    {
        //
    }
}
