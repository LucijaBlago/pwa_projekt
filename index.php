
<?php
include 'connect.php';
define('UPLPATH', 'img/');
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">




    <title>Pocetna</title>
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
        <nav >
        <div class="container l" >
            <div class="row" >
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  >
                    
                        <ul class="nav-ul-no-bullets" >
                            <li ><a href="index.php" class="liboja">Home</a></li>
                            <li ><a href="kategorija.php?id=sport" class="liboja">Sport</a></li>
                            <li ><a href="kategorija.php?id=kultura" class="liboja">Kultura</a></li>
                            <li><a href="unos.php"  class="liboja">Unos</a></li>
                            <li><a href="administracija.php"  class="liboja">Administracija</a></li>
                        </ul>
        
                  
                </div>
                

            </div>

         

            

        </div>
    </nav>
        

    </header>
    

 <section class="s1">


    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  >
             
            <h3 class="hrv">HRVATSKA
                
            </h3>
                
            </div>
            



        </div>
        <div class="row"><?php
               

                $sql = "SELECT naziv, slike, idNaslov FROM naslov WHERE kategorija = 'HRVATSKA'";
                $result = mysqli_query($conn, $sql);

               
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo '<article class="col-lg-4 col-sm-12 col-md-4 col-xs-12"  >';

                   
                        echo '<img src="' . UPLPATH . $row['slike'] . '"';

 
                        echo '<h3 class="sekH">';
                        echo '<a href="clanak.php?id=' . $row['idNaslov'] . '" class="linkic" style="color: black;">';
                        echo $row['naziv'];
                        echo '</a>';
                        echo '</h3>';

                        
                        echo' </article >';
                    }
                } else {
                    echo "Nema rezultata.";
                }


                    //mysqli_close($conn);
            ?>

        
            



        </div>
   

 </section>


 <section class="s1">

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  >
                <h3 class="hrv">SVIJET</h3>
                
            </div>
            
            



        </div>
        <div class="row">
        <?php
                 
                $sql = "SELECT naziv, slike,idNaslov FROM naslov WHERE kategorija = 'SVIJET'";
                $result = mysqli_query($conn, $sql);

                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        echo '<article class="col-lg-4 col-sm-12 col-md-4 col-xs-12"  >';

                       
                        

                        echo '<img src="' . UPLPATH . $row['slike'] . '"';

 
                        echo '<h3 class="sekH">';
                        echo '<a href="clanak.php?id=' . $row['idNaslov'] . '" class="linkic" style="color: black; "">';
                        echo $row['naziv'];
                        echo '</a>';
                        echo '</h3>';

                        
                        echo' </article >';
                    }
                } else {
                    echo "Nema rezultata.";
                }


                   
            ?>

        
            



        </div>
   

                       
            



        </div>

    

 </section>


 <footer>
    <div class="container kontakt">

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >
                <p> Lucija Blagojević</p>
                <p> lblagoje@tvz.hr</p>
                <p> 2024</p>
            </div>
            
    
        </div>

    </div>


 </footer>

</body>
</html>