<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location:login.php");
    exit;
}
require'functions.php';
//ambil data di URL
$id_produk=$_GET["id_produk"];
//query data produk berdasarkan id
$prdk=query("SELECT * FROM produk WHERE id_produk=$id_produk")[0];
//cek tombol sudah ditekan atau belum
if(isset($_POST["submit"])){
    //cek apakah data berhasil diubah atau tidak
    if(ubah($_POST)>0){
        echo"
        <script>
            alert('Data berhasil diubah!');
            document.location.href='index.php';
        </script>
    ";
    }else{
        echo"
        <script>
            alert('Data gagal diubah!');
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
    <title>Update Data Produk</title>
</head>
<body>
    <h1>Update Data Produk</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" value="<?=$prdk["id_produk"];?>">
        <ul>
            <li>
                <label for="nama_produk">Nama Produk: </label>
                <input type="text" name="nama_produk" id="nama_produk" required value="<?=$prdk["nama_produk"];?>">
            </li>
            <li>
                <label for="harga_produk">Harga Produk: </label>
                <input type="text" name="harga_produk" id="harga_produk" required value="<?=$prdk["harga_produk"];?>">
            </li>
            <li>
                <label for="gambar_produk">Gambar Produk: </label>
                <input type="text" name="gambar_produk" id="gambar_produk" required value="<?=$prdk["gambar_produk"];?>">
            </li>
            <li>
                <button type="submit" name="submit">Update Data</button>
            </li>
        </ul>
    </form>
</body>
</html>