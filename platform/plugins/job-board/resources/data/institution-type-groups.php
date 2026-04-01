<?php

/**
 * Institution types for dropdowns: group_key => [ 'label' => display group title, 'options' => [ value => label ] ]
 * Values use kebab-case (registration, employer, job seeker settings).
 */
return [
    'school' => [
        'label' => 'SCHOOL',
        'options' => [
            'cbse-school' => 'CBSE School',
            'cicse-school' => 'CICSE School',
            'cambridge-school' => 'Cambridge School',
            'ib-school' => 'IB School',
            'igcse-school' => 'IGCSE School',
            'primary-school' => 'Primary School',
            'play-school' => 'Play School',
            'pre-school' => 'Pre School',
            'state-board-school' => 'State Board School',
        ],
    ],
    'edtech' => [
        'label' => 'EDTECH COMPANY',
        'options' => [
            'edtech-company' => 'EdTech Company',
        ],
    ],
    'online' => [
        'label' => 'ONLINE EDUCATION PLATFORM',
        'options' => [
            'online-education-platform' => 'Online Education Platform',
        ],
    ],
    'coaching' => [
        'label' => 'COACHING INSTITUTES',
        'options' => [
            'animation-institute' => 'Animation Institute',
            'civil-services-institute' => 'Civil Services Institute',
            'banking-institute' => 'Banking Institute',
            'design-institute' => 'Design Institute',
            'english-learning-institute' => 'English Learning Institute',
            'foreign-language-institute' => 'Foreign Language Institute',
            'it-training-institute' => 'IT Training Institute',
            'jee-neet-institute' => 'JEE and NEET Institute',
            'music-institute' => 'Music Institute',
            'nda-institute' => 'NDA Institute',
            'vocational-training-institute' => 'Vocational Training Institute',
            'private-institute' => 'Private Institute',
        ],
    ],
    'college' => [
        'label' => 'COLLEGE',
        'options' => [
            'agriculture-college' => 'Agriculture College',
            'engineering-college' => 'Engineering College',
            'medical-college' => 'Medical College',
            'nursing-college' => 'Nursing College',
            'pharmacy-college' => 'Pharmacy College',
            'science-college' => 'Science College',
            'management-college' => 'Management College',
            'degree-college' => 'Degree College',
        ],
    ],
    'nonprofit' => [
        'label' => 'NON-PROFIT ORGANIZATION',
        'options' => [
            'non-profit-organization' => 'Non-Profit Organization',
        ],
    ],
    'academies' => [
        'label' => 'ACADEMIES',
        'options' => [
            'sport-academy' => 'Sport Academy',
            'music-academy' => 'Music Academy',
            'distance-learning-academy' => 'Distance Learning Academy',
        ],
    ],
    'university' => [
        'label' => 'UNIVERSITY',
        'options' => [
            'university' => 'University',
        ],
    ],
];
