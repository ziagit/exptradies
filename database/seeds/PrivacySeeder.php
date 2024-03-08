<?php

use App\Privacy;
use Illuminate\Database\Seeder;

class PrivacySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Privacy::truncate();

    $data =  [
      'title' => 'Privacy Notice',
      'body' => '
                <h1>Privacy Notice</h1>
<p>
    Expert Tradies collects personal information in order to activate, honor and verify vouchers and coupons, and may,
    for this purpose, disclose such personal information to third parties, including but not limited to agents,
    contractors, service providers, suppliers and, as required, to Australian regulatory authorities. Acceptance,
    activation or redemption of vouchers and coupons is conditional on you providing this personal information. And we
    will also use and handle your personal information securely and in accordance with the company’s privacy policies.
    Use the personal information for promotional, marketing, publicity, research and profiling purposes, including
    sending electronic messages or telephoning you. You should direct any request to opt out, access, update or correct
    your personal information to Expert Tradies and direct any complaints regarding treatment of your personal
    information in accordance with the privacy policy.
</p>
<h2>Registration</h2>
<p>
    You must register and obtain a service account in order to submit information to the website. To do so, and to find
    out about the benefits of registration, please go to “Register Now”.
</p>
<p>
    After you have registered, one of our sales representatives will contact you to confirm your registration details.
    Your service account will then be activated and you will be issued a password which will be sent to you by email.
</p>
<p>
    You must not disclose your password to any third party and you are responsible for keeping it confidential. We will
    never ask you to send your password or other sensitive information to an email or to enter it via any website. If
    you suspect any unauthorized use of your service account or access to your password, please change your password
    immediately and contact us. You are responsible for all unauthorized use of your services account by anyone who
    obtain access to your account directly or indirectly through you.
</p>
<h2>Prohibited Activities</h2>
<p>
    You may not access or use the site for any purpose other than for which we make the site available. The site may not
    be used in connection with any commercial endeavors except those that are specifically endorsed or approved by us.
</p>
<h5>As a user of the site, you agree not to:</h5>
<ul>
    <li>Systematically retrieve data or other content from the site to or compile, directly or indirectly, a collection,
        compilation, database, or directory without written permission from us.</li>
    <li> Trick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account
        information such as user passwords.</li>
    <li> Circumvent, disable, or otherwise interfere with security-related features of the Site, including features
        that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Site and/or
        the Content contained therein.</li>
    <li> Disparage, tarnish, or otherwise harm, in our opinion, us and/or the Site.</li>
    <li> Use any information obtained from the site in order to harass, abuse, or harm another person.</li>
    <li> Make improper use of our support services to submit false reports of abuse or misconduct.</li>
    <li> Use the Site in a manner inconsistent with any applicable laws or regulations.</li>
    <li> Engage in unauthorized framing of or linking to the Site.</li>
    <li> Upload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including
        excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any
        party’s uninterrupted and enjoyment of the Site or modifies, impairs, disrupts, alters, or interferes with the
        use, features, functions, operation, or maintenance of the Site.</li>
    <li> Engage in any automated use of the system, such as using scripts to send comments on messages, or using any
        data mining, robots, or similar data gathering and extraction tools.</li>
    <li> Delete the copyright or other proprietary rights notice from any Content.</li>
    <li> Attempt to impersonate another user or person or use the username of another user.</li>
    <li> Upload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active
        information collection or transmission mechanism, including without limitation, clear graphics interchange
        formats (“gifs”), 1x1 pixels, web bugs, cookies, or mechanisms).</li>
    <li> Interfere with, disrupt, or create an undue burden on the Site or the networks or services connected to the
        Site.</li>
    <li> Harass, annoy, intimidate, or threaten any of our employees or agents engaged in providing any portion of the
        Site to you.</li>
    <li> Attempt to bypass any measures of the Site designed to prevent or restrict access to the Site, or any portion
        of the Site.</li>
    <li> Copy or adapt the Site’s software, including but not limited to Flash, PHP, HTML, JavaScript, or other code.
    </li>
    <li> Excerpt as permitted by applicable law, decipher, decompile, disassemble, or reverse engineer any of the
        software comprising or in any way making up a part of the Site.</li>
    <li> Excerpt as may be the result of standard search engine or Internet browser usage, use, launch, develop, or
        distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or
        offline reader that accesses the Site, or using or launching any unauthorized script or other software.</li>
    <li> Use a buying agent or purchasing agent to make purchases on the Site. </li>
    <li> Make any unauthorized use of the Site, including collecting usernames and/or email addresses of users by
        electronic or other means for the purpose of sending unsolicited email, or creating users by accounts by
        automated means or under false pretenses.</li>
    <li> Use the Site as part of any effort to compete with us or otherwise use the Site and/or the Content for any
        revenue-generating endeavor or commercial enterprise.</li>
    <li> Use the Site to advertise or offer to sell goods and services.</li>

