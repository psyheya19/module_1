<?php
if ('/books'===$_SERVER['PATH_INFO']) {
    $httpCode = 200;
    $result = [
        [
            'id' => 1,
            'title' => 'Бойцовский клуб',
            'year' => '1996',
            'author' => [
                'id'=> 1,
                'name' => 'Чак',
                'surname' => 'Паланик',
                'birthday' => '21.02.1962',
                'country' => 'us',
            ],
        ]
    ];
} elseif ('/authors'===$_SERVER['PATH_INFO']) {
    $httpCode = 200;
    $result = [
       [
           'id'=> 1,
           'name' => 'Чак',
           'surname' => 'Паланик',
           'birthday' => '21.02.1962',
           'country' => 'us',
       ]
    ];

} else {
    $httpCode = 404;
    $result = [
        'status' => 'fail',
        'message' => 'unsupported request'
    ];
   }

http_response_code($httpCode);
echo json_encode($result);
