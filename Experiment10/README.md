
---

```markdown
# Experiment10 - 📘 Student CRUD REST API with Express & JWT

![Node.js](https://img.shields.io/badge/Node.js-v14%2B-green)
![Express](https://img.shields.io/badge/Express-v4.18%2B-blue)
![JWT](https://img.shields.io/badge/JWT-Authentication-orange)
![MongoDB](https://img.shields.io/badge/MongoDB-NotUsed-lightgrey)

A simple RESTful API built with **Express.js** that demonstrates full **CRUD operations** on student data with **JWT-based authentication** and middleware.

---

## 📑 Table of Contents

- [🎯 Features](#-features)
- [🧰 Technologies Used](#-technologies-used)
- [📁 Project Structure](#-project-structure)
- [⚙️ Installation & Setup](#️-installation--setup)
- [🔐 Authentication](#-authentication)
- [🧪 API Usage](#-api-usage)
- [🧪 Sample Output](#-sample-output)
- [📷 Screenshot](#-screenshot)
- [📜 License](#-license)

---

## 🎯 Features

- 🔐 JWT-based authentication system
- 📝 Full CRUD operations on student records
- 🛡️ Secured routes using custom middleware
- ✅ Organized MVC-style folder structure
- 📦 Simple and minimal setup using only core tools

---

## 🧰 Technologies Used

- **Backend**: Node.js, Express.js
- **Authentication**: JSON Web Tokens (JWT)
- **Environment Management**: dotenv

---

## 📁 Project Structure

Experiment10/
├── app.js                          # Main entry point for the server (Express app)
├── index.js                        # Optional alternative entry file or setup
├── JWT_SECRET.env                  # Environment file storing JWT secret key
├── package.json                    # Project config and dependencies
├── package-lock.json               # Dependency lock file
├── studentmanageAPI.png            # Screenshot of API usage
├── studentmanagement.png           # Screenshot of UI or API results
├── README.md                       # Project documentation

├── controllers/
│   └── userController.js           # Controller handling user-related logic

├── middleware/
│   └── authMiddleware.js           # Middleware to authenticate JWT tokens

├── routes/
│   └── students.js                 # Route definitions for student API endpoints

---

## ⚙️ Installation & Setup

### ✅ Prerequisites

- Node.js v14 or later
- Postman or any API testing tool

### 🔧 Steps to Run

1. **Clone the repository**
   ```bash
   git clone https://github.com/Srisai16/SDC_23AG1A05I3.git
   cd SDC_23AG1A05I3/Experiment10
````

2. **Install dependencies**

   ```bash
   npm install
   ```

3. **Set environment variables**

   Create a file named `.env` or `JWT_SECRET.env` and add:

   ```env
   JWT_SECRET=your_super_secret_key
   ```

4. **Start the server**

   ```bash
   node index.js
   ```

---

## 🔐 Authentication

Use this endpoint to log in and receive a token:

### `POST /login`

**Request:**

```json
{
  "username": "admin",
  "password": "admin123"
}
```

**Response:**

```json
{
  "token": "eyJhbGciOiJIUzI1NiIs..."
}
```

Use the returned token in the Authorization header to access protected routes:

```
Authorization: Bearer <your_token_here>
```

---

## 🧪 API Usage

All student-related endpoints require a valid JWT token.

### 🔍 Get All Students

```
GET /students
```

### ➕ Create a New Student

```
POST /students
```

**Body:**

```json
{
  "name": "John",
  "age": 22,
  "course": "Computer Science"
}
```

### 📝 Update Student

```
PUT /students/:id
```

**Body:**

```json
{
  "age": 23
}
```

### ❌ Delete Student

```
DELETE /students/:id
```

---

## 🧪 Sample Output

```
Server running on http://localhost:3000
Token verified successfully
Student data retrieved
Student added successfully
Student updated successfully
Student deleted successfully
```

---

## 📷 Screenshot

🖼️ Interface tested on `http://localhost:3000`:

![Screenshot](./studentmanagement.png)
![Screenshot](./studentmanageAPI.png)

---
