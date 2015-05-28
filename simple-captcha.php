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

use Gregwar\Captcha\CaptchaBuilder;

$builder = new CaptchaBuilder;
$builder->build();

//You can then save it to a file :
//$builder->save('out.jpg');

//Or output it directly :
//header('Content-type: image/jpeg');
//$builder->output();

// Example: storing the phrase in the session to test for the user 
// input later
//$_SESSION['phrase'] = $builder->getPhrase();

?>
<img src="<?php echo $builder->inline(); ?>" />
