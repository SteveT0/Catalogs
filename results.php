<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results</title>
</head>
<body>
    <h1>Book Search Results</h1>
    <?php
    // TODO 1: Create short variable names.
    $searchtype = $_POST['searchtype'];
    $searchterm = $_POST['searchterm'];

    // TODO 2: Check and filter data coming from the user.
    if(!isset($_POST['searchtype']) &&
    !isset($_POST['searchterm'])){
        echo "Please fill in every input";
    }

    // TODO 3: Setup a connection to the appropriate database.
    $hn = 'localhost';
    $db = 'publications';
    $un = 'hon';
    $pw = 'password';
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error) die("Fatal Error");

    // TODO 4: Query the database.
    $query = "SELECT * FROM catalogs WHERE $searchtype LIKE '%$searchterm%'";

    // TODO 5: Retrieve the results.
    $result = $conn->query($query);
    if(!$result){
        echo "Could not find any matching results<br><br>";
    }

    // TODO 6: Display the results back to user.
    $rows = $result->num_rows;

    for($j = 0; $j < $rows; ++$j)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        $r2 = htmlspecialchars($row[2]);
        $r3 = htmlspecialchars($row[3]);

        echo "<pre>
        ISBN $r0
        Author $r1
        Title $r2
        Price $r3
        </pre>
        ";
    }

    // TODO 7: Disconnecting from the database.
    $conn->close();

    ?>
</body>
</html>