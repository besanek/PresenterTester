<?php

class DumpPresenter extends \Nette\Application\UI\Presenter {

    private $value;

    public function renderDefault($parameter = NULL) {
        $text = "default";

        if ($this->value) {
            $text = $this->value;
        } elseif ($parameter) {
            $text = $parameter;
        }

        if ($this->request->isPost()) {
            $text .= "-post";
        }

        $response = new Nette\Application\Responses\TextResponse($text);
        $this->sendResponse($response);
    }

    public function handleChange() {
        $this->value = "changed";
    }

}
