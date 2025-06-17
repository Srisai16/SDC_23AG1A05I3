# **Experiment07 - Shopping Cart Web Application**

## **📌 Project Overview**

A Java-based **Servlet web application** that handles:

- ✅ User registration & login
- ✅ Shopping cart management (add/view items)
- ✅ MySQL database integration

Built using:

- **Java Servlets** (Backend logic)
- **Apache Tomcat** (Servlet container)
- **MySQL** (Database storage)
- **Eclipse IDE** (Development environment)

---

## **🛠 Setup Instructions**

### **Prerequisites**

1. **Java JDK 8+** (Recommended: JDK 11)
2. **Eclipse IDE for Enterprise Java** (With "Web Development" tools)
3. **Apache Tomcat 9.x** (Download from [tomcat.apache.org](https://tomcat.apache.org/))
4. **MySQL Database** (Local or remote)

---

## **⚙ Installation Steps**

### **1. Clone the Project**

```bash
git clone https://github.com/Srisai16/SDC_23AG1A05I3.git
```

### **2. Import into Eclipse**

1. Open **Eclipse** → **File → Import → Existing Projects into Workspace**.
2. Select the project folder → **Finish**.

### **3. Configure Tomcat**

1. Go to **Window → Preferences → Server → Runtime Environments**.
2. Add your **Tomcat installation directory**.

### **4. Set Up MySQL Database**

1. Create a database `sdc`:

   ```sql
   CREATE DATABASE sdc;
   ```

2. Run the SQL script provided in `/database/setup.sql` to create tables.

### **5. Update Database Credentials**

Modify `DBUtil.java` with your MySQL credentials:

```java
String url = "jdbc:mysql://localhost:3306/sdc";
String user = "your_username";
String pass = "your_password";
```

---

## **🚀 Running the Application**

1. **Right-click project** → **Run As → Run on Server** (Select Tomcat).
2. Access the app at:

   `http://localhost:8080/ShoppingCart/`

### **Endpoints**

| Action | URL | Method |
|--------|-----|--------|
| User Registration | `/cart?action=register` | POST |
| User Login | `/cart?action=login` | POST |
| Add to Cart | `/cart?action=addToCart` | POST |

---

## **🔍 Testing the Application**

### **1. Using a Web Browser**

- Open:

  `http://localhost:8080/ShoppingCart/cart?action=login`

### **2. Using Postman (API Testing)**

- Send a **POST** request to:
  `http://localhost:8080/ShoppingCart/cart`
  With parameters:

  ```json
  {
    "action": "register",
    "username": "testuser",
    "password": "password123"
  }
  ```

---

## **📂 Project Structure**

```bash
    Experiment07/
    ├── DBUtil.java                            # Utility class for DB connections (JDBC)
    ├── DBUtil.class                           # Compiled Java class
    ├── ShoppingCartController.java            # Servlet controller for shopping cart
    ├── ShoppingCartController.class           # Compiled servlet class
    ├── jakarta.servlet-api-5.0.0-javadoc.jar  # Servlet API documentation JAR
    ├── javax.servlet-api-3.0.1.jar            # Servlet API JAR (for compilation)
    ├── mysql-connector-j-9.3.0.jar            # MySQL JDBC driver

    ├── WebContent/                            # Web application content (deployed in server)
    │   ├── index.html                         # Home page
    │   ├── index.php                          # PHP version of homepage
    │   ├── cart.html                          # Static cart page
    │   ├── cart.php                           # Dynamic cart handler
    │   ├── login.html                         # Login UI
    │   ├── login.php                          # Login backend
    │   ├── logout.php                         # Logout logic
    │   ├── register.php                       # Registration backend
    │   ├── registration.html                  # Registration form
    │   ├── product-detail.php                 # Product detail page
    │   ├── products.php                       # Product listing
    │   ├── style.css                          # Main CSS styles
    │   ├── Cart-FBS-eBooks-Store.png          # Screenshot/image used in the UI
    │   ├── test.php                           # Optional testing PHP script

    │   ├── ajax/                              # AJAX endpoints
    │   │   ├── add_to_cart.php
    │   │   └── apply_coupon.php

    │   ├── includes/                          # Common include files
    │   │   ├── config.php
    │   │   ├── db.php
    │   │   ├── footer.php
    │   │   └── header.php

    │   ├── js/                                # JavaScript files
    │   │   ├── cart.js
    │   │   └── main.js

    │   ├── images/                            # Product and logo images
    │   │   ├── c++DSA.jpg
    │   │   ├── ebooks.jpg
    │   │   ├── fbslogo.jpg
    │   │   ├── JSessentials.jpg
    │   │   ├── masteringjava.jpg
    │   │   └── pybeg.jpg

    │   └── WEB-INF/                           # Java EE configuration
    │       ├── web.xml                        # Web application deployment descriptor
    │       └── lib/
    │           └── mysql-connector-j-9.3.0.jar # MySQL JDBC library (duplicate for WAR)

    ├── .metadata/                             # Eclipse IDE internal metadata
    │   ├── .lock

```

---

## **⚠ Troubleshooting**

| Issue | Solution |
|-------|----------|
| **404 Error** | Check `web.xml` URL mappings |
| **Database Connection Failed** | Verify MySQL credentials in `DBUtil.java` |
| **ClassNotFoundException** | Ensure JARs are in `WEB-INF/lib` |
| **Tomcat Port Conflict** | Change port in `conf/server.xml` |

---

**🔗 Repository:** [GitHub Link](https://github.com/Srisai16/SDC_23AG1A05I3.git)

---
