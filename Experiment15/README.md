
---

```markdown
# Experiment15 – 🌤️ Django Weather App

![Django](https://img.shields.io/badge/Django-5.2-green.svg)

A weather dashboard built using Django and Chart.js to display real-time and historical weather data. The application dynamically renders weather information using Django templates and visualizes temperature trends over the past 5 days using a responsive line chart.

---

## 🎯 Aim

To develop a **weather application** using Django templating that shows current weather conditions along with a **Chart.js-powered** line graph representing the last 5 days' temperature data.

---

## 📖 Description

This experiment demonstrates the integration of backend data processing in Django with frontend dynamic chart rendering using **Chart.js**. Users can view current weather information like temperature, description, and icon, along with a **visual history** of temperature changes.

The application covers:

- Django template rendering
- Chart.js integration
- Basic API usage (weather data)
- Dynamic JavaScript data rendering using template tags

---

## 🧱 Project Structure

```

weatherproject/
│
├── db.sqlite3                 # SQLite database file
├── manage.py                  # Django CLI management script
│
├── weather/                   # Main application
│   ├── admin.py
│   ├── apps.py
│   ├── migrations/
│   │   └── init.py
│   ├── models.py              # (Unused if data is not stored)
│   ├── views.py               # Logic to fetch and send weather data
│   ├── urls.py                # App-level routing
│   ├── templates/
│   │   └── weather/
│   │       └── index.html     # Main weather dashboard with Chart.js
│   └── tests.py
│
├── weatherproject/            # Project-level settings
│   ├── settings.py
│   ├── urls.py
│   ├── asgi.py
│   └── wsgi.py
│
└── README.md                  # Project documentation

````

---

## ⚙️ Installation & Setup

### 🔧 Prerequisites

- Python 3.x
- Django (`pip install django`)
- Basic understanding of Django views/templates
- Internet access for loading **Chart.js via CDN**

---

## 🚀 Steps to Run the Project

1. **Create the Django Project and App**

   ```bash
   django-admin startproject weatherproject
   cd weatherproject
   python manage.py startapp weather
````

2. **Configure URLs and Views**

   * In `weather/urls.py`, define routes for displaying weather.
   * In `weather/views.py`, create logic to fetch weather data and return it to the template context.

3. **Create HTML Template**

   * Save `index.html` in `weather/templates/weather/`
   * Embed Django template tags to inject weather data.
   * Integrate Chart.js using the official CDN:

     ```html
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     ```

4. **Run the Development Server**

   ```bash
   python manage.py runserver
   ```

5. **View the App**

   Open your browser and navigate to:

   ```
   http://127.0.0.1:8000/
   ```

---

## 🌦️ Features

* Current weather display with icon and description
* 5-day temperature trend visualized in a Chart.js line chart
* Responsive frontend UI using HTML + JavaScript
* Server-rendered content with Django template tags

---

## 👨‍💻 Author

Developed as part of **Django Experiments** to demonstrate backend rendering and chart-based visualization using web APIs and JavaScript libraries.

---