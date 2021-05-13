<?php
$pathToAuthors = __DIR__ . '/authors.json';
$authorsTxt = file_get_contents($pathToAuthors);
$authors = json_decode($authorsTxt, true);

$pathToBooks = __DIR__ . '/books.json';
$booksTxt = file_get_contents($pathToBooks);
$books = json_decode($booksTxt, true);

if ('/books'===$_SERVER['PATH_INFO']) {
    $result = [];
    foreach ($books as $book) {
        if (array_key_exists('title', $_GET) && is_string($_GET['title']) && $_GET['title'] === $book['title']) {
            $result[] = $book;
        }

    }
    $httpCode = 200;
//    $result = [
//        [
//            'id' => 1,
//            'title' => 'Бойцовский клуб',
//            'year' => '1996',
//            'author' => [
//                'id'=> 1,
//                'name' => 'Чак',
//                'surname' => 'Паланик',
//                'birthday' => '21.02.1962',
//                'country' => 'us',
//            ],
//        ]
//    ];
} elseif ('/authors'===$_SERVER['PATH_INFO']) {
   $result = [];
    foreach ($authors as $author) {
        if (array_key_exists('country', $_GET) && is_string($_GET['country']) && $_GET['country'] === $author['country']) {
            $result[] = $author;
        }

    }
    $httpCode = 200;
//    $result = [
//       [
//           'id'=> 1,
//           'name' => 'Чак',
//           'surname' => 'Паланик',
//           'birthday' => '21.02.1962',
//           'country' => 'us',
//       ]
//    ];

} else {
    $httpCode = 404;
    $result = [
        'status' => 'fail',
        'message' => 'unsupported request'
    ];
}

http_response_code($httpCode);
echo json_encode($result);
