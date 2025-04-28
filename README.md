
---

### 3. Start Apache and MySQL

- Open **XAMPP Control Panel**.
- Click **Start** for both **Apache** and **MySQL**.

---

### 4. Import the Database

1. Go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)  
2. Create a new database:
 - Database name: `event`
3. Click **Import** tab.
4. Import the provided `test.sql` file located in the project folder.

This will create all necessary tables like:
- `admin`
- `student`
- `organization`
- etc.

---

### 5. Configure Database Connection

Check `connection.php`:

```php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";
