<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Database\Seeder;
use App\OtaceCriteriaSection;

class OtaceCriteriaSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $_otace_criteria_sections = [
            [
                'section_name' => 'Functional',
            ],
            [
                'section_name' => 'Quality of Deliverables',
            ],
            [
                'section_name' => 'Behavioral',
            ],
            [
                'section_name' => 'Capability Assessment: Please give qualitative feedback on each capability in team. Please add on anything you might want to, to the criteria specified.',
            ],
        ];

        OtaceCriteriaSection::insert($_otace_criteria_sections);
    }
}
