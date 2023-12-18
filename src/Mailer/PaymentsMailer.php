<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Payments mailer.
 */
class PaymentsMailer extends Mailer
{

    /**
     * Mailer's name.
     *
     * @var string
     */
    static public $name = 'Payments';

    public function confirmacion( $orders )
    {
        $val = $this->to( $orders->client->email)
                 ->profile('emailmensajes')
                 ->emailFormat('html')
                 ->template('emailpagos')
                 ->layout('payments')
                 ->viewVars(['name' => $orders->client->name_client])
                 ->subject(sprintf('Bienvenido %s', $orders->client->name_client));
    }


}
