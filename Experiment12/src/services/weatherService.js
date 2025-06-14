import axios from 'axios';

const API_KEY = '171e009cae7e126fcbcec49c3a5cee6a';
const BASE_URL = 'https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}';

export const getCurrentWeather = async (city) => {
  const response = await axios.get(`${BASE_URL}/weather`, {
    params: {
      q: city,
      appid: API_KEY,
      units: 'metric',
    },
  });
  return response.data;
};

export const getHistoricalWeather = async (lat, lon, timestamps) => {
  const promises = timestamps.map((timestamp) =>
    axios.get(`${BASE_URL}/onecall/timemachine`, {
      params: {
        lat,
        lon,
        dt: timestamp,
        appid: API_KEY,
        units: 'metric',
      },
    })
  );
  const results = await Promise.all(promises);
  return results.map(res => res.data);
};
