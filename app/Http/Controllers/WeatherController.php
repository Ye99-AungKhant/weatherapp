<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        return view('weather.index');
    }

    public function getWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');
        $apiKey = env("OPENWEATHER_API_KEY");
        $url = "https://api.openweathermap.org/data/2.5/weather";


        try {
            $response = Http::timeout(30)->get($url, [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);
            if ($response->failed() || $response->status() !== 200) {
                throw new \Exception('Failed to get weather data.');
            }
            $weatherData = $response->json();

            $timestamp = $weatherData['dt'];
            $timezoneOffset = $weatherData['timezone'];
            $localDateTime = Carbon::createFromTimestamp($timestamp + $timezoneOffset);

            return view('weather.show', [
                'city' => $weatherData['name'],
                'temperature' => $weatherData['main']['temp'],
                'description' => $weatherData['weather'][0]['description'],
                'datetime' => $localDateTime->format('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['city' => 'Could not get weather data. Please check the city name and try again.']);
        }
    }
}
