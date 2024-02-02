@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        <a href="{{ route('user-info.create') }}" class="btn btn-success btn-sm float-right">

            @if( is_array($userInfoData) && count($userInfoData) > 0) Update @else  Add @endif
        </a>

        <h2>User Info details</h2>

        @if(is_array($userInfoData) && count($userInfoData) > 0)
            <div class="form-group">
                <label for="profession_type">Profession Type:</label>
                <input type="text" class="form-control" id="profession_type" name="profession_type" readonly
                       value="{{ match ($userInfoData['userInfo']->profession_type) {
                1 => 'Student',
                2 => 'Businessman',
                3 => 'Service Holder',
                default => 'No profession added',
                } }}"
                >
            </div>

            <div class="row">
                @if($userInfoData['userInfo']->gender)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <input type="text" class="form-control text-uppercase" id="gender" name="gender" readonly
                                   value="{{ $userInfoData['userInfo']->gender }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->institute_name)
                    <div class="col-6" id="institute_name_field">
                        <div class="form-group">
                            <label for="institute_name">Institute Name:</label>
                            <input type="text" class="form-control" id="institute_name" name="institute_name" readonly
                                   value="{{ $userInfoData['professionInfo']->institute_name }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->daily_cost)
                    <div class="col-6" id="daily_cost_field">
                        <div class="form-group">
                            <label for="daily_cost">Daily Cost:</label>
                            <input type="text" class="form-control" id="daily_cost" name="daily_cost" readonly
                                   value="{{ $userInfoData['professionInfo']->daily_cost }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->monthly_cost)
                    <div class="col-6" id="monthly_cost_field">
                        <div class="form-group">
                            <label for="monthly_cost">Daily Cost:</label>
                            <input type="text" class="form-control" id="monthly_cost" name="monthly_cost" readonly
                                   value="{{ $userInfoData['professionInfo']->monthly_cost }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->monthly_income)
                    <div class="col-6" id="monthly_income_field">
                        <div class="form-group">
                            <label for="monthly_income">Daily Cost:</label>
                            <input type="text" class="form-control" id="monthly_income" name="monthly_income" readonly
                                   value="{{ $userInfoData['professionInfo']->monthly_income }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->employee_count)
                    <div class="col-6" id="employee_count_field">
                        <div class="form-group">
                            <label for="employee_count">Daily Cost:</label>
                            <input type="text" class="form-control" id="employee_count" name="employee_count"
                                   readonly
                                   value="{{ $userInfoData['professionInfo']->employee_count }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->pocket_money)
                    <div class="col-6" id="pocket_money_field">
                        <div class="form-group">
                            <label for="pocket_money">Daily Cost:</label>
                            <input type="text" class="form-control" id="pocket_money" name="pocket_money"
                                   readonly
                                   value="{{ $userInfoData['professionInfo']->pocket_money }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['professionInfo']->monthly_edu_expenses)
                    <div class="col-6" id="monthly_edu_expenses_field">
                        <div class="form-group">
                            <label for="monthly_edu_expenses">Daily Cost:</label>
                            <input type="text" class="form-control" id="monthly_edu_expenses"
                                   name="monthly_edu_expenses"
                                   readonly
                                   value="{{ $userInfoData['professionInfo']->monthly_edu_expenses }}">
                        </div>
                    </div>
                @endif

            </div>
        @else
            <h4>User information not available. Please Add.</h4>
        @endif
    </div>
@endsection
