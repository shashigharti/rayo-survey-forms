<?php

use Illuminate\Database\Seeder;

/**
 * Class ProjectMenuTableSeeder
 */
class LogFrameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_partners')->insert([
            [
                'project_id' => 1,
                'name' => 'Women Against Poverty',
                'acronym' => 'WAP',
                'organization_type' => 'Non Governmental Organization NGO',
                'description' => 'This organization is a lead organization for implementing the',
                'type' => 'Lead Organization',
                'contact_person' => 'Rue Pierre Culliford',
                'contact_number' => '9856324415',
                'contact_email' => 'rue@gmail.com',
                'contact_address' => 'Belgium',
                'designation' => 'Manager'
            ]
        ]);

        DB::table('project_targets')->insert([
            [
                'project_id' => 1,
                'name' => 'Family Farmers',
                'type' => 'Family',
                'number_of_beneficiaries' => 1200,
                'micro_beneficiaries' => json_encode([]),

            ],
            [
                'project_id' => 1,
                'name' => 'Farmers organization',
                'type' => 'Community',
                'number_of_beneficiaries' => 60,
                'micro_beneficiaries' => json_encode([]),

            ],
            [
                'project_id' => 1,
                'name' => 'Farmers Unions',
                'type' => 'Enterprise',
                'number_of_beneficiaries' => 3,
                'micro_beneficiaries' => json_encode([]),

            ]
        ]);

        DB::table('project_goals')->insert([
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Sufficient quantities of agricultural produce available in population centres throughout the year',
                'numbering' => '1'
            ],
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Sufficient quantities of quality produce available to agro-industry',
                'numbering' => '2'
            ],
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Re-establishment of trade in agricultural products to other regions in DRC',
                'numbering' => '3'
            ],
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Re-establishment of trade in agricultural products with neigbouring countries',
                'numbering' => '4'
            ],
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Return of Internally Displaced Persons and refugees to the region',
                'numbering' => '5'
            ],
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Reduced malnutrition, especially with (young) children',
                'numbering' => '6'
            ],
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Improved security climate',
                'numbering' => '7'
            ]
        ]);

        DB::table('project_outcomes')->insert([
            [
                'project_id' => 1,
                'parent_id' => 0,
                'name' => 'Improved food security and income of 3600 farmer households throughout the year',
                'numbering' => '1'
            ]
        ]);

        DB::table('project_outputs')->insert([
            [
                'project_id' => 1,
                'outcome_id' => 1,
                'parent_id' => 0,
                'name' => 'The production and productivity per household have increased',
                'numbering' => '1-1'
            ],
            [
                'project_id' => 1,
                'outcome_id' => 1,
                'parent_id' => 0,
                'name' => 'Farmers get improved selling price for their produce and have access to new and lucrative markets',
                'numbering' => '1-2'
            ],
            [
                'project_id' => 1,
                'outcome_id' => 1,
                'parent_id' => 0,
                'name' => 'The farmers are organised in 60 farmer organisations that strengthen the individual farmers and defend their interests',
                'numbering' => '1-3'
            ],
            [
                'project_id' => 1,
                'outcome_id' => 1,
                'parent_id' => 0,
                'name' => 'Farmer organisations create 3 regional unions to increase political, social and economic leverage and lobbying power',
                'numbering' => '1-4'
            ]
        ]);

        DB::table('project_activities')->insert([
            [
                'project_id' => 1,
                'output_id' => 1,
                'parent_id' => 0,
                'name' => 'Provision of quality seeds, seedlings and tools to farmers',
                'type' => 'Other',
                'numbering' => '1-1-1'
            ],
            [
                'project_id' => 1,
                'output_id' => 1,
                'parent_id' => 2,
                'name' => 'Provision of tools to farmers',
                'type' => 'Other',
                'numbering' => '1-1-1-1'
            ],
            [
                'project_id' => 1,
                'output_id' => 1,
                'parent_id' => 2,
                'name' => 'Provision of quality seeds and seedlings to farmers by project team',
                'type' => 'Other',
                'numbering' => '1-1-1-2'
            ]
        ]);


        DB::table('project_indicators')->insert([
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Goal',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Volume of agricultural products transported to population centres',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '0',
                'numbering' => '1-1'
            ],
            [
                'indicatable_id' => 2,
                'indicatable_type' => 'Robust\Projects\Models\Goal',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Volume of agricultural products sold to agro-industry',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '0',
                'numbering' => '2-1'
            ],
            [
                'indicatable_id' => 3,
                'indicatable_type' => 'Robust\Projects\Models\Goal',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Volume of agricultural products transported to other regions in DRC',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '0',
                'numbering' => '3-1'
            ],
            [
                'indicatable_id' => 4,
                'indicatable_type' => 'Robust\Projects\Models\Goal',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Volume of agricultural products transported to neighbouring countries',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '0',
                'numbering' => '4-1'
            ],
            [
                'indicatable_id' => 5,
                'indicatable_type' => 'Robust\Projects\Models\Goal',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of IDPs returned to the region over the course of the project',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '0',
                'numbering' => '5-1'
            ],
            [
                'indicatable_id' => 6,
                'indicatable_type' => 'Robust\Projects\Models\Goal',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of children treated for malnutrition in health care centres',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '0',
                'numbering' => '6-1'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of meals per day',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-1'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Evolution in quality and nutritional value of meals',
                'type' => 'checkbox',
                'properties' => '{"options":"Very Satisfied, Satisfied, Neutral, Dissatisfied, Very Dissatisfied"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-2'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Household income as measured by ability to invest and pay for other costs than food',
                'type' => 'text',
                'properties' => '{"placeholder":"","field_size":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to send children to school and pay costs of education',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-1'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to pay for medical costs',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-2'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 12,
                'project_id' => 1,
                'name' => 'Are you able to pay for medical treatment?',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-2-1'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 12,
                'project_id' => 1,
                'name' => 'Are you able to pay for medication from a regular pharmicist (not from shop)?',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-2-2'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to improve housing situation over the previous two years',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-3'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to invest in livestock',
                'type' => 'radio',
                'properties' => '{"options":"Yes, No"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-4'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to invest in machinery?',
                'type' => 'radio',
                'properties' => '{"options":"Yes, No"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-5'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to buy/pay for own means of transport',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-6'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Outcome',
                'parent_id' => 10,
                'project_id' => 1,
                'name' => 'Ability to obtain and reimburse credit',
                'type' => 'checkbox',
                'properties' => '{"options":"Option 1, Option 2, Option 3"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-3-7'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Evolution of production volume',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-1-1'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Ratio of production volume to cultivation area',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '0',
                'numbering' => '1-1-2'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Percentage of harvest lost due to plant diseases',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-1-3'
            ],
            [
                'indicatable_id' => 1,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Application of farming techniques taught during trainings',
                'type' => 'radio',
                'properties' => '{"options":"Satisfied, Neutral, Dissatisfied"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '1',
                'numbering' => '1-1-4'
            ],
            [
                'indicatable_id' => 2,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of markets identified by farmer organisations over the course of the project',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '2',
                'numbering' => '1-2-1'
            ],
            [
                'indicatable_id' => 2,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Average selling price per type of produce',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '0',
                'numbering' => '1-2-2'
            ],
            [
                'indicatable_id' => 3,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of farmer organisations that actively provide support to their members (information, training, identifying new markets...)',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '0',
                'numbering' => '1-3-1'
            ],
            [
                'indicatable_id' => 3,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of members per farmer organisation',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '2',
                'numbering' => '1-3-2'
            ],
            [
                'indicatable_id' => 3,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Appreciation of member farmers of their farmer organisation and the support that they receive',
                'type' => 'radio',
                'properties' => '{"options":"Satisfied, Neutral, Dissatisfied"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '2',
                'numbering' => '1-3-3'
            ],
            [
                'indicatable_id' => 4,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of regional unions',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '3',
                'numbering' => '1-4-1'
            ],
            [
                'indicatable_id' => 4,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Number of member organisations per union',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '3',
                'numbering' => '1-4-2'
            ],
            [
                'indicatable_id' => 4,
                'indicatable_type' => 'Robust\Projects\Models\Output',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Appreciation of member organisations of the union and of its work',
                'type' => 'radio',
                'properties' => '{"options":"Liked, Neutral, Disliked"}',
                'baseline' => '',
                'registration' => 'Beneficiary Level',
                'target_id' => '3',
                'numbering' => '1-4-3'
            ],
            [
                'indicatable_id' => 3,
                'indicatable_type' => 'Robust\Projects\Models\Activity',
                'parent_id' => 0,
                'project_id' => 1,
                'name' => 'Volume of seeds and seedlings provided by project team',
                'type' => 'number',
                'properties' => '{"minimum":"","maximum":""}',
                'baseline' => '',
                'registration' => 'Programme Level',
                'target_id' => '3',
                'numbering' => '1-1-1-2-1'
            ],


        ]);

        DB::table('project_assumptions')->insert([
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Goal',
                'project_id' => '1',
                'assumption' => 'Sufficient number of farmers want to participate and can be assisted despite difficult logistical and security circumstances',
                'numbering' => '1-1'
            ],
            [
                'assumable_id' => 3,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Goal',
                'project_id' => '1',
                'assumption' => 'Re-building of main bridges and continuing improvement of main trade routes',
                'numbering' => '3-1'
            ],
            [
                'assumable_id' => 3,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Goal',
                'project_id' => '1',
                'assumption' => 'Political will to reduce practice of police barriers and impromptu taxes',
                'numbering' => '3-2'
            ],
            [
                'assumable_id' => 4,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Goal',
                'project_id' => '1',
                'assumption' => 'Reduction of tariffs',
                'numbering' => '4-1'
            ],
            [
                'assumable_id' => 5,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Goal',
                'project_id' => '1',
                'assumption' => 'Risk of return of fighting and/or instability within the region',
                'numbering' => '5-1'
            ],
            [
                'assumable_id' => 5,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Goal',
                'project_id' => '1',
                'assumption' => 'Returnees can reclaim their fields and posessions',
                'numbering' => '5-2'
            ],
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Outcome',
                'project_id' => '1',
                'assumption' => 'Sufficient access to remote areas, especially during the rainy season',
                'numbering' => '1-1'
            ],
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Outcome',
                'project_id' => '1',
                'assumption' => 'Further reduction of tensions between population groups and no re-emergence of violent conflict',
                'numbering' => '1-2'
            ],
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Normal climate conditions',
                'numbering' => '1-1-1'
            ],
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Farmers apply techniques that they learn',
                'numbering' => '1-1-2'
            ],
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Young people get motivated to work on the farm rather than pursue criminal activities or try their luck in illigitimate mining',
                'numbering' => '1-1-3'
            ],
            [
                'assumable_id' => 2,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Transporters are willing to go to more remote areas again because of larger volumes and better quality of roads',
                'numbering' => '1-2-1'
            ],
            [
                'assumable_id' => 2,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Road improvement programme of BTB continuous as planned',
                'numbering' => '1-2-2'
            ],
            [
                'assumable_id' => 2,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'No protectionism or extreme fees on market level',
                'numbering' => '1-2-3'
            ],
            [
                'assumable_id' => 3,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Internal stability of farmer organisations through democratic and inclusive functioning; no hijacking of organisations by individuals (presidents or directors) to serve their private interests',
                'numbering' => '1-3-1'
            ],
            [
                'assumable_id' => 3,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'No financial mismanagement of the resources of the farmer organisations',
                'numbering' => '1-3-2'
            ],
            [
                'assumable_id' => 3,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Sufficient level of initiative of members to advance their organisation and improve the situation of the members',
                'numbering' => '1-3-3'
            ],
            [
                'assumable_id' => 4,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Output',
                'project_id' => '1',
                'assumption' => 'Sufficient time to first develop the level of the farmer organisations and then bring them together in three umbrella organisations',
                'numbering' => '1-4-1'
            ],
            [
                'assumable_id' => 1,
                'parent_id' => 0,
                'assumable_type' => 'Robust\Projects\Models\Activity',
                'project_id' => '1',
                'assumption' => 'Quality seeds and seedlings are available at the start of the project',
                'numbering' => '1-1-1-1'
            ]
        ]);
    }
}