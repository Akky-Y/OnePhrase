<?php

require_once __DIR__ . '/lib/mysqli.php';

$review = [
  'title' => '',
  'artist' => '',
  'onephrase' => '',
  'age' => '',
  'summary' => ''
];
$errors = [];

function createReview($link, $review)
{
  $sql = <<<EOT
INSERT INTO reviews (
  title,
  artist,
  onephrase,
  age,
  summary
) VALUES (
  "{$review['title']}",
  "{$review['artist']}",
  "{$review['onephrase']}",
  "{$review['age']}",
  "{$review['summary']}"
)
EOT;
  $result = mysqli_query($link, $sql);
  if (!$result) {
    error_log('Error: fail to create review');
    error_log('Debugging Error: ' . mysqli_error($link));
  }
}

function validate($review)
{
  $errors = [];

  // 曲名が正しく入力されているかチェック
  if (!strlen($review['title'])) {
    $errors['title'] = '曲名を入力してください';
  } elseif (strlen($review['title']) > 100) {
    $errors['title'] = '曲名は100文字以内で入力してください';
  }

  // アーティスト名が正しく入力されているかチェック
  if (!strlen($review['artist'])) {
    $errors['artist'] = 'アーティスト名を入力してください';
  } elseif (strlen($review['artist']) > 100) {
    $errors['artist'] = 'アーティスト名は100文字以内で入力してください';
  }

  // OnePhraseが正しく入力されているかチェック
  if (!strlen($review['onephrase'])) {
    $errors['onephrase'] = 'OnePhraseを入力してください';
  } elseif (strlen($review['onephrase']) > 100) {
    $errors['onephrase'] = 'OnePhraseは100文字以内で入力してください';
  }

  // 年齢が正しく入力されているかチェック
  if ($review['age'] < 0 || $review['age'] > 100) {
    $errors['age'] = '年齢を正しく入力してください';
  }

  // 感想が正しく入力されているかチェック
  if (!strlen($review['summary'])) {
    $errors['summary'] = '感想を入力してください';
  } elseif (strlen($review['summary']) > 10000) {
    $errors['summary'] = '感想は10,000文字以内で入力してください';
  }

  return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $review = [
    'title' => $_POST['title'],
    'artist' => $_POST['artist'],
    'onephrase' => $_POST['onephrase'],
    'age' => $_POST['age'],
    'summary' => $_POST['summary']
  ];

  // バリデーション処理を追加
  $errors = validate($review);

  if (!count($errors)) {
    $link = dbConnect();
    createReview($link, $review);
    mysqli_close($link);
    header("Location: index.php");
  }
}

$title = 'OnePhrase登録';
$content = __DIR__ . "/views/new.php";
include __DIR__ . '/views/layout.php';
