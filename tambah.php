<?php
session_start();

if( !isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
}
require'functions.php';
//cek tombol sudah ditekan atau belum
if(isset($_POST["submit"])){
    
    //cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST)>0){
        echo"
        <script>
            alert('Data berhasil ditambahkan!');
            document.location.href='index.php';
        </script>
    ";
    }else{
        echo"
        <script>
            alert('Data gagal ditambahkan!');
            document.location.href='index.php';
        </script>
    ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Produk</title>
</head>
<body>
    <h1>Tambah Data Produk</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama_produk">Nama Produk: </label>
                <input type="text" name="nama_produk" id="nama_produk" required>
            </li>
            <li>
                <label for="harga_produk">Harga Produk: </label>
                <input type="text" name="harga_produk" id="harga_produk" required>
            </li>
            <li>
                <label for="gambar_produk">Gambar Produk: </label>
                <input type="file" name="gambar_produk" id="gambar_produk">
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>