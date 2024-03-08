<?php

use App\EmployeeFaq;
use Illuminate\Database\Seeder;

class EmployeeFaqSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    EmployeeFaq::truncate();
    $data =  [
      [
        'title' => 'What is exptradies?',
        'body' => '
                <p>
                Exptradies is Australia’s largest online tradies marketplace connecting homeowners (job owners) and businesses with trusted job seekers (tradies).
                </p>
                '
      ],
      [
        'title' => 'How does the exptradies platform work?',
        'body' => '
                <p>
                Exptradies is Australia’s largest online tradie marketplace. We connect homeowners and businesses with trusted tradies. Customers tell us what they need help with, and we display this as a job lead to relevant tradies in the local area.
                </p>
              <p>
              A job lead shows a description of the job, the location, and the date it needs to be done. If you like the sound of the job, you can accept the lead and start chatting with the customer directly to arrange a time to quote. All of this is done in our handy app, saving time and effort.
              </p>
              <p>
              Click <a href="/about">here</a> for more information on how exptradies works 
              </p>
                '
      ],
      [
        'title' => 'What services does exptradies provide?',
        'body' => '
                <p>
                Exptradies provide facilities for customers to find professionals from own surrounding with ease, and also we provide facilities for tradies to get the dream jobs that are looking for with ease.
                </p>
             
                '
      ],
      [
        'title' => 'What types of jobs can be posted on exptradies?',
        'body' => '
                <p>
                Exptradies welcomes all sorts of employment opportunities to be advertised.
                </p>
                '
      ],
      [
        'title' => 'How do customers and tradies communicate on the platform?',
        'body' => '
                <p>
                the selected tradies can communicate with customers, and share any sort of information through handy app and web, and also they could communicate via email or phone.
              </p>
                '
      ],
      [
        'title' => 'What are the advantages of using exptradies for customers?',
        'body' => '
                <p>
                Some of Advantages of using exptradies for customers are as follows:
               </p>
               <ul>
               <li>Access to local employment market from anywhere at anytime.</li>
               <li>Choose and hire the right and potential tradie without any cost.</li>
               <li>Connect with list of local potential tradies.</li>
               <li>find high reputed expert in your local area.</li>
               <li>Find the best solution for your inquiries.</li>
               <li>View and check each tradie’s background and experiences.</li>

               </ul>
                '
      ],
      [
        'title' => 'What are the benefits of using exptradies compared to other similar platforms?',
        'body' => '
                <p>
                It has many advantage such as simplicity and easy to use, adding multi- address, multi-professions, no need to create account to post a job even tradie can post job, unlock leads.
                </p>
                '
      ],
      [
        'title' => 'How do I contact a customer?',
        'body' => '
                <p>
                Customers appreciate you taking the time to connect with them, which shows that you\'re enthusiastic and willing to go the extra mile. To increase the price of wine, you need to do a few tricks, such as:
                </p>
                <p>Call: <p/>
                <p>Calling the customer first is the best way.</p>
                <p>Use Message Center:</p>
                <p>
                If you can\'t chat on the phone, use our app to send fast, professional and personalized messages. Receive notifications in the client app and also converted to emails so you can cover all your locations. 
                </p>
                '
      ],
      [
        'title' => 'What if I can’t contact a customer?',
        'body' => '
                <p>
                There might be instances when customers cannot attend calls due to their busy work schedules or any other reasons. It is well-known that calling customers immediately after accepting the lead increases your chances of getting in touch with them.
                </p>
                <p>
                In case immediate communication with the customer is not possible, downloading and sending a personalized message is essential. It\'s important to recognize that some prospective clients may not be prepared for work to commence immediately. Thus, ensuring a follow-up is established will increase the chances of converting these opportunities in the future.
                </p>
                '
      ],
      [
        'title' => 'How do I register my business?',
        'body' => '
                <p>
                If you are posting a job, there is no need to register, when your job is posted your account is created automatically, in case of registering as tradie to get notification click on <a href="/become-employee" target="blank">register a business</a> add your personal information and locations where you like to work.
                </p>
                '
      ],
      [
        'title' => 'What can I do if their phone number is incorrect?',
        'body' => '
                <p>
                Just use the message centre feature on your app to send a message to the customer.
                </p>
                <p>
                If the user has the consumer edition of the app, the message will be sent through it since the message centre is not linked to their phone number. Additionally, to ensure every possibility is covered, your message will also be transformed into an email.
                </p>
                '
      ],
      [
        'title' => 'How many jobs can I accept?',
        'body' => '
                <p>
                There is no limitation of accepting numbers of jobs, you can accept as you wish.
                </p>
                '
      ],
      [
        'title' => 'What are the benefits of using exptradies for tradies?',
        'body' => '
                <p>
                Using exptradies has the following benefits for tradies to use:
                </p>
                <ul>
                <li>Easily could find your ideal jobs and earn.</li>
                <li>Easily get the ideal job anytime and anywhere.</li>
                <li>Access to potential customers.</li>
                <li>Find jobs in multi-location and get hired.</li>
                <li>Guarantee your business success.</li>
                <li>Secure your employment by accessing to local market.</li>

                </ul>
                '
      ],
      [
        'title' => 'Are there any fees associated with using exptradies?',
        'body' => '
                <p>
                No there is no specific fee associated with using exptradies, only if you accept a job we would deduct penny amount from your account or your balance upon your approval and confirmation. 
                </p>
                '
      ],
      [
        'title' => 'How do customers and tradies communicate on the platform?',
        'body' => '
                <p>
                They can communicate through web site or app message center or by phone and email that provided by customer on web.
                </p>
                '
      ],
      [
        'title' => 'Are there any requirements to become a tradie on the platform?',
        'body' => '
                <p>
                You must have skills and professions to become tradies and also you need to have work license or other types of certificates that proof your skills and proficiency. 
                </p>
                '
      ],
      [
        'title' => 'What safety measures are in place to protect customers and tradies on the platform?',
        'body' => '
                <p>
                Exptradies highly emphasize on customers and business protection and to know more about protection states refer to privacy and terms and condition.
                </p>
                '
      ],
      [
        'title' => 'What is the purpose of exptradies?',
        'body' => '
                <p>
                The ultimate goal of exptradies is connecting customers with right businesses in order to guarantee the success of both side.
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
      [
        'title' => 'Is there any customer support available for users on the exptradies platform?',
        'body' => '
                <p>
                Exptradies is open 24/7,
                </p>
                <p>
                You can send us a message from exptradies message centre for a business app or email us at any time.
                </p>
                '
      ],

      [
        'title' => 'How do I contact a customer?',
        'body' => '
                <p>
                Customers appreciate you taking a moment to reach out, and it shows you’re enthusiastic and willing to go the extra mile. It’s little touches like this that can add to your wine rate:
                </p>
                <p>
                Call: calling the customer first up is the way to go.
                </p>
                <p>
                Use the message center: if you’re not able to chat with them by phone, follow up with a quick, professional, and personalized message via the app. They’ll get a notification on the customer app and it also converts to an email so it covers all your bases.
                </p>
                '
      ],
      [
        'title' => 'What if I can’t contact a customer?',
        'body' => '
                <p>
                Yes, there is a group of qualified people gathered and eagerly looking for yours questions and inquiries.
                </p>
                '
      ],
      [
        'title' => 'What services does exptradies provide?',
        'body' => '
                <p>
                Exptradies provide facilities for customers to find professionals from own surrounding with ease, and also we provide facilities for tradies to get the dream jobs that are looking for with ease.
             
                </p>
                '
      ],
      [
        'title' => 'How does the job-posting process work on exptradies?',
        'body' => '
                <p>
                Anyone who is looking for expert or work to be accomplished, could post a job without making an account, then the notifications go to those experts whom match their skills and locations as leads.
                </p>
                '
      ],
      [
        'title' => 'Is there a way to ensure customer satisfaction with the services provided by tradies?',
        'body' => '
                <p>
                Yes, the customer could examine and study the past working port folios on tradie profile and also can look the reviews and comments of each tradie.
                </p>
                '
      ],
      [
        'title' => 'How do customers rate their experience with tradies they hire through exptradies?',
        'body' => '
                <p>
                After work completion by employed tradie, the customer can go to tradie profile, rate and give reviews as he/she deserve.
                </p>
                '
      ],
      [
        'title' => 'What safety measures are in place to protect customers and tradies on the platform?',
        'body' => '
                <p>
                Exptradies highly emphasize on customers and business protection and to know more about protection states refer to privacy and terms and condition.
                </p>
                '
      ],
      [
        'title' => 'What are quote invitation and how it works?',
        'body' => '
                <p>
                Quote invitations are all about your job inquiries, that a profession needs to accomplish, including the types of job, meterage and etc. the provided information will be passed to professionals, and shortly they will contact you.
                </p>
                '
      ],
      [
        'title' => 'Does exptradies provide warranty or guarantee for the job done by tradie?',
        'body' => '
                <p>
                No exptradies never provide guarantee or warranty for the job done by tradie, we just link you a best expert and a better match for your work to be done.
                </p>
                '
      ],
    ];
    EmployeeFaq::insert($data);
  }
}
