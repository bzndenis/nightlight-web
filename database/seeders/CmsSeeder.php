<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\Gallery;
use App\Models\TeamMember;
use App\Models\FooterSetting;
use App\Models\FooterLink;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Announcement
        Announcement::create([
            'title' => 'ANNOUNCEMENTS',
            'content' => 'Welcome to NightLight Guild! Stay tuned for updates and news.',
            'is_active' => true
        ]);

        // Seed Gallery
        Gallery::create([
            'title' => 'GALLERY',
            'description' => 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.',
            'image_path' => null,
            'order' => 0,
            'is_active' => true
        ]);

        // Seed Team Members
        $teamMembers = [
            ['name' => 'xOrc', 'role' => 'Guild Master', 'quote' => 'Leading NightLight Guild to greatness together.'],
            ['name' => 'Azunyan', 'role' => 'Vice Guild Master', 'quote' => 'Supporting the guild and ensuring our community thrives.'],
            ['name' => 'BangJack', 'role' => 'Vice Guild Master', 'quote' => 'Building a strong and united community.'],
            ['name' => 'Nyxia', 'role' => 'Charisma Baby', 'quote' => 'Bringing charm and energy to our guild.'],
            ['name' => 'NIGATRON', 'role' => 'Officer', 'quote' => 'Keeping order and supporting our members.'],
            ['name' => 'shiroe', 'role' => 'Officer', 'quote' => 'Guiding members through their journey.'],
            ['name' => 'ReilaArdea', 'role' => 'Officer', 'quote' => 'Supporting and organizing guild activities.'],
            ['name' => 'Moonshinee', 'role' => 'Commander', 'quote' => 'Leading our members to victory.']
        ];

        foreach ($teamMembers as $index => $member) {
            TeamMember::create([
                'name' => $member['name'],
                'role' => $member['role'],
                'quote' => $member['quote'],
                'avatar' => null,
                'order' => $index,
                'is_active' => true
            ]);
        }

        // Seed Footer Settings
        FooterSetting::create([
            'description' => 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures. We believe in creating a welcoming environment for all gamers.',
            'copyright_text' => 'All Rights Reserved NightLight Guild.'
        ]);

        // Seed Footer Links
        $footerLinks = [
            ['name' => 'Home', 'url' => '/', 'order' => 1],
            ['name' => 'Information', 'url' => '#about', 'order' => 2],
            ['name' => 'Gallery', 'url' => '#pricing', 'order' => 3],
            ['name' => 'Team', 'url' => '#testimonials', 'order' => 4],
            ['name' => 'Join Guild', 'url' => '#', 'order' => 5]
        ];

        foreach ($footerLinks as $link) {
            FooterLink::create([
                'name' => $link['name'],
                'url' => $link['url'],
                'order' => $link['order'],
                'is_active' => true
            ]);
        }
    }
}
