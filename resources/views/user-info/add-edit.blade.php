<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create/Update Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <a href="{{ route('user-info.index') }}" class="btn btn-info btn-sm float-right">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
             viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        Back</a>

    <h2>Create/Update Data</h2>

    <form method="POST" action="{{ route('user-info.store') }}">
        @csrf
        <div class="form-group">
            <label for="profession_type">Profession Type:</label>
            <select class="form-control" id="profession_type" name="profession_type" required>
                <option value="" disabled @if($userInfoData['status'] === 'error') selected @endif>Select
                    Profession
                </option>
                <option value="1"
                        @if($userInfoData['status'] !== 'error' && $userInfoData['userInfo']->profession_type == 1) selected @endif>
                    Student
                </option>
                <option value="2"
                        @if($userInfoData['status'] !== 'error' && $userInfoData['userInfo']->profession_type == 2) selected @endif>
                    Businessman
                </option>
                <option value="3"
                        @if($userInfoData['status'] !== 'error' && $userInfoData['userInfo']->profession_type == 3) selected @endif>
                    Service Holder
                </option>
            </select>
        </div>

        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" disabled @if($userInfoData['status'] === 'error') selected @endif>Select
                            Gender
                        </option>
                        <option value="male"
                                @if($userInfoData['status'] !== 'error' && $userInfoData['userInfo']->gender == 'male') selected @endif>
                            Male
                        </option>
                        <option value="female"
                                @if($userInfoData['status'] !== 'error' && $userInfoData['userInfo']->gender == 'female') selected @endif>
                            Female
                        </option>
                        <option value="other"
                                @if($userInfoData['status'] !== 'error' && $userInfoData['userInfo']->gender == 'other') selected @endif>
                            Other
                        </option>
                    </select>

                </div>
            </div>
            <div class="col-6" id="company_name_field">
                <div class="form-group">
                    <label for="company_name">Company Name:</label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->company_name}}">
                </div>
            </div>

            <div class="col-6" id="institute_name_field">
                <div class="form-group">
                    <label for="institute_name">Institute Name:</label>
                    <input type="text" class="form-control" id="institute_name" name="institute_name"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->institute_name}}">
                </div>
            </div>
            <div class="col-6" id="daily_cost_field">
                <div class="form-group">
                    <label for="daily_cost">Daily Cost:</label>
                    <input type="text" class="form-control" id="daily_cost" name="daily_cost"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->daily_cost}}">
                </div>
            </div>
            <div class="col-6" id="monthly_cost_field">
                <div class="form-group">
                    <label for="monthly_cost">Monthly Cost:</label>
                    <input type="text" class="form-control" id="monthly_cost" name="monthly_cost"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->monthly_cost}}">
                </div>
            </div>
            <div class="col-6" id="monthly_income_field">
                <div class="form-group">
                    <label for="monthly_income">Monthly Income:</label>
                    <input type="text" class="form-control" id="monthly_income" name="monthly_income"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->monthly_income}}">
                </div>
            </div>
            <div class="col-6" id="employee_count_field">
                <div class="form-group">
                    <label for="employee_count">Employee Count:</label>
                    <input type="text" class="form-control" id="employee_count" name="employee_count"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->employee_count}}">
                </div>
            </div>
            <div class="col-6" id="pocket_money_field">
                <div class="form-group">
                    <label for="pocket_money">Pocket Money:</label>
                    <input type="text" class="form-control" id="pocket_money" name="pocket_money"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->pocket_money}}">
                </div>
            </div>
            <div class="col-6" id="monthly_edu_expenses_field">
                <div class="form-group">
                    <label for="monthly_edu_expenses">Monthly Educational Expenses:</label>
                    <input type="text" class="form-control" id="monthly_edu_expenses" name="monthly_edu_expenses"
                           value="{{$userInfoData['status'] !== 'error' && $userInfoData['professionInfo']->monthly_edu_expenses}}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        function showRelevantFields(selectedProfession) {
            $('#monthly_edu_expenses_field, #pocket_money_field, #company_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field, #employee_count_field, #institute_name_field').hide();

            if (selectedProfession === '2') {
                $('#company_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field, #employee_count_field').show();
            } else if (selectedProfession === '3') {
                $('#company_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field').show();
            } else if (selectedProfession === '1') {
                $('#pocket_money_field, #monthly_edu_expenses_field, #institute_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field').show();
            }
        }

        showRelevantFields('');

        const initialProfessionType = $('#profession_type').val();

        showRelevantFields(initialProfessionType);

        $('#profession_type').change(function () {
            const selectedProfession = $(this).val();
            console.log(selectedProfession);

            showRelevantFields(selectedProfession);
        });
    });
</script>


</body>
</html>
