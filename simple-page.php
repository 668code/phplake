<?php

/* 
 * The MIT License
 *
 * Copyright 2015 Li Feilong <feiyang8068@qq.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->set('', __DIR__.'/src');
$loader->register();

use JasonGrimes\Paginator;

$totalItems = 1000;
$itemsPerPage = 30;
//$currentPage = 8;
//$urlPattern = '/foo/page/(:num)';
$currentPage = $_GET['page'];
$urlPattern = '?page=(:num)';

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

?>
<html>
  <head>
    <!-- The default, built-in template supports the Twitter Bootstrap pagination styles. -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  </head>
  <body>

    <?php 
      // Example of rendering the pagination control with the built-in template.
      // See below for information about using other templates or custom rendering.

      echo $paginator; 
    ?>

  </body>
</html>


