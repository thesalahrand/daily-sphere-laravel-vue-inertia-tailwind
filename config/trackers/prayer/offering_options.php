<?php

return [
  [
    'slug' => 'fard-with-takbeer-e-tahrima',
    'prayer_type_idx' => 0,
    'option_title' => 'With takbeer e tahrima',
    'applicable_genders' => ['Male'],
    'points' => 1200,
    'short_desc' => 'Prayed in jama\'ah with takbeer e tahrima'
  ],
  [
    'slug' => 'fard-in-jama\'ah',
    'prayer_type_idx' => 0,
    'option_title' => 'In jama\'ah',
    'applicable_genders' => ['Male'],
    'points' => 1000,
    'short_desc' => 'Prayed in jama\'ah but missed takbeer e tahrima'
  ],
  [
    'slug' => 'fard-prayed-alone',
    'prayer_type_idx' => 0,
    'option_title' => 'Offered alone',
    'applicable_genders' => ['Male', 'Female'],
    'points' => 800,
    'short_desc' => 'Prayed in time but missed jama\'ah completely',
    'special' => [
      'applicable_genders' => 'Female',
      'points' => 1000
    ]
  ],
  [
    'slug' => 'fard-qasr-jama',
    'prayer_type_idx' => 0,
    'option_title' => 'Qasr/jama',
    'applicable_genders' => ['Male', 'Female'],
    'points' => 1200,
    'short_desc' => 'Prayed qasr/jama (or Fajr) while travelling',
    'special' => [
      'applicable_genders' => 'Female',
      'points' => 1000
    ]
  ],
  [
    'slug' => 'fard-qada\'',
    'prayer_type_idx' => 0,
    'option_title' => 'Qada\'',
    'applicable_genders' => ['Male', 'Female'],
    'points' => 600,
    'short_desc' => 'Prayed but not in time',
    'special' => [
      'applicable_genders' => 'Female',
      'points' => 500
    ]
  ],
  [
    'slug' => 'fard-excused',
    'prayer_type_idx' => 0,
    'option_title' => 'Excused',
    'applicable_genders' => ['Female'],
    'points' => 1000,
    'short_desc' => 'Excused not to pray for legitimate reasons',
  ],
  [
    'slug' => 'sunnah-offered',
    'prayer_type_idx' => 1,
    'option_title' => 'Offered',
    'applicable_genders' => ['Male', 'Female'],
    'points' => 10,
    'short_desc' => 'Prayed in time',
  ],
  [
    'slug' => 'sunnah-qada\'',
    'prayer_type_idx' => 1,
    'option_title' => 'Qada\'',
    'applicable_genders' => ['Male', 'Female'],
    'points' => 5,
    'short_desc' => 'Prayed but not in time',
  ],
  [
    'slug' => 'sunnah-excused',
    'prayer_type_idx' => 1,
    'option_title' => 'Excused',
    'applicable_genders' => ['Male', 'Female'],
    'points' => 10,
    'short_desc' => 'Excused not to pray for legitimate reasons',
  ],
];
