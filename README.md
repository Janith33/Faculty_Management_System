# Faculty Management System

Web page is Live

## Overview

Faculty Management System is a web-based application to manage faculty information, departments, and related administrative tasks. This repository contains the source code for the application built primarily with PHP, with CSS for styling and some Hack code.

## Features

- CRUD operations for faculty records
- Department and role management
- Search and filtering for faculty profiles
- Responsive user interface

## Technology Stack

- PHP
- Hack
- HTML/CSS
- MySQL (recommended) or another relational database

## Requirements

- PHP 7.4+ (or the version supported by this project)
- A web server (Apache, Nginx) or PHP built-in server
- MySQL or compatible database

## Getting Started (Local)

1. Clone the repository:

   git clone https://github.com/Janith33/Faculty_Management_System.git

2. Move files into your web server document root or start PHP built-in server:

   cd Faculty_Management_System
   php -S localhost:8000

3. Configure database:

   - Create a new database (e.g., faculty_db)
   - Import any provided SQL migration or dump files if available (check a `database` or `sql` folder)
   - Update the database configuration in the project (commonly in a file like `config.php`, `.env`, or similar).

4. Open the app in your browser:

   http://localhost:8000

Notes: If the project uses a different structure or configuration file, adjust steps above accordingly.

## Project Structure

A typical layout (actual layout may vary):

- /public or project root - public-facing files
- /src or /app - PHP source files
- /assets - CSS, images, client-side code
- /config - configuration files
- /database, /sql - database migrations or dumps

## Contributing

Contributions are welcome. To contribute:

1. Fork the repository
2. Create a branch for your feature or bugfix
3. Commit changes with clear messages
4. Open a pull request describing your changes

## Live Demo

The repository description indicates the web page is live. If you have a live demo URL, add it here.

## License

If you have a preferred license, add it here (e.g., MIT, Apache-2.0). If not specified, consider adding an open-source license.

## Contact

Maintainer: Janith33

If you'd like, I can add or customize sections (installation details, database schema, screenshots, usage examples, or a license).