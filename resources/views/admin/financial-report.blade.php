@extends('layouts.app')

@section('content')
    <div class="container pl-5 pr-5">
        <h1>Reports</h1>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="profession_type">Profession Type:</label>
                    <select class="form-control" id="profession_type" name="profession_type">
                        <option value="" disabled>Select Profession</option>
                        <option value="1">Student</option>
                        <option value="2">Businessman</option>
                        <option value="3">Service Holder</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="" disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="financial_condition">Financial Condition:</label>
                    <select class="form-control" id="financial_condition" name="financial_condition">
                        <option value="" disabled>Select Financial Condition</option>
                        <option value="1">Rich</option>
                        <option value="2">Solvent</option>
                        <option value="3">Poor</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <button class="btn btn-primary mt-4" id="searchButton">Search</button>
            </div>
        </div>
        <div class="row mt-4" id="tableContainer">
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#searchButton').click(function () {
                var professionType = $('#profession_type').val();
                var gender = $('#gender').val();
                var financialCondition = $('#financial_condition').val();

                var data = {};

                if (professionType) {
                    data.profession_type = professionType;
                }
                if (gender) {
                    data.gender = gender;
                }

                if (financialCondition) {
                    data.financial_condition = financialCondition;
                }

                $.ajax({
                    url: '{{ route("financial-report-filter-data") }}',
                    type: 'GET',
                    data: data,
                    success: function (response) {
                        if (response.length > 0) {
                            var html = '<div class="col"><table class="table"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr></thead><tbody>';

                            response.forEach(function(user, index) {
                                html += '<tr><td>' + (index + 1) + '</td><td>' + user.name + '</td><td>' + user.email + '</td><td><a href="/user/' + user.user_id + '" class="btn btn-info">View Profile</a></td></tr>';
                            });

                            html += '</tbody></table></div>';

                            $('#tableContainer').html(html);
                        } else {
                            $('#tableContainer').html('<div class="col"><p>No data available</p></div>');
                        }
                    },

                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
