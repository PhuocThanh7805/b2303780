<!DOCTYPE html>
<html>
<head>
    <title>Upload CSV</title>
</head>
<body>

<h2>Upload file CSV</h2>

<form action="upload-csv-processing.php" method="post" enctype="multipart/form-data">
    Chọn file CSV:
    <input type="file" name="file" accept=".csv" required><br><br>
    
    <input type="submit" name="submit" value="Upload">
</form>

</body>
</html>