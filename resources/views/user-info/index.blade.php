@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('user-info.index') }}" class="btn btn-info btn-sm float-right">

            Back
        </a>

        <h2>User Info details</h2>

        @if($userInfoData['userInfo'])
            <div class="form-group">
                <label for="profession_type">Profession Type:</label>
                <input type="text" class="form-control" id="profession_type" name="profession_type" readonly
                       value="{{ $userInfoData['userInfo']->profession_type }}">
            </div>

            <div class="row">
                @if($userInfoData['userInfo']->gender)
                    <div class="col-6">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <input type="text" class="form-control" id="gender" name="gender" readonly
                                   value="{{ $userInfoData['userInfo']->gender }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['userInfo']->profession_type == 1 && $userInfoData['professionInfo']->institute_name)
                    <div class="col-6" id="institute_name_field">
                        <div class="form-group">
                            <label for="institute_name">Institute Name:</label>
                            <input type="text" class="form-control" id="institute_name" name="institute_name" readonly
                                   value="{{ $userInfoData['professionInfo']->institute_name }}">
                        </div>
                    </div>
                @endif

                @if($userInfoData['userInfo']->profession_type == 1 && $userInfoData['professionInfo']->daily_cost)
                    <div class="col-6" id="daily_cost_field">
                        <div class="form-group">
                            <label for="daily_cost">Daily Cost:</label>
                            <input type="text" class="form-control" id="daily_cost" name="daily_cost" readonly
                                   value="{{ $userInfoData['professionInfo']->daily_cost }}">
                        </div>
                    </div>
                @endif

                <!-- Add similar checks for other attributes -->

            </div>
        @else
            <p>User information not available.</p>
        @endif
    </div>
@endsection
