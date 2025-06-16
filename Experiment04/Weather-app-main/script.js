// Select the button element
const btn = document.getElementById("btn");

// Add event listener for button click
btn.addEventListener("click", async () => {
  // Using async/await
  const city = document.getElementById("city").value; // Get city name
  const apiKey = "171e009cae7e126fcbcec49c3a5cee6a";
  const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}`;

  try {
    const response = await fetch(url); // Fetch data using async/await
    const data = await response.json(); // Convert response to JSON

    if (data.cod === "404") {
      document.getElementById("result").innerHTML =
        "City not found. Try again!";
      return;
    }

    displayWeather(data); // Call function to display weather details
    displayGraph(data.main.temp, data.main.feels_like, data.main.humidity); // Show graph
  } catch (error) {
    console.error("Error fetching weather:", error);
  }
});

// Function to display weather information
const displayWeather = (data) => {
  const result = document.getElementById("result");
  result.innerHTML = `
        <h2 style="font-family: 'Alkatra', serif;">Weather of ${data.name}</h2>
        <h4>Temperature: ${Math.round(data.main.temp - 273.15)}°C</h4>
        <h4>Feels like: ${Math.round(data.main.feels_like - 273.15)}°C</h4>
        <h4>Humidity: ${data.main.humidity}%</h4>
        <h4>Pressure: ${data.main.pressure} hPa</h4>
        <h4>Wind speed: ${data.wind.speed} m/s</h4>
        <h4>Wind direction: ${data.wind.deg} degrees</h4>
    `;
};

// Function to display a simple weather graph using Chart.js
const displayGraph = (temp, feelsLike, humidity) => {
  const ctx = document.getElementById("weatherChart").getContext("2d");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Temperature (°C)", "Feels Like (°C)", "Humidity (%)"],
      datasets: [
        {
          label: "Weather Data",
          data: [
            Math.round(temp - 273.15),
            Math.round(feels_like - 273.15),
            humidity,
          ],
          backgroundColor: ["red", "orange", "blue"],
          borderColor: ["darkred", "darkorange", "darkblue"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
};

// Display current date
document.addEventListener("DOMContentLoaded", () => {
  let today = new Date();
  let formattedDate = today.toDateString();
  document.getElementById("current-date").innerText =
    "Today's Date: " + formattedDate;
});

