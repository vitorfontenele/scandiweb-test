<a name="readme-top"></a>

<div align="center">
  <img src="./frontend/public/scandiweb-logo.png" height="80" width="80" alt="Scandiweb Logo" />
  <h3 align="center">scandiweb-test</h3>
  <a href="https://vitor-fontenele-scandiweb-test.000webhostapp.com/">https://vitor-fontenele-scandiweb-test.000webhostapp.com/</a>
</div>

## About

This project is a test assignment for the position of Junior Developer in [Scandiweb](https://scandiweb.com/).

It consists in creating a web-app containing two pages:

1) A product list page
2) An add product page

Final result: [Link](https://vitor-fontenele-scandiweb-test.000webhostapp.com/)

<p align="right">(<a href="#readme-top">back to the top</a>)</p>

## Structure

### Backend

The backend was made using PHP (plain classes, no frameworks, using an OOP approach). MySQL was the DBMS used. All these specifications were required by the test.

### Frontend

The frontend was made using React, even though it was not mandatory.

<p align="right">(<a href="#readme-top">back to the top</a>)</p>

## Installation

### Backend

To run the project locally, you wil need a local Apache Server. 

A good recomendation is to use [XAMPP](https://www.apachefriends.org/pt_br/index.html). XAMPP is a popular PHP development environment and it also contains MySQL.

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

<p align="right">(<a href="#readme-top">back to the top</a>)</p>

## Screenshots

### Product List Page

<img src="https://user-images.githubusercontent.com/93079439/231782450-b68f12c3-4b82-4f9b-b0d8-9ff7610c7a4f.png" alt="Product list page" width="100%">

### Add Product Page

<img src="https://user-images.githubusercontent.com/93079439/231785025-e8e76b84-2309-4e82-a9cd-9e8a8c0c980f.png" alt="Add product page" width="100%">

<p align="right">(<a href="#readme-top">back to the top</a>)</p>

 ## Contact
 
Feel free to get in touch!

[![Github][github-shield]][github-url][![Linkedin][linkedin-shield]][linkedin-url]

<p align="right">(<a href="#readme-top">back to the top</a>)</p>

[linkedin-shield]: https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white
[linkedin-url]: https://www.linkedin.com/in/vitor-fontenele/
[github-shield]: https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white
[github-url]: https://github.com/vitorfontenele
