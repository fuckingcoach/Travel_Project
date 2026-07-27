<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Views;
use App\Models\ViewsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 建立測試使用者 (如果不不需要可註解掉)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        ViewsType::insert([
            [
                'typeName' => '自然景觀',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'typeName' => '美食購物',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'typeName' => '體驗活動',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'typeName' => '歷史文化',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 批量寫入 5 筆美食資料
        Views::insert([
            [
                'name' => '阿宗麵線',
                'city' => '臺北市',
                'town' => '萬華區',
                'address' => '臺北市萬華區峨眉街8-1號',
                'typeId' => 1,
                'brief' => '西門町經典老字號大腸麵線，排隊人潮絡繹不絕。',
                'content' => '阿宗麵線創立於1975年，以濃郁的大腸羹湯頭與柴魚香氣聞名。',
                'tel' => '02-23888808',
                'like' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '無名台南碗粿',
                'city' => '臺南市',
                'town' => '中西區',
                'address' => '臺南市中西區國華街三段',
                'typeId' => 1,
                'brief' => '傳統手工古早味碗粿。',
                'content' => '口感扎實，淋上特製蒜蓉醬油膏美味加倍。',
                'tel' => '06-2220000',
                'like' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '宮原眼科冰淇淋',
                'city' => '臺中市',
                'town' => '中區',
                'address' => '臺中市中區中山路20號',
                'typeId' => 2,
                'brief' => '由日治時期眼科診所改建的復古冰淇淋與伴手禮專賣店。',
                'content' => '多款獨特台灣茶葉與水果口味冰淇淋，深受遊客喜愛。',
                'tel' => '04-22271927',
                'like' => 85,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '文章牛肉湯',
                'city' => '臺南市',
                'town' => '安平區',
                'address' => '臺南市安平區安平路300號',
                'typeId' => 1,
                'brief' => '安平必吃溫體牛肉湯，鮮甜甘美。',
                'content' => '嚴選每天新鮮直送的溫體牛肉，高湯現燙。',
                'tel' => '06-2284626',
                'like' => 250,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '佳興冰果室',
                'city' => '花蓮縣',
                'town' => '新城鄉',
                'address' => '花蓮縣新城鄉博愛路22號',
                'typeId' => 3,
                'brief' => '新城老街懷舊冰果室，招牌檸檬汁。',
                'content' => '採用全顆檸檬連皮煉乳打製，酸甜平衡。',
                'tel' => '03-8611888',
                'like' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        $this->call([
            ManagerSeeder::class,
            MemberSeeder::class
        ]);
    }
}
