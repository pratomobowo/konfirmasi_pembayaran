# Database Migration from SQLite to MySQL

This project has been migrated from SQLite to MySQL to improve performance and scalability.

## Migration Files

- `mysql_dump_tables_only.sql`: This file contains all tables and data compatible with older MySQL versions (using utf8mb4_unicode_ci collation)

## How to Import to MySQL

To import the database on your server:

1. Make sure you have created an empty database in MySQL
2. Import the SQL file using:
   ```
   mysql -u your_username -p your_database_name < mysql_dump_tables_only.sql
   ```

## Configuration

Make sure your `.env` file contains the correct MySQL database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Collation Compatibility

The SQL dump has been modified to use `utf8mb4_unicode_ci` collation for compatibility with older MySQL versions. 