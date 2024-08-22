<?php

declare(strict_types=1);

namespace Threeam\ThreeamInlineCopypaste\Form\Controls;

use TYPO3\CMS\Backend\Clipboard\Clipboard;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "3AM Inline Copy paste" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Mohsin Qayyum <mohsin.khan@3am-tech.com>, OMMAX
 */


/**
 * CopyPasteInlineRecord
 */
class CopyPasteInlineRecord
{
    /**
     * Adds a paste content button to the specified parameters.
     *
     * @param array $parameters The array of parameters.
     * @param mixed $pObj The value of pObj.
     * @return array The processed data.
     */
    public function addPasteContentButton($parameters, $pObj): string
    {
        
        $clipboard = GeneralUtility::makeInstance(Clipboard::class);
        // Read the clipboard content from the user session
        $clipboard->initializeClipboard();
        if($clipboard->clipData['normal']['mode'] != 'copy') {
            return '';
        }

        foreach ($clipboard->clipData['normal']['el'] as $tableNameAndUid => $value) {
            $clipboardTableName = explode('|', $tableNameAndUid)[0];
            $recordUid = explode('|', $tableNameAndUid)[1];
            if($clipboardTableName == $parameters['config']['foreign_table']) {
                $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
                $pageRenderer->loadRequireJsModule('TYPO3/CMS/ThreeamInlineCopypaste/CopyPasteInlineRecord');
                
                return '
                        <div style="margin-top : 10px">
                            <button type="button" class="btn btn-default copy-paste-inline-record"><span class="t3js-icon icon icon-size-small icon-state-default icon-actions-clipboard-paste" data-identifier="actions-clipboard-paste">
                                <span class="icon-markup">
                                    <svg class="icon-color"><use xlink:href="/typo3/sysext/core/Resources/Public/Icons/T3Icons/sprites/actions.svg#actions-clipboard-paste"></use></svg>
                                </span>
                            </span> Paste Record</button>
                        </div>
                    ';
            }
        }

        return '';
    }
}
