@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Count Report</h1>
        <div class="row">
            @foreach($reportData as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 text-center" style="background-color: rgba(23,81,168,0.95);
                        border-radius: .5rem;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.125);
                        transition: background-color 0.2s ease-in-out;">
                        <div class="card-body">
                            <h5 class="card-title"
                                style="background-color: transparent; color: rgba(255, 255, 255, 0.8);">{{ $item['profession_type_name'] }}</h5>
                            <p class="card-text"
                               style="color: rgba(255, 255, 255, 0.8);
                                        padding: 5px;
                                        border-radius: 4px;
                                        display: inline;">
                                User count: {{ $item['count'] }}</p>
                            <p class="card-text"
                               style="color: rgba(255, 255, 255, 0.8); padding: 5px; border-radius: 4px; display: inline;">
                                Percentage: {{ number_format($item['percentage'], 2) }}%</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
