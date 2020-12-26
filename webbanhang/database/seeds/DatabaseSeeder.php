<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(Loai_TableSeeder::class);
         $this->call(ThanhToan_TableSeeder::class);
         $this->call(SanPham_TableSeeder::class);
         $this->call(KhachHang_TableSeeder::class);
         $this->call(Mau_TableSeeder::class);
    }
}
