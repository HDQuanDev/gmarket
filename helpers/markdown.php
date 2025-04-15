<?php
// Include Parsedown library (you need to download this file from https://github.com/erusev/parsedown)
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendors/Parsedown.php');

function parseMarkdown($text) {
    $parsedown = new Parsedown();
    $parsedown->setSafeMode(true);
    return $parsedown->text($text);
}
