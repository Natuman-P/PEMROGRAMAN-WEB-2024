<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservasitamu";

// Membuat koneksi
$conn = mysqli_connect ($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari formulir saat formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $people = $_POST['people'];
  $table = $_POST['list_table'];
  $ticketNumber = $_POST['ticketnumber'];

  // Menyimpan data ke dalam database
  $sqlquery = "INSERT INTO listtamu (name, date, time, people, list_table, ticketnumber) 
          VALUES ('$name', '$date', '$time', '$people', '$table', '$ticketNumber')";

  if ($conn->query($sql) === TRUE) {
      echo "Reservasi berhasil disimpan.";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 

  $data = $_REQUEST['val1'];

  if (empty($data)) {
      echo "data is empty";
  } else {
      echo $data;
  }
}


// Closing the connection.
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservasi Restoran</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Reservasi Restoran</h1>
    <form id="reservationForm" method="post">
      <label for="name">Nama:</label>
      <input type="text" id="name" name="name" value="" required><br>
      <label for="date">Tanggal:</label>
      <input type="date" id="date" name="date" value="" required><br>
      <label for="time">Waktu:</label>
      <input type="time" id="time" name="time" value="" required><br>
      <label for="people">Jumlah Orang:</label>
      <input type="number" id="people" name="people" min="1" value="" required><br>
      <label for="table">Meja:</label>
      <select id="table" name="table" required>
        <option value="1">Meja 1</option>
        <option value="2">Meja 2</option>
        <option value="3">Meja 3</option>
        <!-- Add more table options here -->
      </select><br>
      <button type="submit">Reservasi</button>
    </form>

    <div id="confirmation" class="hidden">
      <p>Terima kasih, <span id="confirmationName"></span>! Reservasi Anda untuk <span id="confirmationDate"></span> pada <span id="confirmationTime"></span> untuk <span id="confirmationPeople"></span> orang di <span id="confirmationTable"></span> telah berhasil dilakukan.</p>
      <p>Nomor Tiket Reservasi Anda: <span id="confirmationTicket"></span></p>
      <div id="qrCodeContainer"></div> <!-- Tambahkan div untuk menampilkan QR Code -->
    </div>
    <div class="content">
      <a href="beranda.html"><button>Kembali ke Beranda</button></a>
    </div>
  </div>
  </div>

  <script src="main.js"></script>
</body>
</html>
