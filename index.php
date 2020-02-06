
<?php
try {
    $user="ICT-151";
    $password = 'Pa$$w0rd';
    $dbh = new PDO('mysql:host=localhost:33066;dbname=mcu', $user, $password);
    foreach($dbh->query('SELECT * from filmmakers') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
