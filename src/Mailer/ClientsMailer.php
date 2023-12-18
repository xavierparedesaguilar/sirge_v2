<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Clients mailer.
 */
class ClientsMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Clients';

    public function bienvenida( $client , $model_user)
    {

        $val = $this->to( $client->email)
             ->profile('emailmensajes')
             ->emailFormat('html')
             ->template('emailclientes')
             ->layout('clients')
             ->viewVars(['name' => $client->name_client, 'username' => $model_user->username])
             ->subject(sprintf('Bienvenido %s', $client->name_client));
    }
}
