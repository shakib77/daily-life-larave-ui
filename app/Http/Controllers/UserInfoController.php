<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoRequest;
use App\Http\Services\UserInfoService;
use App\Models\UserInfo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
    public function index(): View
    {
        return view('user-info.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user-info.add-edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserInfoRequest $request): RedirectResponse
    {
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
