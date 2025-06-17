# Experiment16 – ✅ Django TODO App

![Django](https://img.shields.io/badge/Django-5.2-green.svg)

A minimal TODO list web application built using Django, featuring a clean user interface and basic task management capabilities including adding and viewing tasks.

---

## 🎯 Aim

To develop a **TODO list backend application** using Django, allowing users to **add, view, and manage** tasks via a functional web interface.

---

## 📖 Description

This experiment illustrates how to create a server-rendered task management application using Django’s **Model-View-Template (MVT)** architecture.

The application allows users to:

- Create new TODO tasks
- View the list of existing tasks
- Mark tasks as complete (if extended)
- Learn and apply Django’s core concepts such as:
  - Models
  - Views
  - URL routing
  - Templates
  - Forms

Ideal for **beginners** looking to gain practical experience in Django backend development and template rendering.

---

## 🧱 Project Structure

```bash

    Experiment16/
    │
    ├── manage.py                  # Django CLI entry point
    ├── db.sqlite3                 # SQLite database file
    │
    ├── todo\_project/              # Django project configuration
    │   ├── init.py
    │   ├── settings.py            # Global settings
    │   ├── urls.py                # Root URL dispatcher
    │   ├── wsgi.py
    │   └── asgi.py
    │
    ├── todo/                      # Main Django app
    │   ├── admin.py               # Admin config
    │   ├── apps.py
    │   ├── models.py              # Task model
    │   ├── forms.py               # Task form (optional)
    │   ├── views.py               # View functions
    │   ├── urls.py                # App-level URL routing
    │   ├── templates/
    │   │   └── todo/
    │   │       └── index.html     # HTML template for task UI
    │   └── migrations/            # Django migrations
    │
    └── README.md                  # Project documentation

```

---

## ⚙️ Installation & Setup

### 🔧 Prerequisites

- Python 3.8+
- pip (Python package manager)
- VS Code or any text editor
- Basic Django knowledge

---

## 🚀 Steps to Run the Project

- Create the Django Project and App

```bash
django-admin startproject todo_project
cd todo_project
python manage.py startapp todo
```

---

- Define the Model in `todo/models.py`

```python
from django.db import models

class Task(models.Model):
    title = models.CharField(max_length=200)
    completed = models.BooleanField(default=False)

    def __str__(self):
        return self.title
```

---

- Create and Apply Migrations

```bash
python manage.py makemigrations
python manage.py migrate
```

---

- Set Up Views, Templates, and URLs

    -- In `views.py`, write logic to fetch and render tasks.
    -- Create `templates/todo/index.html` for the task interface.
    -- Add URL routes in `todo/urls.py` and include them in `todo_project/urls.py`.

---

- Run the Development Server

```bash
python manage.py runserver
```

---

- Open the App in Browser

`http://127.0.0.1:8000/`

---

## 🧩 Features

- Simple and clean task UI
- Add and list TODO tasks
- Easily extendable to add "delete" and "mark complete" features
- Based on Django MVT architecture

---

## 👨‍💻 Author

Developed as part of **Django Experiment 16 – TODO List App**
Focused on backend logic, model-view-template design, and HTML rendering.

---
