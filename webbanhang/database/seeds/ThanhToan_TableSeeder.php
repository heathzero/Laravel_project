<?php

use Illuminate\Database\Seeder;

class ThanhToan_TableSeeder extends Seeder
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
                    "Tiền mặt", 
                    "Chuyển khoản ngân hàng", 
                    "MoMo", 
                    "AirPay", 
                    "Viettel Pay"
                ];
        sort($types);

        $today = new DateTime();

        foreach ($types as $key => $value) {
            $list[] = Array(
                'tt_ma'      => $key + 1,
                'tt_ten'     => $value,
                'tt_dienGiai'     => "Thanh toán ".$value,
                'tt_trangThai'     => 2,
                'tt_taoMoi'  => $today->format('Y-m-d H:i:s'),
                'tt_capNhat' => $today->format('Y-m-d H:i:s')
            );
        }
        DB::table('cusc_thanhtoan')->insert($list);
    }
}
