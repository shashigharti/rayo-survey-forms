<?php
use Illuminate\Database\Seeder;

class ReportsMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'display_name' => 'Reports',
                'url' => route('admin.report-designer.reports.index'),
                'name' => 'reports',
                'permission' => 'report-designer.report.manage',
                'package_name' => 'reports',
                'parent_id' => 0,
                'type' => 'primary',
                'icon' => 'md-collection-item'


            ]
        ]);
    }
}
