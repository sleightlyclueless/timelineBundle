<?php

/**
 * @package   TimelineBundle
 * @author    Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2024
 */


 // CONTENT ELEMENTS  erweitern das Frontend Artikel Inhaltselemente
 $GLOBALS['TL_CTE']['Zill']['timeline'] = 'zill\\TimelineBundle\\Classes\\Timeline';


 if (TL_MODE == 'BE') {
    $GLOBALS['TL_CSS'][] = 'bundles/timeline/css/be.css';
 }

 if (TL_MODE == 'FE') {
    $GLOBALS['TL_CSS'][] = 'bundles/timeline/css/timeline.css';
    $GLOBALS['TL_CSS'][] = 'bundles/timeline/css/bootstrap.css';
 }