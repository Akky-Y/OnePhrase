<?php

$review = [
  'title' => '',
  'artist' => '',
  'onephrase' => '',
  'age' => '',
  'summary' => ''
];
$errors = [];

$title = 'OnePhrase登録';
$content = __DIR__ . "/views/new.php";
include __DIR__ . '/views/layout.php';
