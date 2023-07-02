<?php
session_start();

if( !isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
}
require'functions.php';
$id_produk=$_GET["id_produk"];

if(hapus($id_produk)>0){
    echo"
    <script>
        alert('Data berhasil dihapus!');
        document.location.href='index.php';
    </script>
    ";
}else{
    echo"
    <script>
        alert('Data gagal dihapus!');
        document.location.href='index.php';
    </script>
    ";
}
?>