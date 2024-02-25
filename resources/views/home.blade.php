@extends('layouts.app')

@section('content')
    <div class="card-container" style="display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
            animation: floatAnimation 1s infinite alternate;">
        <div class="card" style="
        width: 500px;
        background-color: #093d88;
        box-shadow: 0 4px 8px rgb(23,58,199);
        ">
            <div class="card-body">
                <div style="
                    margin-bottom: 50px;
                    font-size: larger;
                    font-weight: bold; text-align: center; color: #fff;"
                >Welcome to Daily Life Manager, <span>Experience awesome feature</span>
                </div>
            </div>
        </div>
    </div>
@endsection
