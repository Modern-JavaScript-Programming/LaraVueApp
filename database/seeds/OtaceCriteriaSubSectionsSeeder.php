<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Database\Seeder;
use App\OtaceCriteriaSection;
use App\OtaceCriteriaSubsection;

class OtaceCriteriaSubSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adding subsection for section 'Functional'

        // Feth record based on section 'Functional'
        $_otace_criteria_section = OtaceCriteriaSection::where("section_name", "Functional")->first();

        // Create Sub Section Model Instance to insert data in otace_criteria_subsections table
        $_otace_criteria_subsection = new OtaceCriteriaSubsection();

        // When updating a belongsTo relationship, you may use the associate method. This method will set the foreign key on the child model:
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);

        // Assign Sub Section name
        $_otace_criteria_subsection->subsection_name = 'Knowledge of Domain';
        $_otace_criteria_subsection->subsection_desc = 'Do engagement resources have requisite knowledge about the domain?';
        $_otace_criteria_subsection->rating = 'Y';
        // Save the record in table
        $_otace_criteria_subsection->save();

        // Repeat the above process
        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Understanding of Deliverables';
        $_otace_criteria_subsection->subsection_desc = 'Do engagement resources demonstrate an understanding of content/idea to be presented identifying all relevant perspectives for creating/delivering the same?';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Timely Updates';
        $_otace_criteria_subsection->subsection_desc = 'Do engagment resources provide meaningful updates to you on stage of development with the right frequency?';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();


        // Adding subsection for section 'Quality of Deliverables'
        $_otace_criteria_section = OtaceCriteriaSection::where("section_name", "Quality of Deliverables")->first();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Quality of Inputs';
        $_otace_criteria_subsection->subsection_desc = 'Do engagement  resources provide valuable inputs to improve the program/product/asset?';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Accuracy';
        $_otace_criteria_subsection->subsection_desc = 'Final program/product/asset delivered is accurate as per brief
        5 - 90% + accuracy, 4 - 85% - 90%, 3 - 75% - 85%, 2 - 50% - 75%, 1 - below 50%';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Timeliness';
        $_otace_criteria_subsection->subsection_desc = 'Are the deliverables sent / actioned on time as per schedule as decided mutually with stakeholders?';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();

        // Adding subsection for section 'Behavioral'
        $_otace_criteria_section = OtaceCriteriaSection::where("section_name", "Behavioral")->first();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Flexibility';
        $_otace_criteria_subsection->subsection_desc = 'Do engagement resources demonstrate flexibility in their way of working? Can the Team do multi-tasking effectively?';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Autonomy';
        $_otace_criteria_subsection->subsection_desc = 'Can  engagement resources independently execute assignments with minimal intervention from you?';
        $_otace_criteria_subsection->rating = 'Y';
        $_otace_criteria_subsection->save();

        // Adding subsection for section 'Capability Assessment'
        $_otace_criteria_section = OtaceCriteriaSection::where("section_name", "Capability Assessment: Please give qualitative feedback on each capability in team. Please add on anything you might want to, to the criteria specified.")->first();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Engagement Leadership';
        $_otace_criteria_subsection->subsection_desc = 'Does engagement leader manage projects efficiently and effectively? Does engagement leader leverage resources optimally based on their strengths? Does engagement leader present/evangelize new capabilities with you? Does engagement leader proactively plan and execute programs? Does engagement leader have strong relationships both onshore and offshore? Does engagement leader effectively report engagement updates?';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Campaign & CRM';
        $_otace_criteria_subsection->subsection_desc = 'Does  resource(s) demonstrate understanding of THOR and Go-to-market plan to deliver global programs to meet business goals? Does resource(s) understand campaign planning and validation mapped to CRM? Does resource (s) lead end to end campaign management in THOR, organize deliveries and reporting and dashboards?';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Communications';
        $_otace_criteria_subsection->subsection_desc = 'Can resource(s) develop content that adheres to client\'s brief and Group\'s copy style? Does resource(s) understand Capgemini\'s business goals and priorities? Does resource(s) deliver it right, on time, the first time?';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Design';
        $_otace_criteria_subsection->subsection_desc = 'Can resource(s) develop collaterals and design concepts that adhere to client\'s brief and Group\'s visual identity guidelines? Does resource(s) understand Capgemini\'s business goals and priorities? Does resource(s) procatively suggest/explore new formats for delivery? Does resource(s) deliver it right, on time, the first time?';
        $_otace_criteria_subsection->save();

        $_otace_criteria_subsection = new OtaceCriteriaSubsection();
        $_otace_criteria_subsection->section()->associate($_otace_criteria_section);
        $_otace_criteria_subsection->subsection_name = 'Web';
        $_otace_criteria_subsection->subsection_desc = 'Can resource(s) offer web services that adhere to client\'s brief and Group\'s web guidelines? Does resource(s) understand Capgemini\'s business goals and priorities? Does resource(s) procatively suggest/explore new web technologies/platforms? Does resource(s) deliver it right, on time, the first time?';
        $_otace_criteria_subsection->save();
    }
}
