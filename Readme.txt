Laravel CSV Processor

---

Summary

This Laravel application provides functionality to upload a CSV file, process its contents, and extract structured name data. The application identifies and formats names from the uploaded file, accounting for titles, initials, first names, and last names.

Features:

Upload CSV files from homepage.

Parse and process the CSV file to extract name information.

Return a JSON response with the formatted name data.

Unit tests included for testing CSV upload and processing functionality.

---

Clone the Repository:

git clone https://github.com/MrUsamaArif/homeowners.git | git@github.com:MrUsamaArif/homeowners.git

cd homeowners

---

Install Dependencies:

composer install

Set Up Environment:
Copy the .env.example file to .env and configure your application settings:

cp .env.example .env

Generate an application key:

php artisan key:generate

---

Start the Development Server:

php artisan serve

---

Request:

csv_file: The CSV file to be uploaded (required, MIME types: csv, txt).

---

Response:

On Success: Returns a JSON array of processed name data.

On Failure: Returns a JSON error message with a 500 status code.

---

Running Tests

This project includes PHPUnit tests to verify the CSV upload and processing functionality.

Run Tests:

php artisan test

---

Test Output:

The test suite ensures:

CSV files can be uploaded and processed.

JSON responses conform to the expected structure.

---

Notes

Ensure the storage/uploads directory is writable by the application.

The application uses PSR-2 coding standards for code quality and consistency.

---
