# BooksVendor Project  

## Table of Contents  
1. [Introduction](#introduction)  
2. [Features](#features)  
3. [Setup Instructions](#setup-instructions)  
4. [Project Structure](#project-structure)  
5. [Usage](#usage)  
6. [Technologies Used](#technologies-used)  
7. [Future Improvements](#future-improvements)  

---

## Introduction  
The **BooksVendor** project is a web-based application, developed as part of an acadamic project, designed to simulate an online bookstore. It allows users to browse a catalog of books, manage a shopping cart, and place orders. The project is divided into three main phases:  

1. **TP1**: Setting up the website and implementing basic functionalities like a visit counter and database queries.  
2. **TP2**: Adding dynamic features using AJAX for real-time data fetching and display.  
3. **TP3**: Implementing a shopping cart and order management system.  

---

## Setup Instructions  

1. **Clone the Repository**:  
    ```bash  
    git clone <repository-url>  
    cd BooksVendor  
    ```  

2. **Database Setup**:  
    - The database settings have been modified to match the school's desired coordinates.

3. **Configure PHP**:  
    - Install PHP and enable PDO for PostgreSQL.  
    - Update database connection details in the PHP files.  

4. **Run the Application**:  
    - Place the project files in your web server's root directory (e.g., `htdocs` for XAMPP).  
    - Start the server and access the application via `http://localhost/BooksVendor`.  

---

## Features  

### TP1: Basic Setup  
- **Visit Counter**: Tracks the number of visits using a text file and cookies to prevent artificial increments.  
- **Catalog Browsing**: Displays a homepage with a banner, menu, and main content area.  
- **SQL Queries**: Implements basic queries to fetch authors, books, and related data from the database.  

### TP2: Dynamic Features  
- **Author Search**: Dynamically fetches authors based on user input using AJAX and displays results in JSON format.  
- **Book Search**: Dynamically fetches books and their details based on user input.  
- **Real-Time Updates**: Uses JavaScript and AJAX to update the UI without reloading the page.  

### TP3: Shopping Cart and Orders  
- **User Registration**: Allows users to register and stores their data in the database.  
- **Shopping Cart**: Enables users to add books to their cart and view the cart contents.  
- **Order Management**: Transfers cart data to an orders table upon checkout.  
- **Session Management**: Displays personalized greetings and manages user sessions using cookies and PHP sessions.  

---



## Project Structure  

```plaintext  
BooksVendor/  
├── index.php               # Main entry point  
├── css/                    # Stylesheets  
├── js/                     # JavaScript files  
├── php/                    # PHP scripts for backend logic  
├── sql/                    # SQL scripts for database setup  
├── templates/              # HTML templates  
└── README.md               # Project documentation  
```  

---

## Usage  

1. **Homepage**:  
    - View the visit counter and personalized greetings.  
    - Use the menu to search for authors or books.  

2. **Search**:  
    - Type in the search fields to dynamically fetch authors or books.  

3. **Shopping Cart**:  
    - Add books to the cart and view the cart contents.  
    - Proceed to checkout to place an order.  

4. **User Registration**:  
    - Register as a new user to access personalized features.  

---

## Technologies Used  

- **Frontend (in progress)**: HTML, CSS, JavaScript (AJAX)  
- **Backend**: PHP (PDO for database access)  
- **Database**: PostgreSQL  
- **Session Management**: PHP Sessions and Cookies  

---

## Future Improvements  

- Enhance the UI/UX with modern frameworks like Bootstrap.  
- Add user authentication and role-based access control.  
- Implement payment gateway integration for real-world transactions.

---  

