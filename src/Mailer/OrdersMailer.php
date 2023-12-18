<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Orders mailer.
 */
class OrdersMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Orders';

    public function confirmacion( $client , $detalle, $orden )
    {

        $val = $this->to( $client->email)
             ->profile('emailmensajes')
             ->emailFormat('html')
             ->template('emailordenconfirmacion')
             ->layout('orders')
             ->viewVars(['name' => $client->name_client, 'detalle' => $detalle, 'orden' => $orden->nro_order])
             ->subject(sprintf('Bienvenido %s', $client->name_client));

    }

    public function cancelacion( $client , $orden )
    {

        $val = $this->to( $client->email)
             ->profile('emailmensajes')
             ->emailFormat('html')
             ->template('emailordencancelacion')
             ->layout('orders')
             ->viewVars(['name' => $client->name_client, 'detalle' => $orden->commentary])
             ->subject(sprintf('Bienvenido %s', $client->name_client));
    }

}
