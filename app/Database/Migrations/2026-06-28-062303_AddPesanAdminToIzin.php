<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPesanAdminToIzin extends Migration
{
    public function up()
    {
        $this->forge->addColumn('izin', [
            'pesan_admin' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'pesan'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('izin', 'pesan_admin');
    }
}
