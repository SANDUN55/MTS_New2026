<?php

namespace Database\Seeders;

use App\Models\Phase;
use App\Models\Strand;
use App\Models\Batch;
use App\Models\ActivityType;
use App\Models\Department;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // Phases
        Phase::firstOrCreate(['code' => 'P1'], ['name' => 'Phase I', 'order' => 1]);
        Phase::firstOrCreate(['code' => 'P2'], ['name' => 'Phase II', 'order' => 2]);
        Phase::firstOrCreate(['code' => 'P3'], ['name' => 'Phase III', 'order' => 3]);

        // Strands
        Strand::firstOrCreate(['code' => 'BAS'], ['name' => 'Basic and Applied Sciences']);
        Strand::firstOrCreate(['code' => 'CS'],  ['name' => 'Clinical Skills']);
        Strand::firstOrCreate(['code' => 'CH'],  ['name' => 'Community Health']);
        Strand::firstOrCreate(['code' => 'PDFM'],['name' => 'Professional Development and Family Medicine']);

        // Batches (example)
        Batch::firstOrCreate(['code' => 'AA'], [
            'academic_year' => '2022/2023',
            'current_year' => 3,
            'is_active' => true,
        ]);
        Batch::firstOrCreate(['code' => 'AW'], [
            'academic_year' => '2023/2024',
            'current_year' => 2,
            'is_active' => true,
        ]);
        Batch::firstOrCreate(['code' => 'IL'], [
            'academic_year' => '2024/2025',
            'current_year' => 1,
            'is_active' => true,
        ]);

        // Departments
        Department::firstOrCreate(['code' => 'ANAT'], ['name' => 'Anatomy']);
        Department::firstOrCreate(['code' => 'PHYS'], ['name' => 'Physiology']);
        Department::firstOrCreate(['code' => 'BIOC'], ['name' => 'Biochemistry']);
        Department::firstOrCreate(['code' => 'PATH'], ['name' => 'Pathology']);
        Department::firstOrCreate(['code' => 'MICR'], ['name' => 'Microbiology']);
        Department::firstOrCreate(['code' => 'PHAR'], ['name' => 'Pharmacology']);
        Department::firstOrCreate(['code' => 'MED'],  ['name' => 'Medicine']);
        Department::firstOrCreate(['code' => 'SURG'], ['name' => 'Surgery']);
        Department::firstOrCreate(['code' => 'PAED'], ['name' => 'Paediatrics']);
        Department::firstOrCreate(['code' => 'OBGY'], ['name' => 'Obstetrics & Gynaecology']);
        Department::firstOrCreate(['code' => 'ME'],   ['name' => 'Medical Education']);

        // Activity Types
        $activities = [
            ['code' => 'LEC', 'name' => 'Theory Lecture', 'requires_lecturer' => true, 'is_group_activity' => false],
            ['code' => 'SDL', 'name' => 'Self-Directed Learning', 'requires_lecturer' => false, 'is_group_activity' => false],
            ['code' => 'PBL', 'name' => 'Problem Based Learning', 'requires_lecturer' => true, 'is_group_activity' => true],
            ['code' => 'SGD', 'name' => 'Small Group Discussion', 'requires_lecturer' => true, 'is_group_activity' => true],
            ['code' => 'PRA', 'name' => 'Practical', 'requires_lecturer' => true, 'is_group_activity' => true],
            ['code' => 'TUT', 'name' => 'Tutorial', 'requires_lecturer' => true, 'is_group_activity' => true],
            ['code' => 'SEM', 'name' => 'Student Seminar', 'requires_lecturer' => true, 'is_group_activity' => true],
            ['code' => 'CLI', 'name' => 'Clinical Class', 'requires_lecturer' => true, 'is_group_activity' => false],
        ];

        foreach ($activities as $activity) {
            ActivityType::firstOrCreate(
                ['code' => $activity['code']],
                $activity
            );
        }
    }
}