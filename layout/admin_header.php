<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php'); // Include your database connection file
include_once($_SERVER['DOCUMENT_ROOT'] . '/helpers/markdown.php'); // Include your Markdown helper
if (!$isLogin || !$isAdmin) header("Location: /");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Blog Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/admin/blogs/" class="text-xl font-bold text-blue-600">GMarket Admin Blog</a>
                </div>
                <nav>
                    <ul class="flex space-x-6">
                        <li><a href="/admin" class="text-gray-600 hover:text-blue-500">Quay Lại Bảng Điều Kiển</a></li>
                        <li><a href="/admin/blogs" class="text-gray-600 hover:text-blue-500">Blogs</a></li>
                        <li><a href="/" class="text-gray-600 hover:text-blue-500">View Site</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>