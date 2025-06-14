import requests
from django.shortcuts import render
from datetime import datetime, timedelta

API_KEY = 'your_openweathermap_api_key'  # Replace with your API key

def index(request):
    city = 'London'  # You can make this dynamic later

    # Current Weather
    current_url = f"http://api.openweathermap.org/data/2.5/weather?q={city}&appid={API_KEY}&units=metric"
    current_data = requests.get(current_url).json()

    current_weather = {
        'city': city,
        'temperature': current_data['main']['temp'],
        'description': current_data['weather'][0]['description'],
        'icon': current_data['weather'][0]['icon'],
    }

    # Historical Weather (past 5 days using One Call API - requires lat/lon)
    lat = current_data['coord']['lat']
    lon = current_data['coord']['lon']

    historical = []
    for i in range(1, 6):
        dt = int((datetime.utcnow() - timedelta(days=i)).timestamp())
        url = f"https://api.openweathermap.org/data/2.5/onecall/timemachine?lat={lat}&lon={lon}&dt={dt}&appid={API_KEY}&units=metric"
        res = requests.get(url).json()
        daily_temp = res['current']['temp']
        historical.append({
            'date': (datetime.utcnow() - timedelta(days=i)).strftime('%Y-%m-%d'),
            'temp': daily_temp
        })

    context = {
        'current': current_weather,
        'historical': historical[::-1]  # reverse to get oldest to latest
    }
    return render(request, 'weather/index.html', context)
