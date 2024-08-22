<?php

use Threeam\ThreeamInlineCopypaste\Controller\CopyPasteController;

return [
    'threeam_inline_copypaste_paste_element' => [
        'path' => '/threeam-inline-copypaste/paste-element',
        'target' => CopyPasteController::class . '::pasteElementAction',
    ],
];