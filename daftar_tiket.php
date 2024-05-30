<!DOCTYPE html>
<html>
<head>
  <title>Ticketing Event Konser Musik</title>
  <style>
    /* Gaya CSS tetap sama */

    /* ... */

  </style>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>TIKET KONSER BLACKPINK</h1>

  <?php
    // Fungsi untuk memeriksa apakah tiket ada dalam file JSON
    function periksaTiket($email, $nomorTiket) {
      $dataJson = file_get_contents('tiket.json');
      $tiket = json_decode($dataJson, true);
      foreach ($tiket as $dataTiket) {
        if ($dataTiket['email'] === $email && $dataTiket['nomorTiket'] === $nomorTiket) {
          return $dataTiket;
        }
      }
      return null;
    }

    // Menyimpan data formulir ke dalam file JSON
    if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      $nama = $_POST['nama'];
      $noTelp = $_POST['no_telp'];
      $alamat = $_POST['alamat'];
      $noIdentitas = $_POST['no_identitas'];

      $nomorTiket = "PWEB-" . str_pad(rand(1, 999999999), 9, "0", STR_PAD_LEFT);

      $dataTiket = array(
        'nomorTiket' => $nomorTiket,
        'nama' => $nama,
        'email' => $email,
        'noTelp' => $noTelp,
        'alamat' => $alamat,
        'noIdentitas' => $noIdentitas
      );

      // Memuat data tiket yang sudah ada dari file JSON
      $dataJson = file_get_contents('tiket.json');
      $tiket = json_decode($dataJson, true);

      // Menambahkan data tiket baru ke dalam array
      $tiket[] = $dataTiket;

      // Menyimpan data tiket yang sudah diperbarui ke dalam file JSON
      $dataJson = json_encode($tiket, JSON_PRETTY_PRINT);
      file_put_contents('tiket.json', $dataJson);
  ?>
      <img src="Blackpink.jpg" alt="Blackpink">
      <div class="ticket-container">
        <h1>E-Ticket</h1>
        <div class="ticket">
          <p>Nomor Tiket: <?php echo $nomorTiket; ?></p>
          <p>Nama: <?php echo $nama; ?></p>
          <p>Email: <?php echo $email; ?></p>
        </div>
        <p class="success-message">Selamat, tiket Anda sudah dibuat.</p>
      </div>
      <script>
        // Menghapus form dan menambahkan class fireworks-animation setelah data diproses
        var container = document.querySelector('.container');
        container.parentNode.removeChild(container);
        document.querySelector(".ticket-container").classList.add("fireworks-animation");
      </script>
  <?php
    } elseif (isset($_POST['cetak'])) {
      $email = $_POST['email'];
      $nomorTiket = $_POST['nomor_tiket'];

      // Memeriksa apakah tiket ada
      $tiket = periksaTiket($email, $nomorTiket);

      if ($tiket !== null) {
  ?>
        <h2>E-Ticket</h2>
        <div class="ticket-container">
          <div class="ticket">
            <p>Nomor Tiket: <?php echo $tiket['nomorTiket']; ?></p>
            <p>Nama: <?php echo $tiket['nama']; ?></p>
            <p>Email: <?php echo $tiket['email']; ?></p>
          </div>
        </div>
  <?php
      } else {
  ?>
        <p class="error-message">Data tiket tidak ditemukan.</p>
  <?php
      }
    } else {
  ?>
      <div class="container">
        <h1>Registrasi</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <input type="email" name="email" placeholder="Email" required>
          <input type="text" name="nama" placeholder="Nama" required>
          <input type="tel" name="no_telp" placeholder="No. Telp" required>
          <input type="text" name="alamat" placeholder="Alamat" required>
          <input type="text" name="no_identitas" placeholder="No. Identitas (SIM/KTP)" required>
          <button type="submit" name="submit">Submit</button>
        </form>
        <p><a href="cetak_tiket.php">Cetak Tiket</a></p>
      </div>
  <?php
    }
  ?>

</body>
</html>
