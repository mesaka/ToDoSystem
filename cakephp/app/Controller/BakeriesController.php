<?php
class BakeriesController extends AppController {

        public $helpers = array('Markdown.Markdown');
        public $components = array('Markdown.Markdown');

        public function index() {
            $this->set('textInMarkdownFormat', $this->Markdown->getFile($pathToFile));
        }
}