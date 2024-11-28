@extends('weather.header')

@section('content')
    <h3 class="itemCenter">Weather Information</h3>
    <p><strong>City:</strong> {{ $city }}</p>
    <p><strong>Temperature:</strong> {{ $temperature }}°C</p>
    <p><strong>Weather:</strong> {{ ucfirst($description) }}</p>
    <p><strong>Date & Time:</strong> {{ $datetime }}</p>
    <div class="itemCenter">
        <a href="{{ route('weather.form') }}" class="btn">Search Again</a>
    </div>
@endsection