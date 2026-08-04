<?php

namespace Database\Seeders;

use App\Models\MemberWishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberWishlist::created([
            'id' => 1,
            'memberId' => 1,
            'viewsId' => 1
        ]);

        MemberWishlist::created([
            'id' => 1,
            'memberId' => 1,
            'viewsId' => 2
        ]);

        MemberWishlist::created([
            'id' => 1,
            'memberId' => 1,
            'viewsId' => 3
        ]);
    }
}
