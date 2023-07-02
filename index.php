<?php
session_start();

if( !isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
}

require'functions.php';

$produk=query("SELECT * FROM produk");

//tombol cari diklik
if(isset($_POST["cari"])){
    $produk=cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>Daftar Produk</h1>
    <a href="tambah.php">Tambah Data Produk</a><br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="40" autofocus placeholder="Cari produk" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Id Produk</th>
            <th>Nama Produk</th>
            <th>Harga Produk</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php $i =1;?>
        <?php foreach($produk as $row):?>
        <tr>
            <td><?=$i;?></td>
            <td><?= $row["id_produk"]; ?></td>
            <td><?= $row["nama_produk"]; ?></td>
            <td><?= $row["harga_produk"]; ?></td>
            <td><img src="gambar/<?= $row["gambar_produk"]; ?>" width="50"></td>
            <td>
                <a href="ubah.php?id_produk=<?= $row["id_produk"]; ?>">ubah</a>|
                <a href="hapus.php?id_produk=<?= $row["id_produk"]; ?>" onclick="return confirm('Hapus produk ini?');">hapus</a>
            </td>
        </tr>
        <?php $i++;?>
        <?php endforeach; ?>
    </table>
</body>
</html>