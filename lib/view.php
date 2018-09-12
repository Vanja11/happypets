<?php

class View {
    protected $viewPath;
    protected $vars;

    function __construct($viewPath) {
        $this->viewPath = $viewPath;
        $this->vars = [];
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
        ob_start();
        include($this->viewPath);
        $buffer = ob_get_clean();

        return $buffer;
    }

    public function __toString() {
        return $this->render();
    }
}
