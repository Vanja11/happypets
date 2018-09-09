<?php

class View {
    protected $viewPath;
    protected $vars;

    function __construct($viewPath) {
        $this->viewPath = $viewPath;
        $this->vars = [];
    }

    function __get($name) {
        return isset($this->vars[$name]) ? $this->vars[$name] : null;
    }

    function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    function escape($str) {
        return htmlspecialchars($str);
    }

    function render() {
        ob_start();
        include($this->viewPath);
        $buffer = ob_get_clean();

        return $buffer;
    }

    function __toString() {
        return $this->render();
    }
}