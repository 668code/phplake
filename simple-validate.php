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


$loader->addClassMap(array('GUMP' => __DIR__ . '/vendor/wixel/gump/gump.class.php'));

$gump = new GUMP();

$data = array('username' => 'abc', 'password' => '123456', 'email' => 'a@a.com', 'gender' => null, 'credit_card' => 123);
$data = $gump->sanitize($data); // You don't have to sanitize, but it's safest to do so.

$gump->validation_rules(array(
    'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
    'password'    => 'required|max_len,100|min_len,6',
    'email'       => 'required|valid_email',
    'gender'      => 'required|exact_len,1|contains,m f',
    'credit_card' => 'required|valid_cc'
));

$gump->filter_rules(array(
    'username' => 'trim|sanitize_string',
    'password' => 'trim',
    'email'    => 'trim|sanitize_email',
    'gender'   => 'trim',
    'bio'      => 'noise_words'
));

$validated_data = $gump->run($data);

echo '<pre>';
if($validated_data === false) {
//    echo $gump->get_readable_errors(true);
    print_r($gump->get_readable_errors());
} else {
    print_r($validated_data); // validation successful
}

