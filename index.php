<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/css/inscription.css">
    <link rel="stylesheet" href="Assets/css/general.css">
    <script src="Assets/js/inscription.js"></script>
    <title>Inscription</title>
</head>
<body>
   <?php 
   
if (isset($_POST['submit'])){
    $user=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $Cpw=$_POST['Cpassword'];
    $type=$_POST['usertype'];

    $sql =  "SELECT email from user where email='$email'";
    $result=mysqli_query($data,$sql);




    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
                if(!empty($row["email"])){
                    header("Location: index.php?nom=".$user."&email=".$email."&v=true");
                    return;
                }
            }
        }
        if ($password != $Cpw){
            header("Location: index.php?nom=".$user."&email=".$email."&p=true");
            return;
        } else {
            $sql="INSERT INTO `user`(`username`, `email`, `usertype`, `password`)VALUES('$user','$email','$type','$password')";
            $result=mysqli_query($data,$sql);
            if ($result){
                header("Location: index.php");
            }
            else{
                echo "User Not inserted";
            }
        }
    }
}

?>

    <!--logo and name--> 
    <div>
        <img src="Assets/imgs/LOGO.png" alt="LOGO" id="logo">
    <h1 id="nom_uni">NOM DE L’INSTITUTE </h1>
    </div>

    <!--the form and title--> 
    <div>
        <p id="bienvenue">BIENVENUE</p>
        <p id="title_2">Presenter votre CIN pour incrire </p>
        <form action="" method="post" name="cin_form">
            <input id="cin" type="text" name="cin" placeholder="CIN">
        </form>
        <p id="alt_connect"><span id="part1_conn">Déja inscrit? Appuier ici pour </span><a href="" id="part2_conn"> se connecter.</a></p>
    </div>

    <!--background img--> 
    <img src="Assets/imgs/p_progresse.png" alt="person" id="b_img">
</body>
</html>