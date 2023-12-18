<?php
namespace App\Auth;

use Cake\Auth\AbstractPasswordHasher;

class LegacyPasswordHasher extends AbstractPasswordHasher
{

    public function hash($password)
    {
        return md5('ab513c75f48d82bcd30aa48e478d2e6e'.$password);
    }

    public function check($password, $hashedPassword)
    {
        return md5('ab513c75f48d82bcd30aa48e478d2e6e'.$password) === $hashedPassword;
    }
}