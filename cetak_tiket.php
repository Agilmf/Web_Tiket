<!DOCTYPE html>
<html>
<head>
  <title>Ticketing Event Konser Musik</title>
  <style>
    /* Gaya CSS tetap sama */

    /* ... */

  </style>
</head>
<body>
  <div class="container">
    <h1>Cetak Tiket</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="nomor_tiket" placeholder="Nomor Tiket" required>
      <button type="submit" name="cetak">Cetak</button>
    </form>
  </div>
</body>
</html>