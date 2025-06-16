
---

```markdown
# Experiment14 – 🎓 Django Student Management System

![Django](https://img.shields.io/badge/Django-5.2-green.svg)

A basic Student Management web application built using **Django 5.2**. This project demonstrates user registration, login, and simple page navigation using templates and views — ideal for learning core web development concepts with Django.

---

## 🎯 Aim

To develop a **student management system** using the Django web framework, enabling users to register, log in, and navigate between pages such as Home, About, and Contact. The interface follows a clean and simple Canvas-style design.

---

## 📖 Description

This experiment introduces the creation of a basic Django web app to demonstrate key backend concepts:

- URL routing
- Views and templates
- User authentication (register/login)
- Static file handling
- Template inheritance using `base.html`

The project is intended for beginners to get hands-on with Django's project and app structure, templating, and MVC-style architecture.

---

## 🧱 Project Structure

```

Experiment14/
│
├── core/
│   ├── admin.py
│   ├── apps.py
│   ├── migrations/
│   │   └── init.py
│   ├── models.py
│   ├── tests.py
│   ├── views.py              # All view functions
│   ├── urls.py               # App-level URLs
│   ├── templates/            # HTML templates
│   │   ├── base.html         # Base layout
│   │   ├── home.html         # Homepage
│   │   ├── about.html        # About page
│   │   ├── contact.html      # Contact page
│   │   ├── login.html        # Login page
│   │   └── register.html     # Registration page
│
├── student\_mgmt/
│   ├── settings.py           # Project settings
│   ├── urls.py               # Root URL dispatcher
│   ├── asgi.py
│   └── wsgi.py
│
├── static/
│   └── style.css             # Global CSS styles
│
├── db.sqlite3                # SQLite database
├── manage.py                 # Django project CLI tool
└── README.md                 # Project documentation

````

---

## ⚙️ Installation & Setup

### 🔧 Prerequisites

- Python 3.x
- Django 5.2
- Code editor (VS Code recommended)
- Basic knowledge of Python and Django

### 🛠 Steps to Run the Project

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd student_mgmt
````

2. **Create & Activate a Virtual Environment**
   (Recommended to isolate project dependencies)

   * On Windows:

     ```bash
     python -m venv venv
     venv\Scripts\activate
     ```

   * On Linux/macOS:

     ```bash
     python3 -m venv venv
     source venv/bin/activate
     ```

3. **Install Django**

   ```bash
   pip install django==5.2
   ```

4. **Apply Migrations**

   ```bash
   python manage.py migrate
   ```

5. **Create Superuser (Optional for Admin Panel)**

   ```bash
   python manage.py createsuperuser
   ```

6. **Run Development Server**

   ```bash
   python manage.py runserver
   ```

7. **Open in Browser**
   Visit the local server:

   ```
   http://127.0.0.1:8000/
   ```

---

## 🌐 Pages Available

| Page     | URL Path     | Description                 |
| -------- | ------------ | --------------------------- |
| Home     | `/`          | Landing page                |
| About    | `/about/`    | Info about the app/project  |
| Contact  | `/contact/`  | Contact form or static info |
| Login    | `/login/`    | User login form             |
| Register | `/register/` | User registration form      |

---


## 👨‍💻 Author

Developed as part of the Django experiment series to learn web backend fundamentals with authentication and templating in Django.

---
