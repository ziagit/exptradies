<?php

use App\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();
        $cities = [
            [
                'name' => "Sydney",
                'image' => null,
                'details' => "Sydney, capital of New South Wales and one of Australia's largest cities, is best known for its harbourfront Sydney Opera House, with a distinctive sail-like design. Massive Darling Harbour and the smaller Circular Quay port are hubs of waterside life, with the arched Harbour Bridge and esteemed Royal Botanic Garden nearby. Sydney Tower’s outdoor platform, the Skywalk, offers 360-degree views of the city and suburbs.",
            ],

            [
                'name' => "Melbourne",
                'image' => null,
                'details' => "Melbourne is the coastal capital of the southeastern Australian state of Victoria. At the city's centre is the modern Federation Square development, with plazas, bars, and restaurants by the Yarra River. In the Southbank area, the Melbourne Arts Precinct is the site of Arts Centre Melbourne – a performing arts complex – and the National Gallery of Victoria, with Australian and indigenous art.",
            ],
            [
                'name' => "Brisbane",
                'image' => null,
                'details' => "Brisbane, capital of Queensland, is a large city on the Brisbane River. Clustered in its South Bank cultural precinct are the Queensland Museum and Sciencentre, with noted interactive exhibitions. Another South Bank cultural institution is Queensland Gallery of Modern Art, among Australia's major contemporary art museums. Looming over the city is Mt. Coot-tha, site of Brisbane Botanic Gardens.",
            ],
            [
                'name' => "Adelaide",
                'image' => null,
                'details' => "Adelaide is South Australia’s cosmopolitan coastal capital. Its ring of parkland on the River Torrens is home to renowned museums such as the Art Gallery of South Australia, displaying expansive collections including noted Indigenous art, and the South Australian Museum, devoted to natural history. The city's Adelaide Festival is an annual international arts gathering with spin-offs including fringe and film events.",
            ],
            [
                'name' => "Perth",
                'image' => null,
                'details' => "Perth, capital of Western Australia, sits where the Swan River meets the southwest coast. Sandy beaches line its suburbs, and the huge, riverside Kings Park and Botanic Garden on Mount Eliza offer sweeping views of the city. The Perth Cultural Centre houses the state ballet and opera companies, and occupies its own central precinct, including a theatre, library and the Art Gallery of Western Australia.",
            ],
            [
                'name' => "Hobart",
                'image' => null,
                'details' => "Hobart, capital of Australia's island state of Tasmania, sits on the River Derwent. At its fashionable Salamanca Place, old sandstone warehouses host galleries and cafes. Nearby is Battery Point, a historic district with narrow lanes and colonial-era cottages. The city's backdrop is 1,270m-high Mount Wellington, with sweeping views, plus hiking and cycling trails.",
            ],
            [
                'name' => "Canberra",
                'image' => null,
                'details' => "Canberra is the capital city of Australia. Founded following the federation of the colonies of Australia as the seat of government for the new nation, it is Australia's largest inland city and the eighth-largest city overall.",
            ],
            [
                'name' => "Wollongong",
                'image' => null,
                'details' => "Wollongong is a coastal city in Australia, south of Sydney along the Grand Pacific Drive. Surfing beaches and rock pools line the coastline. Trails encircle the forests and rocky cliffs of Mt. Keira in the Illawarra mountain range, which frames the city. To the north, hang gliders launch from Bald Hill. South lie the Buddhist temple of Nan Tien and Lake Illawarra, a large lagoon with boating and fishing facilities.",
            ],
            [
                'name' => "Newcastle",
                'image' => null,
                'details' => "Newcastle is a harbour city in the Australian state of New South Wales. Its plentiful beaches are linked by the Bathers Way, a coastal walk stretching between Nobbys Beach and Merewether Beach. The walk provides access to Bogey Hole, a convict-built ocean bath from the colonial period. Also on the path is the 1880s Fort Scratchley, a historic site and a viewpoint for spotting migrating whales.",
            ],
            [
                'name' => "Gold Coast",
                'image' => null,
                'details' => "The Gold Coast is a metropolitan region south of Brisbane on Australia’s east coast. It's famed for its long sandy beaches, surfing spots and elaborate system of inland canals and waterways. It’s also home to theme parks such as Dreamworld, Sea World and Wet’n’Wild. Inland, hiking trails crisscross Lamington National Park’s mountain ridges and valleys, home to rare birds and rainforest.",
            ],
            [
                'name' => "Cairns",
                'image' => null,
                'details' => "Cairns, considered the gateway to Australia's Great Barrier Reef, is a city in tropical Far North Queensland. Its Tjapukai Aboriginal Cultural Park tells the stories of indigenous Aboriginal and Torres Strait Islander people with music and dance. Cairns Esplanade, lined with bars and restaurants, has a swimming lagoon. Northwest of the city, Daintree National Park spans mountainous rainforest, gorges and beaches.",
            ],
            [
                'name' => "Darwin",
                'image' => null,
                'details' => "Darwin is the capital of Australia's Northern Territory and a former frontier outpost. It's also a gateway to massive Kakadu National Park. Its popular waterfront area has several beaches and green areas like Bicentennial Park. Also near the water is the Museum and Art Gallery of the Northern Territory, displaying Southeast Asian and Pacific art, plus a pearling lugger and other seafaring vessels.",
            ],
            [
                'name' => "Geelong",
                'image' => null,
                'details' => "Geelong is a city southwest of Melbourne, Australia. Lining its bay, The Waterfront esplanade has a 19th-century carousel, plus a curved art deco boardwalk and sea bath at Eastern Beach. Scattered along The Waterfront are the Baywalk Bollards, colourful sculptures chronicling city history. The Geelong Botanic Gardens lie at the eastern end of the bay. The central National Wool Museum hosts changing exhibitions.",
            ]
        ];
        City::insert($cities);
    }
}
