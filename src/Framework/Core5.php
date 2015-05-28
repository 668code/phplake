<?php

namespace Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
 
class Core5 {
    protected $matcher;
    protected $resolver;
    
    /**
     * 
     * @param \Symfony\Component\Routing\Matcher\UrlMatcher $matcher
     * @param \Symfony\Component\HttpKernel\Controller\ControllerResolver $resolver
     */
    public function __construct(UrlMatcher $matcher, ControllerResolver $resolver)
    {
        $this->matcher = $matcher;
        $this->resolver = $resolver;
    }
    
    /**
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request)
    {
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
 
            $controller = $this->resolver->getController($request);
            $arguments = $this->resolver->getArguments($request, $controller);
            // Array ( [0] => IndexController Object ( ) [1] => indexAction )
            // print_r($controller);
            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        }
        
        return $response;
    }
    
}
