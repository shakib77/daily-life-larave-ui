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
    <h2>Create/Update Data</h2>

    <form id="dataForm">
        @csrf

        <div class="form-group">
            <label for="profession_type">Profession Type:</label>
            <select class="form-control" id="profession_type" name="profession_type" required>
                <option value="student">Student</option>
                <option value="businessman">Businessman</option>
                <option value="service_holder">Service Holder</option>
            </select>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group" id="company_name_field">
                    <label for="company_name">Company Name:</label>
                    <input type="text" class="form-control" id="company_name" name="company_name">
                </div>

                <div class="form-group" id="daily_cost_field">
                    <label for="daily_cost">Daily Cost:</label>
                    <input type="text" class="form-control" id="daily_cost" name="daily_cost">
                </div>

                <div class="form-group" id="monthly_cost_field">
                    <label for="monthly_cost">Monthly Cost:</label>
                    <input type="text" class="form-control" id="monthly_cost" name="monthly_cost">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group" id="monthly_income_field">
                    <label for="monthly_income">Monthly Income:</label>
                    <input type="text" class="form-control" id="monthly_income" name="monthly_income">
                </div>

                <div class="form-group" id="employee_count_field">
                    <label for="employee_count">Employee Count:</label>
                    <input type="text" class="form-control" id="employee_count" name="employee_count">
                </div>

                <!-- Additional fields for student -->
                <div class="form-group" id="student_field">
                    <label for="school_name">School Name:</label>
                    <input type="text" class="form-control" id="school_name" name="school_name">
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
        $('#profession_type').change(function () {
            var selectedProfession = $(this).val();

            // Hide all fields
            $('#company_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field, #employee_count_field, #student_field').hide();

            // Show fields based on selected profession
            if (selectedProfession === 'businessman') {
                $('#company_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field, #employee_count_field').show();
            } else if (selectedProfession === 'service_holder') {
                $('#company_name_field, #daily_cost_field, #monthly_cost_field, #monthly_income_field').show();
            } else if (selectedProfession === 'student') {
                $('#student_field').show();
            }
        });
    });
</script>

</body>
</html>
