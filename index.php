<?php
$pathToAuthors = __DIR__ . '/authors.json';
$authorsTxt = file_get_contents($pathToAuthors);
$authors = json_decode($authorsTxt, true);

$pathToBooks = __DIR__ . '/books.json';
$booksTxt = file_get_contents($pathToBooks);
$books = json_decode($booksTxt, true);

$pathToCountries = __DIR__ . '/countries.json';
$countriesTxt = file_get_contents($pathToCountries);
$countries = json_decode($countriesTxt, true);


if ('/books'===$_SERVER['PATH_INFO']) {
    $result = [];
    $searchedAuthors = [];
    $authorIdToAuthor = [];
    foreach ($authors as $author) {
        $authorIdToAuthor[$author['id']] = $author;
        if (array_key_exists('author', $_GET) && $author['surname'] === $_GET['author']) {
            $searchedAuthors[] = $author;
        }
    }
    foreach ($books as $book) {
        $validBook = !array_key_exists('author', $_GET);
        foreach ($searchedAuthors as $searchedAuthor){
            if ($searchedAuthor['id'] === $book['author_id']){
     //          $result[] = $book;
                $validBook = true;
                break;
            }
        }
        if ($validBook === true && array_key_exists('title', $_GET) && is_string($_GET['title']) ) {
    //        $result[] = $book;
            $validBook = $_GET['title'] === $book['title'];
        }
        if ($validBook === true){
            $book['author'] = $authorIdToAuthor[$book['author_id']];
            unset($book['author_id']);
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
//   foreach ($countries as $country) {
//       if () {
//       }
//   }
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
