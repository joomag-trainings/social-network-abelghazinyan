<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/26/17
     * Time: 2:50 PM
     */

    namespace Controller;
    use \Service\NotificationDrawer;
    use Slim\Http\Request;
    use Slim\Http\Response;
    use Slim\Views\PhpRenderer;
    use Slim\Container;
    use Controller\AbstractController;

    class NotificationController extends AbstractController
    {
        public function actionShow(Request $request, Response $response, $args) {

            $viewRenderer = $this->container->get('view');

            $response = $viewRenderer->render(
                $response,
                "/user/notifications.phtml",
                [

                ]
            );

            return $response;
        }

        public function actionAddcolumn(Request $request, Response $response, $args) {
            $page = $args['page'];
            $pageSize = 6;
            $from = ($page-1)*$pageSize + 1;
            NotificationDrawer::drawNotificationColumn($_COOKIE['id'],$from, $pageSize);
            return $response;
        }
    }