## Introduction

This project is a collaborative team effort developed by **6 students**, supervised by the **Department Chief**. It is designed to provide a comprehensive solution for managing academic and administrative tasks efficiently.

In this project, I mainly worked on the **backend development**, designed the **database structure**, and helped **synchronize the backend with the frontend**. My teammates contributed by developing the **frontend**, performing **testing**, creating **useful diagrams**, and **fine-tuning the backend** to ensure smooth operation. Together, we built a robust and user-friendly application with a variety of features such as user management, registration lists, mail handling, study plans, scheduling, and more, making it a complete tool for departmental use.

## Screenshots

| Feature | Screenshot |
|---------|------------|
| Bienvenue Screen | ![Bienvenue](https://github.com/user-attachments/assets/1397bd3a-ef95-42f6-89a1-7ca3b20fd68f) |
| User List | ![User List](https://github.com/user-attachments/assets/1573a70f-6458-4d66-8540-0942dfe432e0) |
| Inscriptions List | ![Inscriptions List](https://github.com/user-attachments/assets/108dfe5b-0129-42a4-9f1f-2b5b6cb98ee7) |
| Mail Box | ![Mail Box](https://github.com/user-attachments/assets/4a487c63-c208-440b-b8b2-4bffef83cb5b) |
| Plan d'étude | ![Plan d'étude](https://github.com/user-attachments/assets/6f81b1e6-b9ec-4aa5-aca0-98701247ea01) |
| Ajouter Plan d'étude Row | ![Ajouter Plan d'étude](https://github.com/user-attachments/assets/f28dec6b-611f-48d6-9758-56c5d5ee66b6) |
| Emploi Screen | ![Emploi](https://github.com/user-attachments/assets/ce00b24b-268b-4995-8f65-0aca67f1f110) |

*…and many more features! This project is very thorough.*


# TODO

### Frontend:
- [X] register page (inscription page, also main page)
- [X] login page
- [X] closed inscription page
- [X] forgot password page by email
- [X] reconfirmation email
- [ ] users: add pagnation menu in main interface
- [X] users: public details

- [X] interface enseignant.
- [X] enseignant: afficher emploi

- [X] interface etudiant
- [X] etudiant: afficher emploi

- [X] interface super-admin
- [X] super-admin: gestion users
- [X] super-admin: inscription
- [X] super-admin: anne > session (+CRUD, new session if last year) > classes > groups > emploi??
- [X] super-admin: afficher salles + form salle (nom)

- [X] interface admin
- [X] admin: plan etudes (by parcours in their department) > semestres > unites > matieres > enseignants.
- [X] admin: classes > groups > etudiants
- [X] admin: afficher emplois (etudiant only, enseignant automatic) + form emploi (salle, sceance, emploi, class, group, matiere, enseignant)

- CANCELED: etudiant: table parents
- CANCELED: interface parent
- CANCELED: parent: table enfants >> details enfant


### Backend (NOT UPDATED YET):
- [X] set up diagramme de clases
- [X] set up connection Class (MySQL)
- [X] create all classes

- [X] create register function 
  ```
  - check CIN if in list
  - change form based on role from pre-made list (from admin)
  - get nextval from matriculeSeq
  - insert class Utilisateur (set matricule)
  - insert class Etudiant (matricule, department) or Enseignant or Parent
  INFO: role is set in the constructor 
  ```

- [X] activation link
  ```
  - generate token and send email
  - onValidation: set isActive true + message
  - activation link not accepted in 24hours
  ```

- [X] create login function 
  ```
  - use email + password
  - save login to SESSION
  - redirect to specific interface per role
  ```

- [X] forgot password button 
  ```
  - email from form
  - send password
  ```

- [X] reconfirmation send button 
  ```
  - email from form
  - send confirmation email
  ```
  
- [X] modify account (nom, prenom, sexe, adresse, dateNaissance, CIN) 

- [X] admin interface
  ```
  - get tables (etudiant, enseignant)
  - add/remove to table (CIN, role)
  ```

- [X] logout 
  ```
  - remove login from SESSION
  - redirect to main page (inscription page)
  ```

- CANCELED: parent interface
  ```
  - onRegister: immediately after confimation email, send email to enfant (by cin from Form) to verify identity.
  - onVerified: activate user, add record to parent-enfant table
  - onNotVerified: remove user.
  - Ability: get table etudiants
  ```

# Tutorial GITHUB:
Source: https://www.youtube.com/watch?v=jhtbhSpV5YA

First of all, you have to clone the project in a directory of your choosing.

  ```
  git clone https://github.com/pokerfce/UniversityWebsite.git
  ```

After that, for every modification you're going to do, addition you're going to add. Create a new branch of the project:
  ```
  ## for BRANCH_NAME, let's follow the same standards to avoid confusion: (backend/frontend)-(functionality_name)
  git checkout -b BRANCH_NAME
  ```


After editing or adding your things:
  ```
  git add -A
  git commit -m "small description here"
  ```

Then, push the branch to github:
  ```
  git push -u origin BRANCH_NAME
  ```

At this point, you can find your branch in https://github.com/pokerfce/UniversityWebsite/branches

Maybe the main branch which is   ``` main ``` already changed while you are doing your modifications. It's better to use
  ```
  git pull origin main
  ```
This brings any changes that have been made in the main branch, and grap the changes to your branch to avoid merge conflicts.

After this, you have to create a new PULL request on your branch. https://github.com/pokerfce/UniversityWebsite/branches
Here, you can put some detailed information if needed and just validate it.

I'll check it out, verify it and confirm it.

After the branch is merged, it'll be deleted from github.


# HOW TO ADD EMAIL (NECESSARY):

Go to ```C:\xampp\sendmail``` and open ```sendmail.ini  ```

Modify these parameters

  ```
smtp_server=smtp.gmail.com
smtp_port=587
smtp_ssl=tls
error_logfile=error.log
debug_logfile=debug.log
 ```

Then go to ```C:\xampp\php``` and open ```php.ini  ```

Modify these
  ```
[mail function]
; For Win32 only.
SMTP=smtp.gmail.com
smtp_port=587
sendmail_from =sender@gmail.com
sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"
mail.add_x_header=On
  ```

During the repetitive testing, I discovered that GMAIL allows you to send only some few messages before banning you until the next day. Most likely to prevent spamming. 
 
Because of this, I had to make multiple accounts, try them and check if they worked. All email-related errors will be displayed in the  ``` error.log  ``` next to the ```sendemail.ini``` file.


 ```
auth_username=joe.localhost1@gmail.com
auth_password=jwssmhaexympwgpl
 ```
  ```
auth_username=joe.localhost2@gmail.com
auth_password=yfebrxnecjwpppli

  ```

Please try not to spam emails, it'll block all email-related functionality for a day, which will be really inconvenient for all of us (UPDATE: The emails are no longer working)

I already taken care of the server-side code inside the Class ``` Emailer.php ```. Feel free to check it.

# HOW TO SET UP WEBSITE (NECESSARY):

This wasn’t done just because it looks cool; it actually helps with routing, especially for images.

Go to ```C:\xampp\apache\conf\extra```, and open ```httpd-vhosts.conf```. Add this:

```
 <VirtualHost *:80>
    DocumentRoot    "C:/XAMPP/htdocs/teamWorkProj"
    ServerName      isetso.local
    ServerAlias www.isetso.local
 </VirtualHost>
```

Then go to ```c:\Windows\System32\Drivers\etc\hosts``` and open ```hosts``` file. Add this:

```
127.0.0.1       isetso.local
```

Restart XAMPP Apache and MySQL.

From now on, use this link to enter the website:

```
http://isetso.local/
```

# FOOTER:

If you followed the steps listed above but it didn't work, please immediately DM me.

