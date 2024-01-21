<?php

namespace App\Http\Services;

use App\Http\Requests\UserInfoRequest;
use Illuminate\Http\Request;
use App\Models\Businessman;
use App\Models\Serviceholder;
use App\Models\Student;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;

class UserInfoService
{
    public function storeUserInfo(UserInfoRequest $request)
    {
//        dd($request->toArray());
        return DB::transaction(function () use ($request) {
            $userInfo = UserInfo::create([
                'user_id' => auth()->user()->id,
                'gender' => $request->input('gender'),
                'profession_type' => $request->input('profession_type'),
            ]);

//            dd($userInfo->toArray());

            $this->storeSpecificInfo($request, $userInfo);


            return $userInfo;
        });
    }

    public function updateUserInfo(UserInfoRequest $request, UserInfo $userInfo)
    {
        return DB::transaction(function () use ($request, $userInfo) {
            $userInfo->update([
                'gender' => $request->input('gender'),
                'profession_type' => $request->input('profession_type'),
            ]);

            $this->updateSpecificInfo($request, $userInfo);

            return $userInfo;
        });
    }

    private function storeSpecificInfo(UserInfoRequest $request, UserInfo $userInfo): void
    {
        switch ($request->input('profession_type')) {
            case 1: // Student
                Student::create([
                    'user_id' => $userInfo->id,
                    'institute_name' => $request->input('institute_name'),
                    'daily_cost' => $request->input('daily_cost'),
                    'monthly_cost' => $request->input('monthly_cost'),
                    'pocket_money' => $request->input('pocket_money'),
                    'monthly_edu_expenses' => $request->input('monthly_edu_expenses'),
                    'monthly_income' => $request->input('monthly_income'),
                ]);
                break;
            case 2: // Businessman
                Businessman::create([
                    'user_id' => $userInfo->id,
                    'company_name' => $request->input('company_name'),
                    'daily_cost' => $request->input('daily_cost'),
                    'monthly_cost' => $request->input('monthly_cost'),
                    'monthly_income' => $request->input('monthly_income'),
                    'employee_count' => $request->input('employee_count'),
                ]);
                break;
            case 3:
                ServiceHolder::create([
                    'user_id' => $userInfo->id,
                    'company_name' => $request->input('company_name'),
                    'daily_cost' => $request->input('daily_cost'),
                    'monthly_cost' => $request->input('monthly_cost'),
                    'monthly_income' => $request->input('monthly_income'),
                ]);
                break;
        }
    }

    private function updateSpecificInfo(UserInfoRequest $request, UserInfo $userInfo): void
    {
        switch ($request->input('profession_type')) {
            case 1: // Student
                $studentInfo = $userInfo->student;
                if ($studentInfo) {
                    $studentInfo->update([
                        'institute_name' => $request->input('institute_name'),
                        'daily_cost' => $request->input('daily_cost'),
                        'monthly_cost' => $request->input('monthly_cost'),
                        'pocket_money' => $request->input('pocket_money'),
                        'monthly_edu_expenses' => $request->input('monthly_edu_expenses'),
                        'monthly_income' => $request->input('monthly_income'),
                    ]);
                }
                break;
            case 2:
                $businessmanInfo = $userInfo->businessman;
                if ($businessmanInfo) {
                    $businessmanInfo->update([
                        'company_name' => $request->input('company_name'),
                        'daily_cost' => $request->input('daily_cost'),
                        'monthly_cost' => $request->input('monthly_cost'),
                        'monthly_income' => $request->input('monthly_income'),
                        'employee_count' => $request->input('employee_count'),
                    ]);
                }
                break;
            case 3: // Service Holder
                $serviceHolderInfo = $userInfo->serviceHolder;
                if ($serviceHolderInfo) {
                    $serviceHolderInfo->update([
                        'company_name' => $request->input('company_name'),
                        'daily_cost' => $request->input('daily_cost'),
                        'monthly_cost' => $request->input('monthly_cost'),
                        'monthly_income' => $request->input('monthly_income'),
                    ]);
                }
                break;
        }
    }

    public function storeOrUpdate(UserInfoRequest $request)
    {
        $user = auth()->user();

        $userInfo = UserInfo::where('user_id', $user->id)->first();


        if ($userInfo) {
            $this->updateUserInfo($request, $userInfo);
        } else {
            $this->storeUserInfo($request);
        }

        return $userInfo;
    }

    public function getUserInfo($id)
    {
        return UserInfo::findOrFail($id);
    }
}
