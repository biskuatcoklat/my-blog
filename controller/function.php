<?php
require_once(__DIR__ . '/../database/koneksi.php');

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function  tambaharticle($request)
{
    global $koneksi;
    $title = htmlspecialchars($request["title"]);
    $slug = htmlspecialchars($request["slug"]);
    $content = htmlspecialchars($request["content"]);
    $user_id = htmlspecialchars($request["user_id"]);
    $category_id = htmlspecialchars($request["category_id"]);
    $foto = upload();

    if (!$foto) {
        return false;
    }


    $query = "INSERT INTO articles (title, slug, content, user_id, category_id, foto) VALUES ('$title', '$slug', '$content', '$user_id', '$category_id', '$foto')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
    $namafoto = $_FILES['foto']['name'];
    $ukuranfoto = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $simpansementara = $_FILES['foto']['tmp_name']; // Menggunakan tmp_name yang benar

    // Cek apakah tidak ada gambar yang di-upload
    if ($error === 4) {
        echo "<script>
        alert('Please choose your image');
        </script>";
        return false;
    }

    // Cek apakah yang di-upload adalah gambar
    $ekstensifotobenar = ['jpg', 'jpeg', 'png'];
    $ekstensinama = explode('.', $namafoto);
    $ekstensinama = strtolower(end($ekstensinama));

    if (!in_array($ekstensinama, $ekstensifotobenar)) {
        echo "<script>
        alert('This file extension is not supported');
        </script>";
        return false;
    }

    // Cek ukuran file gambar
    if ($ukuranfoto > 5000000) {
        echo "<script>
        alert('Image size is too big. Max 4 MB');
        </script>";
        return false;
    }

    // Lolos pengecekan
    $namafotonew = uniqid();
    $namafotonew .= '.';
    $namafotonew .= $ekstensinama;

    move_uploaded_file($simpansementara, __DIR__ . '/img/' . $namafotonew);
    return $namafotonew; // Mengembalikan nama file baru
}

function delete_articles($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM articles WHERE id = $id");
    return  mysqli_affected_rows($koneksi);
}

function editarticle($request)
{
    global $koneksi;

    $id = htmlspecialchars($request["id"]);
    $title = htmlspecialchars($request["title"]);
    $slug = htmlspecialchars($request["slug"]);
    $content = htmlspecialchars($request["content"]);
    $user_id = htmlspecialchars($request["user_id"]);
    $category_id = htmlspecialchars($request["category_id"]);
    $foto_lama = htmlspecialchars($request["foto_lama"]);

    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $foto = $foto_lama;
    } else {
        $foto = upload();
        if (!$foto) {
            return false;
        }
    }

    $query = "UPDATE articles SET
                title = '$title',
                slug = '$slug',
                content = '$content',
                user_id = '$user_id',
                category_id = '$category_id',
                foto = '$foto'
                WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function tambahcategory($request)
{
    global $koneksi;
    $name = htmlspecialchars($request["name"]);
    $slug = htmlspecialchars($request["slug"]);
    $description = htmlspecialchars($request["description"]);

    $query = "INSERT INTO categories (name,slug,description) VALUES ('$name','$slug','$description')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function editcategory($request)
{
    global $koneksi;

    $id = htmlspecialchars($request["id"]);
    $name = htmlspecialchars($request["name"]);
    $slug = htmlspecialchars($request["slug"]);
    $description = htmlspecialchars($request["description"]);

    $query = "UPDATE categories SET
                name = '$name',
                slug = '$slug',
                description = '$description'
                WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function delete_category($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM categories WHERE id = $id");
    return  mysqli_affected_rows($koneksi);
}

function registrasi($data)
{
    global $koneksi;
    $username = strtolower(htmlspecialchars(stripslashes($data["username"])));
    $password = htmlspecialchars(mysqli_real_escape_string($koneksi, $data["password"]));
    $email = htmlspecialchars($data["email"]);
    $password2 = htmlspecialchars(mysqli_real_escape_string($koneksi, $data["password2"]));

    //cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
        alert('username sudah terdaftar');</script>";

        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
        alert('konfirmasi password tidak sesuai');
        </script>";

        return false;
    }
    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}
