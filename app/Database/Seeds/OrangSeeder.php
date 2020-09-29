<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama' => 'jakfar shodiq',
        //         'alamat'    => 'jakfarshodiq230@fgmail.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'nama' => 'maulana sarowis',
        //         'alamat'    => 'maulanasarowis@fgmail.com',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];


        //untuk membuat data random
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 400; $i++) {

            $data = [
                'nama' => $faker->name,
                'alamat'    => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];
            $this->db->table('orang')->insert($data);
        }

        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO orang (nama, alamat) VALUES(:nama:, :alamat:)",
        //     $data
        // );

        // Using Query Builder
        //$this->db->table('orang')->insert($data);
        //$this->db->table('orang')->insertBatch($data);

        //membuat faker untuk banyak data dami
        //keyikan "composer require fzaninotto/faker"
    }
}
