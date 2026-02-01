<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('Test123'),
                'role' => 1,
                'phone' => '0771234567',
                'address' => 'Admin Address',
            ]
        );
        
        // Create a test customer
        User::firstOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('Test123'),
                'role' => 2,
                'phone' => '0712345678',
                'address' => 'Customer Address',
            ]
        );

        User::firstOrCreate(
            ['email' => 'kaushi@aura.com'],
            [
                'name' => 'Kaushi',
                'password' => Hash::make('Test123'),
                'role' => 1,
                'phone' => '0770000000',
                'address' => 'Test Address',
            ]
        );
        
        // Seed Products
        $products = [
            // Women's Collection
            ['name' => 'Amberelle', 'price' => 12500, 'image' => 'amberelle.jpg', 'description' => 'A warm, amber-infused scent with hints of vanilla and musk.', 'category' => 'Women'],
            ['name' => 'Flora', 'price' => 13500, 'image' => 'flora.jpg', 'description' => 'A blooming bouquet of jasmine, rose, and lily.', 'category' => 'Women'],
            ['name' => 'Mistara', 'price' => 12000, 'image' => 'mistara.jpg', 'description' => 'Light and airy, like a gentle sea breeze.', 'category' => 'Women'],
            ['name' => 'Bambina', 'price' => 14500, 'image' => 'bambina.jpg', 'description' => 'Soft and powdery, an essence of pure grace.', 'category' => 'Women'],
            ['name' => 'Cedarlyn', 'price' => 13800, 'image' => 'cedarlyn.jpg', 'description' => 'Cedarwood blended with delicate floral notes.', 'category' => 'Women'],
            ['name' => 'Cinnara', 'price' => 15200, 'image' => 'cinnara.jpg', 'description' => 'Spicy cinnamon warmth with a touch of sweetness.', 'category' => 'Women'],
            ['name' => 'Drift', 'price' => 12900, 'image' => 'drift.jpg', 'description' => 'Drift away with this calming oceanic fragrance.', 'category' => 'Women'],
            ['name' => 'Elantra', 'price' => 14100, 'image' => 'elantra.jpg', 'description' => 'Elegant and timeless, for the modern woman.', 'category' => 'Women'],
            ['name' => 'Emberlace', 'price' => 15500, 'image' => 'emberlace.jpg', 'description' => 'Fiery and passionate, a scent that leaves a mark.', 'category' => 'Women'],
            ['name' => 'Frostelle', 'price' => 13200, 'image' => 'frostelle.jpg', 'description' => 'Cool and crisp, like a winter morning.', 'category' => 'Women'],
            ['name' => 'Galacinne', 'price' => 16000, 'image' => 'galacinne.jpg', 'description' => 'A galaxy of scents, mysterious and allure.', 'category' => 'Women'],
            ['name' => 'Ivoria', 'price' => 14800, 'image' => 'ivoria.jpg', 'description' => 'Smooth as ivory, rich and creamy.', 'category' => 'Women'],
            ['name' => 'Miravelle', 'price' => 13700, 'image' => 'miravelle.jpg', 'description' => 'A miracle of nature captured in a bottle.', 'category' => 'Women'],
            ['name' => 'Tidea', 'price' => 12600, 'image' => 'tidea.jpg', 'description' => 'Flowing and rhythmic, like the tides.', 'category' => 'Women'],
            
            // Men's Collection
            ['name' => 'Cobalt', 'price' => 14000, 'image' => 'cobalt.jpg', 'description' => 'A strike of fresh citrus and deep ocean notes.', 'category' => 'Men'],
            ['name' => 'Noir', 'price' => 16000, 'image' => 'noir.jpg', 'description' => 'Mysterious and dark, with notes of oud and leather.', 'category' => 'Men'],
            ['name' => 'Ashborne', 'price' => 15500, 'image' => 'ashborne.jpg', 'description' => 'Smoky ash and born of fire, intense and bold.', 'category' => 'Men'],
            ['name' => 'Cobaltray', 'price' => 14800, 'image' => 'cobaltray.jpg', 'description' => 'A ray of cobalt blue sharp energy.', 'category' => 'Men'],
            ['name' => 'Gravelle', 'price' => 15200, 'image' => 'gravelle.jpg', 'description' => 'Grounded and earthy, solid masculinity.', 'category' => 'Men'],
            ['name' => 'Ironwood', 'price' => 16500, 'image' => 'ironwood.jpg', 'description' => 'Strong as iron, deep as the woods.', 'category' => 'Men'],
            ['name' => 'Onxy', 'price' => 15800, 'image' => 'onxy.jpg', 'description' => 'Dark gemstone inspired, precious and powerful.', 'category' => 'Men'],
            ['name' => 'Onyx Pulse', 'price' => 16200, 'image' => 'onyxpulse.jpg', 'description' => 'The pulsating heart of the night.', 'category' => 'Men'],
            ['name' => 'Tempra', 'price' => 14900, 'image' => 'tempra.jpg', 'description' => 'Hot and cold, a temperamental masterpiece.', 'category' => 'Men'],
            ['name' => 'Vantros', 'price' => 17000, 'image' => 'vantros.jpg', 'description' => 'Victory in a bottle, commanding and lead.', 'category' => 'Men'],
            ['name' => 'Vantros Bold', 'price' => 17500, 'image' => 'vantrosbold.jpg', 'description' => 'Boldness defined, for the fearless.', 'category' => 'Men'],

            // Gifts
            ['name' => 'Fresh', 'price' => 11000, 'image' => 'fresh.jpg', 'description' => 'Crisp linen and morning dew, perfect for daily wear.', 'category' => 'Gifts'],
            ['name' => 'Roselune', 'price' => 14500, 'image' => 'roselune.jpg', 'description' => 'A romantic blend of red roses and moonlight berries.', 'category' => 'Gifts'],

            // Kids' Collection
            ['name' => 'Anna Fairy Fresh', 'price' => 7500, 'image' => 'anna.jpg', 'description' => 'A magical fresh scent for little princesses.', 'category' => 'Kids'],
            ['name' => 'Bubble Fun', 'price' => 8500, 'image' => 'bubble.jpg', 'description' => 'Bubbly and playful fragrance for active kids.', 'category' => 'Kids'],
            ['name' => 'Cotton Cloud', 'price' => 9000, 'image' => 'cotton.jpg', 'description' => 'Soft and gentle as a fluffy white cloud.', 'category' => 'Kids'],
            ['name' => 'Labubu Magic', 'price' => 9500, 'image' => 'labubu.jpg', 'description' => 'A mysterious and fun scent inspired by forest spirits.', 'category' => 'Kids'],
            ['name' => 'Lolly Pop', 'price' => 7500, 'image' => 'lollipop.jpg', 'description' => 'Sweet and sugary, just like your favorite treat.', 'category' => 'Kids'],
            ['name' => 'Lightning McQueen', 'price' => 10500, 'image' => 'macqueen.jpg', 'description' => 'Fast and fresh scent for little racing fans.', 'category' => 'Kids'],
            ['name' => 'Magic Wand', 'price' => 9800, 'image' => 'magic.jpg', 'description' => 'Sparkly and enchanting fragrance for magical moments.', 'category' => 'Kids'],
            ['name' => 'Teddy Hug', 'price' => 8200, 'image' => 'teddy.jpg', 'description' => 'Warm and comforting, like a hug from your favorite teddy.', 'category' => 'Kids'],
            ['name' => 'Twinkle Star', 'price' => 8800, 'image' => 'twinkle.jpg', 'description' => 'Shining bright with sweet and sparkly notes.', 'category' => 'Kids'],
            ['name' => 'Yellow Sun', 'price' => 8900, 'image' => 'yellow.png', 'description' => 'Bright and cheerful citrus scent for sunny days.', 'category' => 'Kids'],
            ['name' => 'Elza Frozen', 'price' => 11500, 'image' => 'elza.png', 'description' => 'Icy fresh and magical scent from the frozen kingdom.', 'category' => 'Kids'],
            ['name' => 'Stitch Surprise', 'price' => 9200, 'image' => 'stitch.jpg', 'description' => 'An adventurous and tropical berry scent.', 'category' => 'Kids'],
        ];

        foreach ($products as $product) {
            \App\Models\Product::firstOrCreate(
                ['name' => $product['name']],
                $product
            );
        }

        // Add Extended Gift Collections for functional "View Details" buttons
        $giftExtensions = [
            // He Will Love
            ['name' => 'For Him Luxe Pack', 'price' => 18500, 'image' => 'formens.jpg', 'description' => 'A curated selection of our finest masculine scents for the sophisticated man.', 'category' => 'Gifts'],
            ['name' => 'Executive Gift Set', 'price' => 22000, 'image' => 'menoffice.jpg', 'description' => 'Perfect for the professional, featuring crisp and commanding office fragrances.', 'category' => 'Gifts'],
            ['name' => 'Weekend Explorer Pack', 'price' => 15000, 'image' => 'menweekend.jpg', 'description' => 'Casual yet refined scents for his leisure time and adventures.', 'category' => 'Gifts'],
            
            // She Will Love
            ['name' => 'For Her Elegance Pack', 'price' => 19500, 'image' => 'forwomens.jpg', 'description' => 'Our most popular feminine fragrances presented in a luxury gift box.', 'category' => 'Gifts'],
            ['name' => 'Professional Lady Set', 'price' => 21000, 'image' => 'womenoffice.jpg', 'description' => 'Sophisticated and graceful scents designed for the modern workplace.', 'category' => 'Gifts'],
            ['name' => 'Charming Weekend Pack', 'price' => 16500, 'image' => 'womenweekend.jpg', 'description' => 'Light, playful, and refreshing fragrances for her relaxed moments.', 'category' => 'Gifts'],
            ['name' => 'Warm Comfort Set', 'price' => 17800, 'image' => 'worm.jpg', 'description' => 'Amber and vanilla based scents that feel like a soft embrace.', 'category' => 'Gifts'],
            ['name' => 'Tropelle Mist Collection', 'price' => 14500, 'image' => 'tropelle.jpg', 'description' => 'A vibrant bouquet of tropical notes for a refreshing aura.', 'category' => 'Gifts'],

            // Cutie Pie
            ['name' => 'Little Star Gift Pack', 'price' => 9500, 'image' => 'forkids.jpg', 'description' => 'Gentle and fun fragrances for the little stars of your life.', 'category' => 'Gifts'],
            ['name' => 'Wonderland Collection', 'price' => 11000, 'image' => 'kidsgift4.jpg', 'description' => 'A magical journey of sweet and sparkling scents for children.', 'category' => 'Gifts'],
            ['name' => 'Playful Aura Set', 'price' => 8800, 'image' => 'kidsgiftpack2.jpg', 'description' => 'Bubbly and light fragrances perfect for daily play and joy.', 'category' => 'Gifts'],
            ['name' => 'Magical Moments Pack', 'price' => 12500, 'image' => 'kidsgiftpackage1.jpg', 'description' => 'Enchanting scents that capture the innocence and magic of childhood.', 'category' => 'Gifts'],

            // Vouchers
            ['name' => 'Luxe Gift Voucher - 5000', 'price' => 5000, 'image' => 'vouchr3.jpg', 'description' => 'Give the gift of choice with an Aura Luxe Gift Voucher.', 'category' => 'Gifts'],
            ['name' => 'Luxe Gift Voucher - 10000', 'price' => 10000, 'image' => 'voucher4.jpg', 'description' => 'Upgrade their fragrance collection with a 10,000 LKR voucher.', 'category' => 'Gifts'],
            ['name' => 'Luxe Gift Voucher - 15000', 'price' => 15000, 'image' => 'voucher2.jpg', 'description' => 'The ultimate gift experience for any perfume enthusiast.', 'category' => 'Gifts'],
            ['name' => 'Luxe Gift Voucher - 20000', 'price' => 20000, 'image' => 'voucher1.jpg', 'description' => 'A premium 20,000 LKR gift voucher for our most exclusive scents.', 'category' => 'Gifts'],
        ];

        foreach ($giftExtensions as $gift) {
            \App\Models\Product::firstOrCreate(
                ['name' => $gift['name']],
                $gift
            );
        }
    }
}
