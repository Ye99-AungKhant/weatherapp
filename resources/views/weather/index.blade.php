@extends('weather.header')

@section('content')

    <div class="itemCenter">
        <h3>Search Weather of Cities</h3>
        <form action="{{ route('weather.get') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="city">Enter City Name:</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}">
            </div>
            <button type="submit" class="btn">Search</button>
        </form>
        @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    </div>

@endif

@endsection