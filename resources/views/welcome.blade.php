<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
</head>

<body>
    <h1>Homeowner Names - Technical Test</h1>
    <form action="{{ url('/upload-csv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="csv_file">Upload CSV:</label>
        <input type="file" name="csv_file" id="csv_file" required>
        <button type="submit">Upload</button>
    </form>
</body>

</html>
