<?php
if ('/books'===$_SERVER['PATH_INFO']) {
    echo 'books';
} elseif ('/authors'===$_SERVER['PATH_INFO']) {
    echo 'authors';
} else {
    echo 'неизвестный текст';
}
