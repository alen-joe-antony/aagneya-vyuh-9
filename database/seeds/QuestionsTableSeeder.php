<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'question_no'       =>      1,
            'question_img_url'  =>      '/images/questions/2iYL2k9RHKHFR14.jpg',
            'answer'            =>      'Stadia',
        ]);

        Question::create([
            'question_no'       =>      2,
            'question_img_url'  =>      '/images/questions/fW24WdkxUvui0E6.jpg',
            'answer'            =>      'Guinevere',
        ]);

        Question::create([
            'question_no'       =>      3,
            'question_img_url'  =>      '/images/questions/KkfMk7MMPYlC176.jpg',
            'answer'            =>      'Adamantium',
        ]);
    }
}
