<?php
session_start();
include 'connect.php';
define('UPLPATH', 'img/');

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: administracija.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM korisnik WHERE korisnicko_ime='$username' AND lozinka='$password'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if ($user['razina'] == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'admin';
                header('Location: administracija.php');
                exit;
            } else {
                $login_error = 'Nemate administratorske ovlasti.';
            }
        } else {
           
            $login_error = 'Pogrešno korisničko ime ili lozinka. <a href="registracija.php">Registrirajte se ovdje</a>.';
        }
    } else {
        $login_error = 'Greška prilikom izvršavanja upita: ' . mysqli_error($conn);
    }
}

if (isset($_SESSION['username']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $query = "SELECT * FROM naslov";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container k">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <h1>Newsweek</h1>
                </div>
            </div>
        </div>
        <nav>
            <div class="container l">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <ul class=" ">
                            <li><a href="index.php" class="liboja">Home</a></li>
                            <li><a href="kategorija.php?id=sport" class="liboja">Sport</a></li>
                            <li><a href="kategorija.php?id=kultura" class="liboja">Kultura</a></li>
                            <li><a href="unos.php" class="liboja">Unos</a></li>
                            <li><a href="administracija.php" class="liboja">Administracija</a></li>
                            <li class="gumb">
                                <form action="" method="POST" class="d-inline">
                                    <button type="submit" name="logout" class="btn btn-link  liboja">Odjavi se</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="container forma2">
                    <div class="row >
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <form method="post" action="" enctype="multipart/form-data" class="">
                                <label for="naslov">Naslov vijesti</label><br>
                                <input type="text" name="naslov" id="naslov" value="' . $row['naziv'] . '"><br>
                                <label for="kratki">Kratki sadržaj vijesti (do 50 znakova)</label><br>
                                <textarea name="kratki" id="kratki" maxlength="50">' . $row['kratki_sadrzaj'] . '</textarea><br>
                                <label for="sadrzaj">Sadržaj vijesti</label><br>
                                <textarea name="sadrzaj" id="sadrzaj">' . $row['opis'] . '</textarea><br>
                                <label for="Slika">Slika:</label><br>
                                <input type="file" id="Slika" name="Slika" accept="image/jpg"><br>
                                <label for="kategorija">Kategorija vijesti</label><br>
                                <select name="kategorija" id="kategorija">
                                    <option value="obrazovanje"' . ($row['kategorija'] == 'obrazovanje' ? ' selected' : '') . '>Obrazovanje</option>
                                    <option value="novosti"' . ($row['kategorija'] == 'novosti' ? ' selected' : '') . '>Novosti</option>
                                </select><br>
                                <label for="arhiva">Spremiti u arhivu:</label><br>
                                <input type="checkbox" id="arhiva" name="arhiva"' . ($row['arhiva'] ? ' checked' : '') . '><br>
                                <input type="hidden" name="id" class="form-field-textual" value="' . $row['idNaslov'] . '">
                                <button type="reset" value="Poništi">Poništi</button>
                                <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                                <input type="submit" name="delete" value="Izbriši">
                            </form>
                        </div>
                    </div>
                </div>';
        }

        if (isset($_POST['update'])) {
            $naslov = $_POST['naslov'];
            $kratki_sadrzaj = $_POST['kratki'];
            $sadrzaj = $_POST['sadrzaj'];
            $slika = $_FILES['Slika']['name'];
            $kategorija = $_POST['kategorija'];
            $arhiva = isset($_POST['arhiva']) ? 1 : 0;
            $target_dir = 'img/' . $slika;
            move_uploaded_file($_FILES["Slika"]["tmp_name"], $target_dir);
            $id = $_POST['id'];
            $query = "UPDATE naslov SET naziv='$naslov', opis='$kratki_sadrzaj', kratki_sadrzaj='$sadrzaj', slike='$slika', kategorija='$kategorija', arhiva='$arhiva' WHERE idNaslov=$id";
            $result = mysqli_query($conn, $query);
        }

        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $query = "DELETE FROM naslov WHERE idNaslov=$id";
            $result = mysqli_query($conn, $query);
        }
        ?>


    <footer>
        <div class="container kontakt">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <p>Lucija Blagojević</p>
                    <p>lblagoje@tvz.hr</p>
                    <p>2024</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container k">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <h1>Newsweek</h1>
                </div>
            </div>
        </div>
        <nav>
            <div class="container l">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <ul class="nav-ul-no-bullets">
                            <li><a href="index.php" class="liboja">Home</a></li>
                            <li><a href="kategorija.php?id=sport" class="liboja">Sport</a></li>
                            <li><a href="kategorija.php?id=kultura" class="liboja">Kultura</a></li>
                            <li><a href="unos.php" class="liboja">Unos</a></li>
                            <li><a href="administracija.php" class="liboja">Administracija</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h2>Prijava</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Korisničko ime:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Lozinka:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Prijavi se</button>
            <?php if (isset($login_error)) { echo '<p class="text-danger">' . $login_error . '</p>'; } ?>

        
        </form>
    </div>

    <footer>
        <div class="container kontakt">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <p>Lucija Blagojević</p>
                    <p>lblagoje@tvz.hr</p>
                    <p>2024</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php
}
?>
