<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        if (Gallery::count() > 0) {
            return;
        }

        $items = [
            [
                'title' => 'Bridal Lehenga Story',
                'category' => 'lehenga',
                'image_path' => 'images/hero_bride.png',
                'is_video' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'Silk Saree Heritage',
                'category' => 'saree',
                'image_path' => 'images/promise_bride.png',
                'is_video' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Royal Bridal Ensemble',
                'category' => 'bridal',
                'image_path' => 'images/cat_bridal.png',
                'is_video' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Lehenga Look Video',
                'category' => 'video',
                'image_path' => 'images/cat_lehenga.png',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'is_video' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Royal Package Bride',
                'category' => 'lehenga',
                'image_path' => 'images/pkg_royal.png',
                'is_video' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'Gold Package Saree',
                'category' => 'saree',
                'image_path' => 'images/pkg_gold.png',
                'is_video' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'Silver Package Lehenga',
                'category' => 'lehenga',
                'image_path' => 'images/pkg_silver.png',
                'is_video' => false,
                'sort_order' => 7,
            ],
            [
                'title' => 'Banarasi Silk Saree',
                'category' => 'saree',
                'image_path' => 'images/cat_saree.png',
                'is_video' => false,
                'sort_order' => 8,
            ],
        ];

        foreach ($items as $item) {
            Gallery::create(array_merge($item, ['is_active' => true]));
        }
    }
}
