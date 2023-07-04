<?php

//koneksi ke database
$conn=mysqli_connect("localhost", "root", "", "tokoatk");

function query($query){
    global $conn;
    $result=mysqli_query($conn, $query);
    $rows=[];
    while($row=mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    $nama_produk=htmlspecialchars($data["nama_produk"]);
    $harga_produk=htmlspecialchars($data["harga_produk"]);
    //upload gambar
    $gambar_produk=upload();
    if(!$gambar_produk){
        return false;
    }

    $query="INSERT INTO produk VALUES ('', '$nama_produk', '$harga_produk', '$gambar_produk')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile=$_FILES['gambar_produk']['name'];
    $ukuranFile=$_FILES['gambar_produk']['size'];
    $error=$_FILES['gambar_produk']['error'];
    $tmpName=$_FILES['gambar_produk']['tmp_name'];

    //cek apakah ada gambar diupload
    if($error===4){
        echo"
        <script>
        alert('Pilih gambar terlebih dahulu!');
        </script>";

        return false;
    }

    //cek apakah yang diupload adalah gambar
    $ekstensiGambarValid=['jpg', 'jpeg', 'png'];
    $ekstensiGambar=explode('.', $namaFile);
    $ekstensiGambar=strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo"
        <script>
        alert('Yang Anda upload bukan gambar!');
        </script>
        ";

        return false;
    }

    //cek jika ukuran terlalu besar
    if($ukuranFile>1000000){
        echo"
        <script>
        alert('Ukuran gambar terlalu besar!');
        </script>
        ";
    
        return false;
    }

    //gambar siap upload
    //generate nama gambar baru
    $namaFileBaru=uniqid();
    $namaFileBaru.='.';
    $namaFileBaru.=$ekstensiGambar;

    move_uploaded_file($tmpName, 'gambar/'.$namaFileBaru);

    return $namaFileBaru;
}

function hapus($id_produk){
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk=$id_produk");

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;
    $id_produk=$data["id_produk"];
    $nama_produk=htmlspecialchars($data["nama_produk"]);
    $harga_produk=htmlspecialchars($data["harga_produk"]);
    $gambarLama=htmlspecialchars($data["gambarLama"]);

    //cek ada gambar baru atau tidak
    if($_FILES['gambar_produk']['error']===4){
        $gambar_produk=$gambarLama;
    }else{
        $gambar_produk=upload();
    }

    $query="UPDATE produk SET nama_produk='$nama_produk', harga_produk='$harga_produk', gambar_produk='$gambar_produk' WHERE id_produk=$id_produk";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    $query="SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR harga_produk LIKE '%$keyword%' 
    ";
    
    return query($query);
}

function registrasi($data){
    global $conn;
    $username=strtolower(stripslashes($data["username"]));
    $password=mysqli_real_escape_string($conn, $data["password"]);
    $password2=mysqli_real_escape_string($conn, $data["password2"]);

    //cek username sudah ada atau belum
    $result=mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo"
        <script>
        alert('Usernmae telah terdaftar!');
        </script>";

        return false;
    }

    //cek konfirmasi password
    if($password !== $password2){
        echo"
        <script>
        alert('Konfirmasi password tidak sesuai!');
        </script>
        ";

        return false;
    }

    //enkripsi password
    $password=password_hash($password, PASSWORD_DEFAULT);

    //tambah user ke database
    mysqli_query($conn,"INSERT INTO users VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
?>