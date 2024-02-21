@extends('layouts.app')

@section('content')
    <div class="card-container" style="display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
            animation: floatAnimation 1s infinite alternate;">
        <div class="card" style="
        width: 500px;
        background-color: #6a1b9a;
        box-shadow: 0 4px 8px rgb(151,28,224);
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
