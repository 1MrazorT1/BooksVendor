# BooksVendor Project  

## Table of Contents  
1. [Introduction](#introduction)  
2. [Live Demo](#live-demo)  
3. [Setup Instructions](#setup-instructions)  
4. [Features](#features) 
5. [Project Structure](#project-structure)  
6. [Usage](#usage)  
7. [Technologies Used](#technologies-used)  
8. [Future Improvements](#future-improvements)  

---

## Introduction  
The **BooksVendor** project is a web-based application, developed as part of an acadamic project, designed to simulate an online bookstore. It allows users to browse a catalog of books, manage a shopping cart, and place orders. The project is divided into three main phases:  

1. **TP1**: Setting up the website and implementing basic functionalities like a visit counter and database queries.  
2. **TP2**: Adding dynamic features using AJAX for real-time data fetching and display.  
3. **TP3**: Implementing a shopping cart and order management system.  

---


## Live Demo 

To consult the live demo of this project, please visit [my youtube video](https://youtu.be/pX-tCmC97jw).

---

## Setup Instructions  

1. **Clone the Repository**:  
    ```bash  
    git clone git@github.com:1MrazorT1/BooksVendor.git  
    cd BooksVendor  
    ```  

2. **Dependencies installation**: 
    - To install the necessary tools, run these commands, they will install you **php**, **php-pgsql** (for php pdo) and **postgresql**:
    ```bash
    sudo apt update
    sudo apt upgrade
    sudo apt install php8.1-cli
    sudo apt install php-pgsql
    sudo apt install postgresql postgresql-contrib
    ```

3. **Database Setup**:  
    - To created the necessary tables for this project, please run the following commands:
    ```bash
    sudo -u postgres psql -d db -f livres.sql
    sudo -u postgres psql -d db -f clients.sql
    sudo -u postgres psql -d db -f inscription.sql
    ```
    - If you get prompted with the error "permission denied", please do these commands before executing the previous ones:
    ```bash
    cp /REPLACE/THIS/WITH/ABSOLUTE/PATH/BooksVendor/livres.sql /tmp/
    cp /REPLACE/THIS/WITH/ABSOLUTE/PATH/BooksVendor/clients.sql /tmp/
    cp /REPLACE/THIS/WITH/ABSOLUTE/PATH/BooksVendor/inscription.sql /tmp/
    ```
    - The database settings have been modified to match the school's desired coordinates.

4. **Run the Application**:  
    - Simply, execute this command:
    ```bash
    php -S localhost:8000
    ``` 
    - Then, in your browser, open "localhost:8000/"

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
├── README.md
├── ajouter_panier.php
├── clients.sql
├── commander.php
├── compteur.txt
├── consulter_panier.php
├── counter.php
├── index.php
├── inscription.php
├── inscription.sql
├── livres.sql
├── recherche_auteurs.php
├── recherche_ouvrages_auteur.php
├── recherche_ouvrages_titre.php
├── requete.php
├── script.js
├── style.css
├── testing_queries.sql
└── vider_panier.php
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

