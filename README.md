<div align="center">
  <a href="https://github.com/vitorfontenele/scandiweb-test">
    <img src="https://user-images.githubusercontent.com/93079439/231782450-b68f12c3-4b82-4f9b-b0d8-9ff7610c7a4f.png" alt="Logo" width="500">
  </a>
  <h3 align="center">scandiweb-test</h3>
  <a href="https://vitor-fontenele-scandiweb-test.000webhostapp.com/">https://vitor-fontenele-scandiweb-test.000webhostapp.com/</a>
</div>

## About

This project is a test assignment for the position of Junior Developer in [Scandiweb](https://scandiweb.com/).

It consists in creating a web-app containing two pages:

1) A product list page
2) An add product page

Final result: [https://vitor-fontenele-scandiweb-test.000webhostapp.com/](https://vitor-fontenele-scandiweb-test.000webhostapp.com/)

## Structure

### Backend

The backend was made using PHP (plain classes, no frameworks, using an OOP approach). MySQL was the DBMS used. All these specifications were required by the test.

### Frontend

The frontend was made using React, even though it was not mandatory.

## Installation

### Backend

To run the project locally, you wil need a local Apache Server. 

A good recomendation is to use XAMPP. XAMPP is a popular PHP development environment and it also contains MySQL.

You will also need to install composer.

To install the composer dependencies in `composer.json`:

```
composer install
````

In MySQL, be it using phpMyAdmin panel or not, you will need to set up a database. Run the sql file in MySQL inside the database you have set up to create the table of products.

Then, you need to configure the .env variables - that is, create a .env file that follows the same pattern of `.env.example`.

### Frontend

Since the frontend was done with React, you will need npm installed in your local machine.

To install the dependencies in `package.json`:

```
npm i
```

You can run the project using:

```
npm run dev
```

Also pay attention to the BASE_URL defined inside of `src/constants/urls`, it must be defined according to where the backend is running.


