<?php
include 'connect.php';
define('UPLPATH', 'img/');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  

   
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT); 
    $razina = 0; 

    $sql_check = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt_check = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt_check, $sql_check)) {
        mysqli_stmt_bind_param($stmt_check, 's', $username);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);
    }

  
    if(mysqli_stmt_num_rows($stmt_check) > 0){
        $msg = 'Korisničko ime već postoji!';
    } else {
    
        $sql_insert = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt_insert, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
            if (mysqli_stmt_execute($stmt_insert)) {
                $registriranKorisnik = true;
                $successMsg = 'Uspješno ste se registrirali!'; 
            } else {
                echo '<p>Greška prilikom registracije: ' . mysqli_error($conn) . '</p>';
            }
        }
    }

    mysqli_stmt_close($stmt_check);
    mysqli_stmt_close($stmt_insert);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija korisnika</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container k" >
            <div class="row" >
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  >
                    <h1 >Newsweek</h1>  
                </div>
            </div>
        </div>
        <nav>
            <div class="container l" >
                <div class="row" >
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <ul class="nav-ul-no-bullets" >
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
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Registracija korisnika</h2>
                <?php if(isset($successMsg)): ?>
                    <div class="alert alert-success"><?php echo $successMsg; ?></div>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="ime">Ime:</label>
                        <input type="text" class="form-control" id="ime" name="ime" required>
                    </div>
                    <div class="form-group">
                        <label for="prezime">Prezime:</label>
                        <input type="text" class="form-control" id="prezime" name="prezime" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Korisničko ime:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <?php if(isset($msg)) echo '<p class="text-danger">'.$msg.'</p>'; ?>
                    </div>
                    <div class="form-group">
                        <label for="pass">Lozinka:</label>
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="passRep">Ponovite lozinku:</label>
                        <input type="password" class="form-control" id="passRep" name="passRep" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registriraj se</button>
                </form>
            </div>
        </div>
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
