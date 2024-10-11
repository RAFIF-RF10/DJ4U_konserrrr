<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coba";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("koneksi gagal" . $conn->connect_error);
}

function getData($conn, $query)
{

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function kurangiStock($konser_id)
{
    global $conn;

    $query = "UPDATE konser SET jumlah_tiket = jumlah_tiket - 1 WHERE id = '$konser_id'";

    if (mysqli_query($conn, $query)) {
        return true;
    }
}
