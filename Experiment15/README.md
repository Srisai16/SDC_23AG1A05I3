Program 15 - Django Weather App

AIM
To develop a weather application frontend using Django templating that displays current weather information along with a line chart showing past 5 days' temperature trends using Chart.js.

DESCRIPTION
This experiment demonstrates how to build a weather app using Django templates and Chart.js for visualization. The app fetches weather data, including current temperature, description, and icon, and renders it dynamically on a webpage. It also displays historical temperature data for the past 5 days as a line chart. This project is ideal for beginners to learn Django templating, integration of JavaScript libraries like Chart.js, and dynamic data visualization on the frontend.

PROJECT STRUCTURE
weather-app/
│
├── templates/
│   └── index.html          # Main HTML template with Django template tags and Chart.js integration
│
├── static/
│   └── (optional static files like CSS or JS if any)
│
├── views.py               # Django view to pass weather data to template
├── urls.py                # URL configuration for the app
├── settings.py            # Django project settings
│
└── README.md              # Project documentation


 
INSTALLATION & SETUP
PREREQUISITES
•	Python 3.x
•	Django installed (pip install django)
•	Basic knowledge of Django templating and Python
•	Chart.js included via CDN (no extra installation needed)

STEPS TO RUN THE PROJECT
1.Create Django Project & App
django-admin startproject weather_project
cd weather_project
python manage.py startapp weather_app

2.Setup URL and Views
Add URL route to render the weather template.
Create view function to fetch and pass weather data (current + historical) as context.
3.Create Template
Place index.html inside templates/ folder.
Use Django templating tags to insert weather data into the HTML and JavaScript.
4.Run the Server
python manage.py runserver

5.Visit in Browser
Open your browser and go to:
http://127.0.0.1:8000/

LICENSE
This project is licensed under the MIT License.
