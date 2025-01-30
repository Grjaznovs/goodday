<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folder = base_path() . '/database/seeders/tablecsv/';
        $files = [
            Role::class  => ['file' => 'c_roles.csv', 'key' => 'code']
        ];

        foreach ($files as $className => $fileConfig) {
            dump($fileConfig['file']);
            if (($handle = fopen($folder . "/" . $fileConfig['file'], "r")) !== FALSE) {
                $headers = null;
                while (($row = fgetcsv($handle, 0, ";")) !== FALSE) {
                    if ($headers) {
                        $insertRow = [];
                        foreach ($headers as $key => $value) {
                            if (isset($row[$key]) && $row[$key] != '') {
                                $insertRow[$value] = $row[$key];
                            } else {
                                $insertRow[$value] = null;
                            }
                        }

                        $className::updateOrCreate(
                            ['code' => $insertRow['code']],
                            [
                                'name' => $insertRow['name'],
                            ]
                        );
                    } else {
                        $headers = $row;
                    }
                }
            } else {
                dump("File not found :`" . $fileConfig['file'] . "`");
            }
        }
    }
}
