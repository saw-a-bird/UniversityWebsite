<?php

class Roles
{
    private const roleArray = array(
        0 => 'SuperAdmin',
        1 => 'Directeur',
        2 => 'Admin',
        3 => 'Enseignant',
        4 => 'Etudiant'
    );

    private static $nameArray;

    static public function getAll() {
        $roleArray = self::roleArray;
        unset($roleArray[0]);
        
        return $roleArray;
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