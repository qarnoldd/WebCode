# Pet Rescue Project

## Project Overview

This project is a PHP-based web application for managing pet listings and adoption applications. It uses a MySQL database for data storage.

---

## Getting Started

### 1. Clone the Repository

```sh
git clone <your-repo-url>
cd <project-directory>
```

### 2. Install Requirements

- PHP (7.x or newer recommended)
- MySQL or MariaDB
- A web server (e.g., Apache, XAMPP, WAMP, MAMP)

### 3. Database Setup

#### a. Create the Database and Import Sample Data

1. **Open a terminal or command prompt.**
2. **Log in to MySQL:**
   ```sh
   mysql -u twa357 -p
   ```
   Enter the password when prompted: `twa357c3`
3. **Import the sample database:**
   - If you are in the project directory:
     ```sql
     SOURCE sample_db.sql;
     ```
   - Or provide the full path:
     ```sql
     SOURCE "D:/GitHub/Code/WebCode/twa/twa357/project/sample_db.sql";
     ```

#### b. Using phpMyAdmin (Alternative)

1. Open phpMyAdmin in your browser (often at `http://localhost/phpmyadmin`).
2. Log in with the credentials above.
3. Use the "Import" tab to upload and run `sample_db.sql`.

#### c. Default Database Credentials

- **Database:** petrescue357
- **User:** twa357
- **Password:** twa357c3
- **Host:** localhost

If you use different credentials, update them in `dbconn.php`:

```php
$dbConn = new mysqli('localhost', 'your_user', 'your_password', 'your_database');
```

---

### Configuring Database Credentials

After importing the database, you need to configure your database connection:

1. Open `dbconn.php` in a text editor.
2. Edit the following lines at the top of the file to match your MySQL setup:
   ```php
   $db_host = 'localhost';
   $db_user = 'your_mysql_user';
   $db_pass = 'your_mysql_password';
   $db_name = 'petrescue357';
   ```
3. Save the file.
4. If you use a different database name or host, update `$db_name` and `$db_host` as needed.

Now your project will connect using your own MySQL credentials.

---

### 4. Configure Your Web Server

- Place the project files in your web server's root directory (e.g., `htdocs` for XAMPP).
- Make sure the `images/` and `css/` folders are accessible.

---

## Usage

- Open your browser and go to `http://localhost/<project-folder>/index.php`.
- You should see the homepage and be able to browse pet listings, register, log in, and manage adoptions.

---

## Troubleshooting

- **Database connection errors:** Double-check your credentials in `dbconn.php` and ensure MySQL is running.
- **Images not displaying:** Make sure the `images/` folder is in the correct location and file names match those in the database.

---

## License

Add your license information here.
