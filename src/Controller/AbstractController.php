<?php

    namespace Controller;

    use Slim\Container;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Slim\Views\PhpRenderer;

    /**
     * Class AbstractController
     * @package Core
     */
    abstract class AbstractController
    {
        protected $container;

        /**
         * AbstractController constructor.
         * @param Container $container
         */
        public function __construct(Container $container)
        {
            $this->container = $container;
        }

    }