</ul>
<h2>MOBILE APPLICATION LICENSE</h2>
<h4>Use License</h4>
<p>
    If you access the Site via a mobile application, then we grant you a revocable, non-exclusive, non-transferable,
    limited right to install and use the mobile application on wireless electronic devices owned or controlled by you,
    and to access and use the mobile application on such devices strictly in accordance with the terms and conditions of
    this mobile application license contained in these Terms of Use. You shall not: (1) except as permitted by
    applicable law, decompile, reverse engineer, disassemble, attempt to derive the source code of, or decrypt the
    application; (2) make any modification, adaptation, improvement, enhancement, translation, or derivative work from
    the application; (3) violate any application laws, rules, or regulations in connection with your access or use of
    the application; (4) remove, alter, or obscure any proprietary notice (including any notice of copyright or
    trademark) posted by us or the licensors of the application; (5) use the application for any revenue generating
    endeavor, commercial enterprise, or other purpose for which it is not designed or intended; (6) make the application
    available over a network or other environment permitting access or use by multiple devices or users at the same
    time; (7) use the application for creating a product, service, or software that is, directly or indirectly,
    competitive with or in any way a substitute for the application; (8) use the application to send automated
    information or any of our interfaces or our other intellectual property in the design, development, manufacture,
    licensing, or distribution of any applications, accessories, or devices for use with the application.
</p>
<h2>Apple and Android Devices </h2>
<p>
    The following terms apply when you use a mobile application obtained from either the Apple Store of Google Play
    (each an “App Distributor”) to access the Site: (1) the license granted to you for our mobile application is limited
    to a non-transferable license to use the application on a device that utilizes the Apple iOS or Android operating
    systems, as applicable, and in accordance with the usage rules set forth in the applicable App Distributor’s terms
    of service; (2) we are responsible for providing any maintenance and support services with respect to the mobile
    application as specified in the terms and conditions of this mobile application license contained in these Terms of
    Use or as otherwise required under applicable law, and you acknowledge that each App Distributor has no obligation
    whatsoever to furnish any maintenance and support services with respect to the mobile application; (3) in the event
    of any failure of the mobile application to conform to any applicable warranty, you may notify the applicable App
    Distributor, and the App Distributor, in accordance with its terms and policies, may refund the purchase price, if
    any, paid for the mobile application, and to the maximum extent permitted by applicable law, the App Distributor
    will have no other warranty obligation whatsoever with respect to the mobile application; (4) you represent and
    warrant that (i) you are not located in a country that is subject to a U.S. government embargo, or that has been
    designated by the U.S. government as a “terrorist supporting” country and (ii) you are not listed on any U.S.
    government list of prohibited or restricted parties; (5) you must comply with applicable third-party terms of
    agreement when using the mobile application, e.g., if you have an application , then you must not be in violation of
    their wireless data service agreement when using the mobile application; and (6) you acknowledge and agree that the
    App Distributor are third-party beneficiaries of the terms and conditions in this mobile application license
    contained in these Terms of Use, and that each App Distributor will have the right (and will be deemed to have
    accepted the right) to enforce the terms and conditions in this mobile application license contained in these Terms
    of Use against you as a third-party beneficiary thereof.
</p>
<h2>Registration</h2>
<p>
    You must register and obtain a service account in order to submit information to the exptradies.com web site. To do
    so, and to find out about the benefits of registration, please go to “Register Now”.
</p>
<p>
    After you have registered, one of our sales representatives will contact and will then be activated you to confirm
    your registration details. Your service account will be sent to you by email.
</p>
<p>
    You must not disclose your password to any third party and you are responsible for keeping it confidential. We will
    never ask you to send your password or other sensitive information to us in an email or to enter it via any website
    other than one with an URL beginning with hipages.com.au. If you suspect any unauthorised use of your service
    account or access to your password, please change your password immediately and contact us. You are responsible for
    all unauthorised use of your services account by anyone who obtained access to your account directly or indirectly
    through you.
</p>
<h2>INDEMNIFICATION</h2>
<p>
    You agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our
    respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or
    demand, including reasonable attorneys’ fees and expenses, made by any third party due to or arising out of: (1)
    your contributions; (2) use of the Site; (3) breach of these Terms of Use; (5) your violation of the rights of a
    third party, including but not limited to intellectual property rights; or (6) any overt harmful act toward any
    other user of the Site with whom you connected via the Site. Notwithstanding the foregoing, we reserve the right, at
    your expense, to assume the exclusive defense and control of any matter for which you are required to indemnify us,
    and you agree to cooperate, at your expense, with our defense of such claims. We will use reasonable efforts to
    notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of
    it.
</p>
<h2>MISCELLANEOUS</h2>
<p>
    These Terms of Use and any policies or operating rules posted by us on the Site or in respect to the Site constitute
    the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision
    of these Terms of Use shall not operate as a waiver of such right or provision. These Terms of Use operate to the
    fullest extent permissible by law. We may assign any or all of our rights and obligations to others at any time. We
    shall not be responsible or liable for any loss, damage, delay, or failure to act caused by any cause beyond our
    reasonable control. If any provision or part of a provision of these Terms of Use is determined to be unlawful,
    void, or unenforceable, that provision or part of the provision is deemed severable from these Terms of Use and does
    not affect the validity and enforceability of any remaining provisions. There is no joint venture, partnership,
    employment or agency relationship created between you and us as a result of these Terms of Use or use of the Site.
    You agree that these Terms of Use will not be construed against us by virtue of having drafted them. You hereby
    waive any and all defenses you may have based on the electronic form of these Terms of Use and the lack of signing
    by the parties hereto to execute these Terms of Use.
</p>
<h2>Contact</h2>
<p>Company Name: Expertly Tradies PTY LTD (ACN-656873755)</p>
<p>Address: Sydney, Australia, 1244</p>
<p>Email Address:</p>
<p>Mobile No: </p>
                '
    ];

    Privacy::insert($data);
  }
}
