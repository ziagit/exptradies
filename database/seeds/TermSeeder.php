<?php

use App\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Term::truncate();

    $data =  [
      'title' => 'Terms of Use',
      'body' => '
                <h1>Terms and conditions</h1>
                <p>Update: January 2022</p>
                <p>
                    <b>These Terms of use constitute a legally binding</b> agreement made between you, whether personally or on behalf
                    of an entity (“you”) and Expertly Tradies PTY LTD <b>(company, we, us or ours)</b>, as to your access to and use of
                    the
                    <a href="http://exptradies.com">exptradies.com</a> Web Site as well as any other media form, media channel, mobile
                    website or mobile application
                    related, linked, or otherwise connected thereto (collectively, the “site”). We are registered in Australia and have
                    our registered office in Sydney, Australia. You agree that by accessing the site, you have read, understood, and
                    agreed to be bound by all of these Terms of Use. IF YOU DO NOT AGREE WITH ALL OF THESE TERMS OF USE, THEN YOU ARE
                    EXPRESSLY PROHIBITED FROM USING THE SITE AND YOU MUST DISCONTINUE TO USE IMMEDIATELY.
                </p>
                <p>
                    Supplemental terms and conditions or documents that may be posted on the site from time to time are expressly
                    incorporated herein by reference. We reserve the right, in our sole discretion, to make changes or modifications to
                    these terms of use at any time and, for any reason, we will alert you about any changes by updating the “last
                    updated” date of these terms of use, and you waive any right to receive specific notice of each such change. Please
                    ensure that you check the applicable terms every time you use our site so that you understand which terms apply. You
                    will be subject to, and will be deemed to have been made aware of and to have accepted, the changes in any revised
                    Terms of Use for your use of the site after the date of such revised Terms of Use are posted.
                </p>
                <p>
                    The information provided on the site is not intended for distribution to or use by any person or entity in any
                    jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject
                    us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to
                    access the site from other locations do so on their own initiative and are solely responsible for compliance with
                    local laws. If and to the extent, local laws are applicable.
                </p>
                <h2>General</h2>
                <p>
                    It is a condition of these terms and conditions that all information or content you post and/or submit to be posted
                    or used on the <a href="http://exptradies.com">exptradies.com</a> Web Site, including all advertisements, photos and
                    creative designs, are either your
                    own works or works which you are using with the permission of the owner. Subject to any other clauses of these and
                    conditions, by submitting information or content (including advertisements, photos and designs) to any part of the
                    <a href="http://exptradies.com">exptradies.com</a> Web Site you automatically grant to us, or warrant that the owner
                    of such information has expressly
                    granted to us, a royalty-free, perpetual, irrevocable, worldwide non-exclusive license to use, reproduce, create
                    derivative works from, modify, publish, edit, translate, distribute, disseminate, communicate, perform, and display
                    your name and the information alone or as part of other works in any form, media, or technology whether now known or
                    hereafter developed.
                </p>
                <p>
                    You warranty that any and all information you post to the <a href="http://exptradies.com">exptradies.com</a> web
                    site
                </p>
                <ul>
                    <li>i. Complies with all relevant laws</li>
                    <li>ii. It Does not infringe the intellectual property rights (including but not limited to copyright and trade
                        marks) of any person.</li>
                    <li>iii. It Is not misleading or deceptive nor likely to mislead or deceive and</li>
                    <li>iv. It Does not violate any privacy laws or regulations or confidentiality restrictions. </li>
                </ul>
                <p>
                    You warranty, that any and all information submitted by you and posted on the <a
                        href="http://exptradies.com">exptradies.com</a> web site, including in
                    any directories, is true, complete and correct.
                </p>
                <h2>Ratings</h2>
                <p>
                    We may, from time to time, allow users who engage with a tradie through the web site to rate their experience with
                    that tradie. While we verify that feedback comes from users who engaged with the tradie through the web site, the
                    content of the feedback is the user’s opinion. The ratings are a collation of used feedback and do not constitute an
                    endorsement or recommendation by us in connection with any trade. For more information on how our rating systems
                    work visit exptradies.com. Ratings are not a substitute for making your own inquiries as to the suitability of any
                    tradie that you are considering hiring.
                </p>
                <p>
                    You acknowledge that in submitting any rating feedback you will act honestly and fairly and that you will not do
                    anything which might unfairly damage the reputation of a tradie or undermine the operation of the ratings system.
                </p>
                
                
                <h2>Copyright in reviews and comments</h2>
                <p>
                    By accepting these terms and conditions when registering your account, you hereby assign to us all present and
                    future copyright in all of the original content submitted or posted by you to the <a
                        href="http://exptradies.com">exptradies.com</a> web site including
                    without limitation, comments, forum posts, public messages, reviews, ratings and the compilation of any inspiration
                    board (but not including the contents of any advertisements, advertiser’s profile, or any quote submission).
                </p>
                <h2>Review of submissions</h2>
                <p>
                    Files that you upload, public messages that you send and your activity in dialogue, discussion, and forums on the
                    exptradies.com Web Site are subject to review, modification and deletion without notice by the discussion or forum
                    manager. Files that you upload to a bulletin board are subject to posted limitations on usage, reproduction and/or
                    dissemination and you are responsible for adhering to such limitations. You should be aware that personally
                    identifiable information you choose to disclose on the exptradies.com Web Site may be used by third parties and such
                    use is beyond our control.
                </p>
                <p>
                    You must post any information which (1) is libelous, defamatory, obscene, offensive, sexually explicit, fraudulent,
                    false, unlawful, contrary to the ownership or intellectual property rights of any other person, or (2) contains any
                    virus, worm, Trojan or other code which is contaminating or destructive to the files, data or programs of the
                    exptradies.com Web Site or any of our users.
                </p>
                <h2>How do we use your information?</h2>
                <p>
                    We use your personal information for these purposes in reliance on our
                    legitimate business interests (“Business Purposes”), to enter into or
                    perform a contract with you (“Contractual”), with your consent
                    (“Consent”), and/or for compliance with our legal obligations (“Legal
                    Reasons”). We indicate the specific processing grounds we rely on next
                    to each purpose listed below.
                </p>
                <p>We may deny you access to all or part of the exptradies.com Web Site and /or suspend or cancel your service account
                    without notice if we, in our reasonable discretion, determine that you have engaged in conduct that violates any law
                    or any provision of these Terms and Conditions or is otherwise inappropriate. We will not be liable for any loss of
                    profit or business opportunity that may result from the suspension or cancellation of your service account.
                </p>
                <h2>Copyright and trade marks</h2>
                <p>
                    Unless otherwise indicated, the site is our proprietary property and all source code, databases, functionality,
                    software, website designs, audio, video. Text, photographs, and graphics on the site (collectively, the “content”)
                    and the trademarks, service marks, and logos contained therein (the “Marks”) are owned or controlled by us or
                    licensed to us, and are protected by copyright and trademark laws and various other intellectual property rights and
                    unfair competition laws of Australia, international copyright laws, and international conventions. The content and
                    the Mark are provided on the site “AS IS” for your information and personal use only. Except as expressly provided
                    in these Terms of Use, no part of the Site and no content or Marks may be copied, reproduced, aggregated,
                    republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or
                    otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.
                </p>
                <p>
                    Provided that you are eligible to use the Site, you are granted a limited license to access and use the site and to
                    download or print a copy of any portion of the content to which you have properly gained access solely for your
                    personal, non- commercial use. We reserve all rights not expressly granted to you in and to the site. The content
                    and the Mark.
                </p>
                
                <h2>General Disclaimer</h2>
                <p>
                    Under the Australian consumer law, you are entitled to certain guarantees in relation to our supply of the web site
                    which cannot be excluded, restricted or modified (consumer Guarantees), to the extent permitted by law, our
                    liability for failure to comply with a consumer Guarantee is limited (at our option) to: (a) in the case of goods
                    supplied to you, to the replacement of the goods or the supply of equivalent goods or the payment of the cost to you
                    of replacements or supply, or the repair of the goods and (b) in the case of services supplier to you, the supply of
                    services again, or the payment of the cost having the services supplied again.
                </p>
                <p>
                    Subject to the consumer Guarantees: (a) it is provided on an as is, with all faults and available basis and to the
                    extent of permitted by law without any warranties of any kind, either expressed or implied, warranties of title or
                    non-infringement, or warranties arising from course of dealing or custom of trade, (b) we make no representation or
                    warranty that any content of the web site is accurate, complete, appropriate, reliable or timely, and (c) we also
                    make no representation or warranty that your access to and use of the web site will be uninterrupted, secure,
                    error-free, free of viruses or unauthorized code or other harmful components. We reserve the right to discontinue
                    operating the web site at any time without notice.
                </p>
                
                <h2>Do we use cookies and other tracking technologies?</h2>
                <p>
                    We may use cookies and similar tracking technologies (like web beacons
                    and pixels) to access or store information. Specific information about
                    how we use such technologies and how you can refuse certain cookies is
                    set out in our <a href="">Cookies Policy</a>.
                </p>
                <h2>Use of the <a href="http://exptradies.com">exptradies.com</a> Web Site</h2>
                <p>
                    Expect as required by the Consumer Guarantees, your use of the Web Site is at your own risk. You are responsible for
                    taking all precautions you believe necessary or advisable to protect you against any claim, damage, loss or hazard
                    that may arise by virtue of your use of the Web Site. Neither we nor anyone else involved in creating, producing or
                    delivering the Web Site, our e-newsletters, or the materials contained therein assumes any liability or
                    responsibility for the accuracy, completeness or usefulness of any information provided therein, nor, to the extent
                    permitted by law, shall any of them be liable for any direct, indirect, incidental, special, consequential or
                    punitive damages arising out of your of, or inability to use the Web Site.
                </p>
                <p>
                    You must not use any means of automatically searching or mining data or in any way interfere or attempt to interfere
                    with the proper operation of the Web Site.
                </p>
                <p>
                    You agree not to take any action that imposes an unreasonable burden on our infrastructure, our systems or data or
                    those of any third party.
                </p>
                <h2>Disclaimer</h2>
                <p>
                    We hardly strive to provide valuable and accurate information. We warrant that the information contained therein is
                    in every respect accurate or complete and to the extent permitted by law, they assume no responsibility for any
                    errors or omissions or for the results obtained from the use of such material. The information is not intended in
                    any way to be a substitute for professional advice. Neither the content nor any other service is offered through the
                    Web Site.
                </p>
                <p>
                    We do not examine, determine or warrant the certification and/or licensing, competence, solvency or information of
                    any professional or facilities listed in our directories to locate a professional or facility is wholly voluntary
                    and, to the extent permitted by law, in no event will we or any of our agents be liable for damages to any user of
                    our directories for the selection of a professional or facility or for the services provided by any professional or
                    facility listed therein, or for any other loss or damage which may occur as a result thereof. We recommend that you
                    check the certification and/or licensing of any professional or other service provider with the applicable licensing
                    Board or authority.
                </p>
                <p>
                    You should satisfy yourself with the competence, solvency, insurance and licensing of anybody you decide to retain
                    as a result of a connection made through our services, including the post job / Get Quotes service. Under no
                    circumstances shall we be liable for any damages whatsoever as a result of losses caused to you by a person or
                    entity that retains as a consequence of using our directory or services.
                </p>
                <p>
                    The Web Site may contain links to web sites operated by third parties. The linked sites are not under our control
                    and we are not responsible for the contents of any linked site or any link contained in a linked site or any changes
                    or updates to such sites.
                </p>

                '
    ];

    Term::insert($data);
  }
}
