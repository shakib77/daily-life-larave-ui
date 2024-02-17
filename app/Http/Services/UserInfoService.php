<?php

namespace App\Http\Services;

use App\Http\Requests\UserInfoRequest;
use App\Models\Businessman;
use App\Models\Serviceholder;
use App\Models\Student;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
//        dd($userInfo->id, $request->input('profession_type'));
        switch ($request->input('profession_type')) {
            case 1: // Student
                Student::create([
                    'user_id' => auth()->user()->id,
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
                    'user_id' => auth()->user()->id,
                    'company_name' => $request->input('company_name'),
                    'daily_cost' => $request->input('daily_cost'),
                    'monthly_cost' => $request->input('monthly_cost'),
                    'monthly_income' => $request->input('monthly_income'),
                    'employee_count' => $request->input('employee_count'),
                ]);
                break;
            case 3:
                ServiceHolder::create([
                    'user_id' => auth()->user()->id,
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


    public function getUserInfo(): array
    {
        try {
            $userId = auth()->user()->id;
            $userInfo = UserInfo::where('user_id', $userId)->firstOrFail();
            $professionInfo = $this->getProfessionInfo($userInfo);

            return compact('userInfo', 'professionInfo');
        } catch (ModelNotFoundException $exception) {

            return [];
            /*return [
                'status' => 'error',
                'message' => 'No user info found for the current user.',
                'error' => $exception->getMessage(),
            ];*/
        }
    }

    public function getUserInfoByUserId($userId): array
    {
        try {
            if (auth()->user()->role === User::ROLE['ADMIN']) {
                $userInfo = UserInfo::where('user_id', $userId)->firstOrFail();
                $professionInfo = $this->getProfessionInfo($userInfo);

                return compact('userInfo', 'professionInfo');
            } else {
                return [];
            }

        } catch (ModelNotFoundException $exception) {

            return [];
            /*return [
                'status' => 'error',
                'message' => 'No user info found for the current user.',
                'error' => $exception->getMessage(),
            ];*/
        }
    }


    private function getProfessionInfo(UserInfo $userInfo)
    {
        return match ($userInfo->profession_type) {
            1 => Student::where('user_id', $userInfo->user_id)->firstOrFail(),
            2 => Businessman::where('user_id', $userInfo->user_id)->firstOrFail(),
            3 => Serviceholder::where('user_id', $userInfo->user_id)->firstOrFail(),
            default => null,
        };
    }

    public function adminReport(): array
    {
        $counts = UserInfo::select('profession_type', \DB::raw('count(*) as count'))
            ->groupBy('profession_type')
            ->get()
            ->pluck('count', 'profession_type');

        $totalCount = $counts->sum();

        $percentages = $counts->map(function ($count) use ($totalCount) {
            return $totalCount > 0 ? ($count / $totalCount) * 100 : 0;
        });

        $data = [];
        foreach ($counts as $professionType => $count) {

            $professionTypeName = match ($professionType) {
                1 => 'Student',
                2 => 'Businessman',
                3 => 'Service Holder',
                default => 'Unknown',
            };

            $data[] = [
                'profession_type' => $professionType,
                'profession_type_name' => $professionTypeName,
                'count' => $count,
                'percentage' => $percentages[$professionType],
            ];
        }

        return $data;
    }

    public function financialReports($request): array
    {
        try {
            if (count($request->input()) <= 0) {
                return [];
            }
            $professionType = $request->input('profession_type');
            $gender = $request->input('gender');

//            $users = User::query()->where('role', 'user');
            $users = User::query();

            $users->join('user_infos', 'users.id', '=', 'user_infos.user_id');


            if ($professionType) {
                $users->where('user_infos.profession_type', $professionType);
            }

            if ($gender) {
                $users->where('user_infos.gender', $gender);
            }

            $userData = $users->get();

            return $userData->toArray();
        } catch (ModelNotFoundException $exception) {
            return [];
        }
    }
}
