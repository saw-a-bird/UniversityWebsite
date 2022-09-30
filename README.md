
# TODO

### Frontend:
- [ ] interface enseignant
- [ ] interface parent
- [ ] interface admin (table etudiant and table enseignant, add and remove buttons)
- [ ] interface user
- [X] register page (inscription page, also main page)
- [X] register form page
- [ ] login page
- [X] closed inscription page
- [ ] forgot password page (email)

### Backend:

- [X] set up diagramme de clases
- [X] set up connection Class (MySQL)
- [ ] create all classes
- [ ] set up Matricule SQL Sequence (matriculeSeq, instead of auto-generation)
- [ ] create register function 
  ```
  - check CIN if in list
  - change form based on role from pre-made list (from admin)
  - get nextval from matriculeSeq
  - insert class Utilisateur (set matricule)
  - insert class Etudiant (matricule, department) or Enseignant or Parent
  INFO: role is set in the constructor 
  ```

- [ ] activation link
  ```
  - generate token and send email
  - onValidation: set isActive true + message
  - activation link not accepted in 24hours
  ```

- [ ]  create login function 
  ```
  - use email + password
  - save login to SESSION
  - redirect to specific interface per role
  ```

- [ ] forgot password button 
  ```
  - email from form
  - send confirmation email
  - password edit
  ```

- [ ] modify account (nom, prenom, sexe, adresse, dateNaissance, CIN) 

- [ ] admin interface
  ```
  - get tables (etudiant, enseignant)
  - add/remove to table (CIN, role)
  ```

- [ ] parent interface
  ```
  - get table etudiants
  - add/remove to table (CIN) >> student have to confirm before add.
  ```

- [ ] logout 
  ```
  - remove login from SESSION
  - redirect to main page (inscription page)
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