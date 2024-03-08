<?php

use App\EmployerFaq;
use Illuminate\Database\Seeder;

class EmployerFaqSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    EmployerFaq::truncate();

    $cities =  [
      [
        'title' => 'How much does exptradies cost?',
        'body' => '
                <p>
                Exptradies is free to quote and use.
                </p>
                '
      ],
      [
        'title' => 'What are quote invitations and how do they work?',
        'body' => '
                <p>
                Quote invitations are all about your job inquiries, that a profession needs to accomplish, including the types of job, meterage and etc. the provided information will be passed to professionals, and shortly they will contact you. 
                </p>
                '
      ],
      [
        'title' => 'How do I register my business?',
        'body' => '
                <p>
                There is no need to register your business, whenever your job is posted on exptradies an account will be created automatically.
                 </p>
                '
      ],
      [
        'title' => 'Why do I need to verify my email?',
        'body' => '
                <p>
                It is necessary to verify your email to avoid misleading and wrong emails, as well as future login and contacts.
                 </p>
                '
      ],
    ];

    EmployerFaq::insert($cities);
  }
}
