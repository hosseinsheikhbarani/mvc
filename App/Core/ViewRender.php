<?php

namespace lil\App\Core;

use lil\App\Core\Application;


class ViewRender
{
    public function renderView($view, $params = [])
    {

        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        $content = str_replace('{{content}}', $viewContent, $layoutContent);
        return $content;
    }

    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        $head = $this->renderHead();;
        $properties = Application::$app->controller->getLayoutProperties();
        
        foreach ($properties as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once ROOTDIR . "/public/Views/layouts/$layout.php";
        return ob_get_clean();
    }

    private function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include_once ROOTDIR . "/public/Views/$view.php";
        return ob_get_clean();
    }

    private function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    private function renderHead()
    {
        $head = Application::$app->controller->head;
        $content = '';
        foreach ($head as $key => $value) {

            $content .= str_replace('{{el}}', $value['val'], $value['el']);
        }
        return  $content;
    }
}
