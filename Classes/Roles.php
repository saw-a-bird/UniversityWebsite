<?php

class Roles
{
    private const roleArray = array(
        0 => 'Administratuer',
        1 => 'Enseignant',
        2 => 'Parent', 
        3 => 'Etudiant'
    );

    static public function getAll() {
        return self::roleArray;
    }

    static public function getName($id) {
        return self::roleArray[$id];
    }
}