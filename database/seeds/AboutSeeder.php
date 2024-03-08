<?php

use App\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    About::truncate();
    $data =  [
     [
      'title' => 'What exptradies is ',
      'body' => '
                <p>
                Exptradies is an online platform that directly connects customers to qualified 
                local businesses (tradie) in different service categories in order to let your 
                work be done with ease and professionally without wasting time, just by posting a 
                job on exptradies web and apps which is then sent to relevant local nearby tradies 
                as leads, the customers and workers can accept and communicate about job’s locations and status. 
              </p>
            '
     ],
     [
      'title' => 'Who we are',
      'body' => '
                <p>
                We are a group of hardworking people with over a decade of field experience in linking 
                quality Businesses to the right customers, we gathered as exptradies <b>PTYLTD</b> to elevate 
                stresses related to work and let your work be done professionally on schedule with ease 
                by local trusted tradies, and qualified businesses could get the desired jobs in his/her 
                local area within an hour.
              </p>
            '
     ]
    ];

    About::insert($data);
  }
}
