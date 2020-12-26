<?php

use Illuminate\Database\Seeder;

class Loai_TableSeeder extends Seeder
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
                    "Hoa lẻ", 
                    "Phụ liệu", 
                    "Bó hoa", 
                    "Giỏ hoa", 
                    "Hoa hộp giấy", 
                    "Kệ hoa", 
                    "Vòng hoa", 
                    "Bình hoa", 
                    "Hoa hộp gỗ"
                ];
//        sort($types);

        $today = new DateTime();

        foreach ($types as $key => $value) {
            $list[] = Array(
                'l_ma'      => $key,
                'l_ten'     => $value,
                'l_taoMoi'  => $today->format('Y-m-d H:i:s'),
                'l_capNhat' => $today->format('Y-m-d H:i:s')
            );
        }
        DB::table('cusc_loai')->insert($list);
    }
}
