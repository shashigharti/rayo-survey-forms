<?php

use Illuminate\Database\Seeder;

/**
 * Class ProjectMenuTableSeeder
 */
class ProjectSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_micro_benificiaries')->insert([
            [
                'name' => 'Male',
                'description' => 'Male',
                'project_id' => 1
            ],
            [
                'name' => 'Female',
                'description' => 'Female',
                'project_id' => 1
            ],
            [
                'name' => 'Male',
                'description' => 'Male',
                'project_id' => 2
            ],
            [
                'name' => 'Female',
                'description' => 'Female',
                'project_id' => 2
            ]
        ]);

        DB::table('project_organization_types')->insert([
            [
                'name' => 'Non Governmental Organization NGO',
                'description' => 'Non Governmental Organization NGO',
                'project_id' => 1
            ],
            [
                'name' => 'Non-Profit Organization',
                'description' => 'Non-Profit Organization',
                'project_id' => 1
            ],
            [
                'name' => 'Government Organization',
                'description' => 'Government Organization',
                'project_id' => 1
            ],
            [
                'name' => 'Multilateral Organization',
                'description' => 'Multilateral Organization',
                'project_id' => 1
            ],
            [
                'name' => 'Company',
                'description' => 'Company',
                'project_id' => 1
            ], [
                'name' => 'Non Governmental Organization NGO',
                'description' => 'Non Governmental Organization NGO',
                'project_id' => 2
            ],
            [
                'name' => 'Non-Profit Organization',
                'description' => 'Non-Profit Organization',
                'project_id' => 2
            ],
            [
                'name' => 'Government Organization',
                'description' => 'Government Organization',
                'project_id' => 2
            ],
            [
                'name' => 'Multilateral Organization',
                'description' => 'Multilateral Organization',
                'project_id' => 2
            ],
            [
                'name' => 'Company',
                'description' => 'Company',
                'project_id' => 2
            ],

        ]);

        DB::table('project_benificiary_types')->insert([
            [
                'name' => 'Individual',
                'description' => 'Individual',
                'project_id' => 1
            ],
            [
                'name' => 'Family',
                'description' => 'Family',
                'project_id' => 1
            ],
            [
                'name' => 'Extended Family',
                'description' => 'Extended Family',
                'project_id' => 1
            ],
            [
                'name' => 'Community',
                'description' => 'Community',
                'project_id' => 1
            ],
            [
                'name' => 'Enterprise',
                'description' => 'Enterprise',
                'project_id' => 1
            ], [
                'name' => 'Individual',
                'description' => 'Individual',
                'project_id' => 2
            ],
            [
                'name' => 'Family',
                'description' => 'Family',
                'project_id' => 2
            ],
            [
                'name' => 'Extended Family',
                'description' => 'Extended Family',
                'project_id' => 2
            ],
            [
                'name' => 'Community',
                'description' => 'Community',
                'project_id' => 2
            ],
            [
                'name' => 'Enterprise',
                'description' => 'Enterprise',
                'project_id' => 2
            ],

        ]);

        DB::table('project_registration_types')->insert([
            [
                'name' => 'Programme Level',
                'description' => 'Programme level: one (periodic) measurement for the whole programme',
                'project_id' => 1
            ],
            [
                'name' => 'Team Level',
                'description' => 'Team level: measurements of different teams can be aggregated on programme level',
                'project_id' => 1
            ],
            [
                'name' => 'Beneficiary Level',
                'description' => 'Beneficiary level: information is measured with the/a sample of benefifiaries and then aggregated',
                'project_id' => 1
            ], [
                'name' => 'Programme Level',
                'description' => 'Programme level: one (periodic) measurement for the whole programme',
                'project_id' => 2
            ],
            [
                'name' => 'Team Level',
                'description' => 'Team level: measurements of different teams can be aggregated on programme level',
                'project_id' => 2
            ],
            [
                'name' => 'Beneficiary Level',
                'description' => 'Beneficiary level: information is measured with the/a sample of benefifiaries and then aggregated',
                'project_id' => 2
            ],
        ]);

        DB::table('project_mne_types')->insert([
            [
                'name' => 'Process Monitoring',
                'description' => 'Process Monitoring',
                'project_id' => 1
            ],
            [
                'name' => 'Impact Monitoring',
                'description' => 'Impact Monitoring',
                'project_id' => 1
            ],
            [
                'name' => 'Process Monitoring',
                'description' => 'Process Monitoring',
                'project_id' => 2
            ],
            [
                'name' => 'Impact Monitoring',
                'description' => 'Impact Monitoring',
                'project_id' => 2
            ]
        ]);
    }
}