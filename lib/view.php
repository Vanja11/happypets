<?php
if (!defined('IN_PAGE')) {
    die ('Ovo nije dozvoljeno');
}

class View {
    protected $viewPath;
    protected $vars;
    private $renderLayout;

    function __construct($viewPath, $renderLayout = true) {
        $this->viewPath = $viewPath;
        $this->vars = [];
        $this->renderLayout = $renderLayout;
    }

    public function __get($name) {
        return isset($this->vars[$name]) ? $this->vars[$name] : null;
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function escape($str) {
        return htmlspecialchars($str);
    }

    private function render() {
        global $db;

        ob_start();

        if ($this->renderLayout) {
            include('layout/header.php');
        }

        include($this->viewPath);

        if ($this->renderLayout) {
            include('layout/footer.php');
        }
        

        $buffer = ob_get_clean();

        return $buffer;
    }

    public function __toString() {
        return $this->render();
    }
}
