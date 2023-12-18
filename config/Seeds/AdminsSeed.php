<?php
use Migrations\AbstractSeed;

/**
 * Admins seed.
 */
class AdminsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        //$hasher = new DefaultPasswordHasher();
        // $password = $hasher->hash('1234567u');
        $password = '1234567u';
        $password = md5('ab513c75f48d82bcd30aa48e478d2e6e'.$password);
        $data[] = [
            'role_id'    => 1,
            'username'  => 'elvis.sanchez',
            'names'   => 'Elvis Manuel',
            'surnames' => 'Sanchez Gonzales',
            'email'     => 'elvissg.sis@gmail.com',
            'password'  => $password,
            'created'   => date('Y-m-d H:i:s'),
            'modified'  => date('Y-m-d H:i:s'),
            'country_id' => 173,
            'token' =>  md5('ab513c75f48d82bcd30aa48e478d2e6eelvis.sanchez')
        ];

        $data[] = [
            'role_id'    => 1,
            'username'  => 'jose.miguel',
            'names'   => 'Jose Miguel',
            'surnames' => 'Apellido1 Apellido2',
            'email'     => 'email@gmail.com',
            'password'  => $password,
            'created'   => date('Y-m-d H:i:s'),
            'modified'  => date('Y-m-d H:i:s'),
            'country_id' => 173,
            'token' =>  md5('ab513c75f48d82bcd30aa48e478d2e6ejose.miguel')
        ];

        $data[] = [
            'role_id'    => 1,
            'username'  => 'aly.rosado',
            'names'   => 'Aly Katherine',
            'surnames' => 'Rosado Pumayauli',
            'email'     => 'aly.rp8@gmail.com',
            'password'  => $password,
            'created'   => date('Y-m-d H:i:s'),
            'modified'  => date('Y-m-d H:i:s'),
            'country_id' => 173,
            'token' =>  md5('ab513c75f48d82bcd30aa48e478d2e6ealy.rosado')
        ];
        $table = $this->table('User');
        $table->insert($data)->save();
    }
}
