<?php
use Migrations\AbstractSeed;

/**
 * Rol seed.
 */
class RolSeed extends AbstractSeed
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
        $permission = [
            [
                'name'        => 'Administrador',
                'description'   => 'ADMINISTRADOR DEL SISTEMA',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Director',
                'description'   => 'DIRECTOR',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Subdirector',
                'description'   => 'SUBDIRECTOR',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Especialista',
                'description'   => 'ESPECIALISTA',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Coordinador fitogenético',
                'description'   => 'COORDINADOR FITOGENETICO',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Especialista in situ',
                'description'   => 'ESPECIALISTA IN SITU',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Coordinador in situ',
                'description'   => 'COORDINADOR IN SITU',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Coordinador semillas',
                'description'   => 'COORNIADOR SEMILLAS',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Coordinador in vitro',
                'description'   => 'COORNIADOR IN VITRO',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Coordinador microorganismo',
                'description'   => 'COORNIADOR MICROORGANISMO',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Coordinador valoración',
                'description'   => 'COORNIADOR VALORACIÓN',
                'created'       => date('Y-m-d H:i:s'),
                'modified'      => date('Y-m-d H:i:s')
            ]
        ];
        $table = $this->table('role');
        $table->insert($permission)->save();
    }
}
