<?php 


?>




<?php 

if(isset($_POST["submit"])){

    if(isset( $_POST["naslov"])){
        $naslov = $_POST['naslov'];
    
       
    
    }
    
    if(isset( $_POST["kratki"])){
        $kratki_sadrzaj = $_POST['kratki'];
    
        //
    }
    
    if(isset( $_POST["sadrzaj"])){
        $sadrzaj = $_POST['sadrzaj'];
    
        //echo $sadrzaj;
    }
    
    if (isset($_FILES["Slika"])) {
        $slika = $_FILES['Slika'];
        
       
        
        
        $upload_dir = 'img/';
        $upload_file = $upload_dir . basename($slika['name']);

       
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        
        if (move_uploaded_file($slika['tmp_name'], $upload_file)) {
            $slika_path = $upload_file;
        } 
    }

    
    if(isset( $_POST["kategorija"])){
        $kategorija = $_POST['kategorija'];
       // echo   $kategorija;

       
    }
    
    if(isset( $_POST["arhiva"])){
        $arhiva = true;
    }
    else{
        $arhiva = false;
    }
    if(isset($_POST['arhiva'])){
        $arhiva=1;
       }else{
        $arhiva=0;
       }
       




    
    
}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poslana forma</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <nav >
        <div class="container l" >
            <div class="row" >
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"  >
                    
                        <ul class="nav-ul-no-bullets" >
                            <li ><a href="index.php" class="liboja">Home</a></li>
                            <li ><a href="kategorija.php?id=sport" class="liboja">Hrvatska</a></li>
                            <li ><a href="kategorija.php?id=kultura" class="liboja">Svijet</a></li>
                            <li><a href="unos.html"  class="liboja">Administracija</a></li>
                        </ul>
        
                  
                </div>
                

            </div>

         

            

        </div>
    </nav>
        

    </header>



    <section class="kategorija">

    <div class="container ">
    
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >
                       <p > 
                       <?php if(isset($kategorija)) { ?>
                         <p style="color: blue; padding:20px; font-size:20px;"> <?php echo $kategorija; ?> </p>
                        <?php } ?>   

                        </p>
                   
                </div>
                
        
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >

                
                <h4 style="color: blue; padding:20px; font-size:20px;">
                <?php if(isset($naslov)) { ?>
                         <p > <?php echo $naslov; ?> </p>
                        <?php } ?>  

                </h4>
                   
                </div>
                
        
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >

                <p style="color: blue; padding:5px; font-size:10px; padding-left:20px;">AUTOR:</p>
                <p style="color: blue; padding:5px; font-size:10px; padding-left:20px;">OBJAVLJENO:</p> 
                   
                </div>
                
        
            </div>

    
        </div>

    </section>



    

    <section class="slikaForma">

    <div class="container ">
    
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >
          <?php if (isset($slika_path)) { ?>
           <img src="<?php echo $slika_path; ?>" alt="Slika" style="width: 70%; padding:10px">
          <?php } ?>
            
           
        </div>
        

    </div>

     </div>

   </section>

   



<section class="kratkiSadrzaj">
<div class="container ">
    
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >
        <p style="color: blue; padding:20px"> 
        <?php if(isset($kratki_sadrzaj)) { ?>
                         <p> <?php echo $kratki_sadrzaj; ?> </p>
                        <?php } ?>  


         </p>           
           
        </div>
        

    </div>

   
</div>

</section>



<section class="Sadrzaj">
<div class="container ">
    
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" >
        <p  style="color: blue; padding:20px"> 
        <?php if(isset($sadrzaj)) { ?>
                         <p> <?php echo $sadrzaj; ?> </p>
                        <?php } ?>  


         </p>
            
           
        </div>
        

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
