<?php

use Illuminate\Database\Seeder;

class Mau_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $list = [];

        $types = [
                    "Mẫu mùa xuân", 
                    "Mẫu mùa hè", 
                    "Mẫu mùa thu", 
                    "Mẫu mùa đông", 
                    "Mẫu 20/11"
                ];
        sort($types);

        $today = new DateTime();

        foreach ($types as $key => $value) {
            $list[] = Array(
                'm_ma'      => $key + 1,
                'm_ten'     => $value,
                'm_taoMoi'  => $today->format('Y-m-d H:i:s'),
                'm_taoMoi' => $today->format('Y-m-d H:i:s'),
                'm_trangThai' => 2
            );
        }
        DB::table('cusc_mau')->insert($list);
    }
}
