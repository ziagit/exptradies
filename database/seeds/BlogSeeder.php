<?php

use App\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::truncate();
        $balance = [
            [
                "title" => "What are the main types of jobs in Australia", 
                "body"=> "With a variety of industries and job types, Australia has a diverse economy. In Australia, some of the most common job categories are:
                Professional positions: Positions in the legal, medical, financial, accounting, engineering, and technological domains fall under this category. Usually, significant education and specialised training are required for these positions.
                Careers in the skilled trades: This area includes occupations for carpenters, plumbers, electricians, plumbers, mechanics, and construction workers. Typically, these positions necessitate both formal schooling and on-the-job training.
                Jobs in retail sales, customer service, hospitality, and tourism fall under this category of work. Although they occasionally require specialised training, these jobs typically do not call for advanced education.
                Administrative and support positions: This group of positions includes receptionists, administrative assistants, and customer service agents. These jobs typically do not require advanced education, but may involve specialized training.
                Jobs in farming, ranching, fishing, and forestry fall under the area of agriculture, forestry, and fishery. These positions frequently entail strenuous physical labour and may demand for specific training.
                Jobs in the health care and social assistance sectors: These positions include those of a registered nurse, physician, carer, and social worker. Usually, significant education and specialised training are required for these positions.
                Jobs in manufacturing and production: This group of jobs includes factory employees, machinists, and assembly line workers. Typically, these positions necessitate both formal schooling and on-the-job training.
                
                These are some of the prevalent job categories in Australia, although since the labour market is dynamic, new job categories are always being created.", //%
                "image"=>null, 
                "tag"=>"first"
            ],
            [
                "title" => "What types of employment do refugees typically hold in Australia?", 
                "body"=> "Finding employment for refugees in Australia can be difficult due to a number of factors, such as language barriers, a lack of credentials, and a lack of relevant work experience. Nonetheless, a few of the most typical occupations for refugees in Australia are as follows:
                    Cleaning and maintenance positions fall under this category and can be found in a range of locations, including workplaces, schools, and hospitals.
                    Careers in the hospitality and food service industry include positions such as dishwashing, kitchen helper, and food preparation in cafes, restaurants, and hotels.
                    Factory and warehouse employment: Positions in this area include forklift operating, packing and shipping, and assembly line work.
                    Roles at stores and supermarkets as well as customer service positions in call centres and other businesses fall under the area of retail and customer service jobs.
                    Care work: Positions in this area include those in home care, disability assistance services, and assisted living facilities for the elderly.
                    These are some of the most typical jobs held by refugees in Australia, however since the labour market is always changing, they may also be able to obtain employment in other sectors like construction, agriculture, and transportation. Once they have had the chance to develop their language skills, get their qualifications recognised, and gain job experience, many refugees also find employment in their profession.", //%
                "image"=>null, 
                "tag"=>"latest"
            ],
            [
                "title" => "What is the most common job in Australia?", 
                "body"=> "Headline estimates of employment, unemployment, underemployment, participation and hours worked from the monthly Labour Force Survey", //%
                "image"=>null, 
                "tag"=>"top"
            ],
            [
                "title" => "Full Job Description", 
                "body"=> "It takes the connection of team members in many different roles to run more than 800 supermarkets across Australia. Whether you’re in-store or delivering to a customers’ door, life in-front or behind the shelves is fast, and it’s fun. Joining Coles Supermarkets means you’ll belong in a team of diverse personalities, cultures, backgrounds and beliefs, just like the local communities we serve. Each day brings a variety of valuable first-hand experiences and with the formal training we give you, you’ll gain skills that set you up for an ongoing career at Coles Group and beyond.", //%
                "image"=>null, 
                "tag"=>"latest"
            ],
            [
                "title" => "Safer together", 
                "body"=> "We’re committed to providing a safe environment for our team members and our customers. As part of that commitment, you will need to be vaccinated against COVID-19 before joining the team at Coles, unless you’re medically exempt. You’ll also need to disclose your COVID-19 vaccination status as part of your application (and possibly provide further evidence of your vaccination status). Thanks for applying, and for your understanding.", //%
                "image"=>null, 
                "tag"=>"top"
            ],
        ];
        Blog::insert($balance);
    }
}
