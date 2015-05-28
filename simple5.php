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

$loader = require 'vendor/autoload.php';
$loader->set('', __DIR__.'/src');
$loader->register();

//use Symfony\Component\Debug\ErrorHandler;
//ErrorHandler::register();

use Symfony\Component\Debug\Debug;
//Debug::enable();
Debug::enable(E_USER_WARNING);
//trigger_error('ss', E_USER_NOTICE);

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
// 防止静态文件不存在，再跑一遍index
$uri = $request->getPathInfo();
$uri_js = strtolower(substr($uri, -3, 3));
if ($uri_js == '.js') {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
    $response->send();
    exit;
}
$uri_static = strtolower(substr($uri, -4, 4));
if (in_array($uri_static, array('.css', '.jpg', '.png', '.gif', '.ico'))) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
    $response->send();
    exit;
}
$uri_jpeg = strtolower(substr($uri, -5, 5));
if ($uri_jpeg == '.jpeg') {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
    $response->send();
    exit;
}

//获取网址和路由
$context = new Symfony\Component\Routing\RequestContext();
$context->fromRequest($request);

//路由配置
$routes = new Symfony\Component\Routing\RouteCollection();
$routes->add('root', new Symfony\Component\Routing\Route('/', array(
    '_controller' => 'IndexController::indexAction',
//    'display_name' => '菜单',
)));

$matcher = new Symfony\Component\Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new Symfony\Component\HttpKernel\Controller\ControllerResolver();
$app = new Framework\Core5($matcher, $resolver);
$response = $app->handle($request);

//echo '<pre>';
//print_r($request->attributes);

$response->send();



class IndexController {
    
    public function indexAction() {
//        throw new Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
//        return new Response('index action');
        global $request;
        if ($request->isMethod('POST')) {
            echo '<pre>';
            print_r($request->files->get('img'));
//            $file = $request->files->get('img');
//            $file->move('d:/temp/sfupload', 'psg.jpg');
        }
        $html = <<<EOT
<form method="post" enctype="multipart/form-data">
 <input type="file" name="img" title="Upload Image" />
 <input type="submit" value="Up" />
</form>
EOT;
        return new Response($html);
    }
    
}
