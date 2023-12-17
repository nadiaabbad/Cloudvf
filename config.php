<?php
$serverName = "tcp:projetcloudvf.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "projetcloudfinal",
    "Uid" => "azureuser",
    "PWD" => "123Klerviaadam",
    "MultipleActiveResultSets" => false,
    "Encrypt" => true,
    "TrustServerCertificate" => false
);

// Établir la connexion à la base de données
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Vérifier la connexion
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>



























<?php
$serverName = "tcp:projetcloudvf.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "projetcloudvf",
    "Uid" => "azureuser",
    "PWD" => "123Klerviaadam",
    "MultipleActiveResultSets" => false,
    "Encrypt" => true,
    "TrustServerCertificate" => false
);

// Establish the database connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Check the connection
if ($conn) {
    // Display a generic error message to the user
    die('Unable to connect to the database. Please try again later.');

    // For debugging purposes, you can uncomment the line below
    // die(print_r(sqlsrv_errors(), true));
}
?>
