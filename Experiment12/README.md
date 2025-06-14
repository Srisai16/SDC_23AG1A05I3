PROGRAM 12 – React Weather Services

AIM
To develop a weather information web application using React that fetches current and historical weather data from OpenWeatherMap API and visualizes it using Chart.js.

DESCRIPTION
This experiment demonstrates how to create a real-time weather service using React.js. The application displays the current weather and temperature trends from the past 5 days in a graphical format. It utilizes OpenWeatherMap API  for weather data and Chart.js for plotting charts. The project also includes a Canvas-style user interface using CSS for a modern and clean layout. This experiment helps in understanding API integration, asynchronous data fetching, chart rendering, and component-based UI design in React.

PROJECT STRUCTURE
weather-app/
│
├── public/
│ └── index.html # HTML template
│
├── src/
│ ├── components/
│ │ └── WeatherChart.js # Chart.js graph component
│ ├── services/
│ │ └── weatherService.js # API service to fetch weather data
│ ├── App.js # Main component with logic and UI
│ ├── App.css # Canvas-style CSS styling
│ ├── index.js # Entry point of the React app
│ └── index.css # Global styles
│
├── package.json # Project metadata and dependencies
└── README.md # Project documentation


INSTALLATION & SETUP
PREREQUISITES
•	Node.js & npm
•	VS Code or any code editor
•	Basic knowledge of React and APIs

STEPS TO RUN THE PROJECT
1.Create Project using Create React App
npx create-react-app weather-app
cd weather-app

2.Install Required Libraries
npm install chart.js react-chartjs-2

3.Set Up File Structure
Create folders: src/components/ and src/services/
4.Implement Weather Service  Experiment12\public\image.png
Inside src/services/weatherService.js, add API logic using OpenWeatherMap.
5.Create Chart Component
Inside src/components/WeatherChart.js, implement a Line chart using Chart.js.
6.Build the App
•	Use App.js to integrate current and historical weather data.
•	Style using App.css to achieve canvas-style card UI.
7.Run the Project
npm start

8.Visit in Browser
http://localhost:3000

LICENSE
This project is licensed under the MIT License.
