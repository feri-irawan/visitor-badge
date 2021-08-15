<?php
require_once 'VisitorBadge.php';

/**
 * Mendapatkan username dan repository
 */
$user = [
  "username" => isset($_GET['username']) ? $_GET['username'] : '',
  "repo" => isset($_GET['repo']) ? $_GET['repo'] : '',
];

/**
 * Mengatur custom_options badge
 */
$options = [
  "label" => isset($_GET['label']) ? $_GET['label'] : 'default',
  "color" => isset($_GET['color']) ? $_GET['color'] : 'default',
  "styles" => [
    "style" => isset($_GET['style']) ? $_GET['style'] : 'default',
    "logo" => isset($_GET['logo']) ? $_GET['logo'] : 'default',
  ],
];

/**
 * Instansiasi VisitorBadge
 */
$file_path = 'src/data/visitor.json';
$vbadge = new FI\Badge\VisitorBadge($file_path);

/**
 * Mengatur username dan repository
 */
$vbadge->setUsername($user['username']);
$vbadge->setRepository($user['repo']);

/**
 * Menapilkan hasil
 */
echo $vbadge->output($options);