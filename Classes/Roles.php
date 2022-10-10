<?php

class Roles
{
    private const roleArray = array(
        0 => 'Directeur',
        1 => 'Administrateur',
        2 => 'Enseignant',
        3 => 'Etudiant'
    );

    private static $nameArray;

    static public function getAll() {
        return self::roleArray;
    }

    static public function getName($id) {
        return self::roleArray[$id];
    }

    static public function ByName($name) {
        if (isset(self::$nameArray)) {
            return self::$nameArray[$name];
        }

        return self::$nameArray[$name] = array_flip(self::roleArray)[$name];
    }
}