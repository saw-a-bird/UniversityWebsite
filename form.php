<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscri form</title>
    <link rel="stylesheet" href="Assets/css/iscri_form.css">
    <link rel="stylesheet" href="Assets/css/general.css">
</head>
<body>
         <!--logo and name--> 
    <div>
        <img src="Assets/imgs/LOGO.png" alt="LOGO" id="logo">
    <h1 id="nom_uni">NOM DE L’INSTITUTE </h1>
    </div>
    <!--form-->
    <div id="container">
        <form action="" method="post" id="f">
            <label for="prenom" class="lab_form"> Prenom :</label>
            <input type="text" class="lab_in_txt">
            
            <label for="nom" class="lab_form"> Nom :</label>
            <input type="text" class="lab_in_txt">
            
            <label for="sexe" class="lab_form"> Sexe :</label>
            <select id="sexe" class="drop_form" name="sexe">
                <option value="homme">Homme</option>
                <option value="famme">famme</option>
            </select>

            <label for="department" class="lab_form"> Department :</label>
            <select id="department" class="drop_form" name="department">
                <option value="informatique">Informatique</option>
                <option value="mecanique">Mecanique</option>
                <option value="electrique">Electrique</option>
                <option value="gestion">Gestion</option>
            </select>

            <label for="role" class="lab_form"> Role :</label>
            <select id="role" class="drop_form" name="role">
                <option value="etudiant">Etudaint</option>
                <option value="parent">Parent</option>
                <option value="enseignant">Enseignant</option>
            </select>

            <label for="date_dn" class="lab_form"> Date de naissance :</label>
            <input type="date" name="date_dn" id="lab_in_date">

            <label for="adresse" class="lab_form"> Adresse :</label>
            <input type="text" class="lab_in_txt">

            <label for="email" class="lab_form"> Email :</label>
            <input type="email" class="lab_in_txt">

           <input type="submit" value="Confirmer" id="Confirmer" >

        </form>
    </div>

    <!--the img-->
    <img src="Assets/imgs/person_form.png" alt="person" id="form_img">

</body>
</html>