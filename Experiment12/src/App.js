import React, { useEffect, useState } from 'react';
import './App.css';
import { getCurrentWeather, getHistoricalWeather } from './services/weatherService';
import WeatherChart from './components/WeatherChart';

function App() {
  const [currentWeather, setCurrentWeather] = useState(null);
  const [historicalData, setHistoricalData] = useState([]);
  const city = 'Delhi';

  useEffect(() => {
    const fetchData = async () => {
      try {
        const current = await getCurrentWeather(city);
        setCurrentWeather(current);

        const lat = current.coord.lat;
        const lon = current.coord.lon;

        // Get timestamps for past 5 days
        const timestamps = [...Array(5).keys()].map(i =>
          Math.floor(Date.now() / 1000) - i * 86400
        );

        const history = await getHistoricalWeather(lat, lon, timestamps);
        setHistoricalData(history);
      } catch (error) {
        console.error('Error fetching weather data:', error);
      }
    };
    fetchData();
  }, []);

  return (
    <div className="container">
      <h2>Weather in {city}</h2>
      {currentWeather && (
        <div>
          <p><strong>🌡️ Temp:</strong> {currentWeather.main.temp} °C</p>
          <p><strong>☁️ Weather:</strong> {currentWeather.weather[0].description}</p>
        </div>
      )}
      <div className="chart-container">
        <h3>Past 5 Days Temperature</h3>
        {historicalData.length > 0 && <WeatherChart historicalData={historicalData} />}
      </div>
    </div>
  );
}

export default App;
