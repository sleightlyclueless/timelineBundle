<?php

/**
 * @package   TimelineBundle
 * @author    Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2024
 */

// DCA Erweiterungen: Backend von Contao um Data Container Arrays Erweitern: Die tl_content Inhaltselemente

// Namespace: Der eindeutige Pfad, der auf diese entsprechende PHP Datei zeigt, damit sie von anderen Orten aus eindeutig aufgerufen und oder referenziert werden kann.
namespace zill\TimelineBundle\dca\tl_content;
use MenAtWork\MultiColumnWizardBundle\Contao\Widgets\MultiColumnWizard;


$strName = 'tl_content';

// Selektor mit Subpalettes für das Bild
$GLOBALS['TL_DCA'][$strName]['palettes']['__selector__'][] = 'addImage';
$GLOBALS['TL_DCA'][$strName]['palettes']['timeline'] = '{type_legend},type;timeline,{expert_legend:hide},guests,cssID;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop;';
$GLOBALS['TL_DCA'][$strName]['subpalettes'] = array
(
    'addImage'                    => 'singleSRC,size,imagemargin,overwriteMeta',
);



// Felder
$GLOBALS['TL_DCA'][$strName]['fields']['timeline'] = array
(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['timeline'],
    'exclude'                 => true,
    'search'                  => false,
    'filter'                  => false,
    'sorting'                 => false,
    'inputType'               => 'multiColumnWizard',
    'eval'      => array
    (
        'columnFields' => array
        (
            'timeline_headline' => array
            (
                'exclude'                 => true,
                'search'                  => true,
                'inputType'               => 'inputUnit',
                'options'                 => array('p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
                'eval'                    => array(
                                                'maxlength'=>200,
                                                'placeholder'=>'Überschrift eingeben',
                                             ),
                'sql'                     => "varchar(255) NOT NULL default 'a:2:{s:5:\"value\";s:0:\"\";s:4:\"unit\";s:2:\"h2\";}'"
            ),

            // Bild Filetree Element zum hinzufügen von Bildern
            'singleSRC' => array
            (
                'exclude'			      => true,
                'search'      		      => false,
                'sorting'     		      => false,
                'filter'     		      => false,
                'inputType'			      => 'fileTree',
                'eval'				      => array(
                                                    'filesOnly'=>true,
                                                    'fieldType'=>'radio',
                                                    'extensions' => 'jpg,jpeg,gif,png,svg',
                                                    'placeholder'=>'Bild auswählen',
                                             ),
                'sql'       		      => "binary(16) NULL"

            ),

            // Textfeld zur Eingabe des Alttextes
            'alt' => array
            (
                'label'                   => &$GLOBALS['TL_LANG'][$strName]['alt'],
                'exclude'			      => true,
                'search'      		      => false,
                'sorting'     		      => false,
                'filter'     		      => false,
                'inputType'               => 'text',
                'eval'                    => array(
                                                'maxlength'=>255,
                                                'placeholder'=>'Alttext für Bild eingeben',
                                             ),
                'sql'                     => "varchar(255) NOT NULL default ''"
            ),

            'timeline_content' => array
            (
                'label'                   => &$GLOBALS['TL_LANG'][$strName]['text'],
                'exclude'                 => true,
                'search'                  => false,
                'sorting'                 => false,
                'filter'                  => false,
                'inputType'               => 'textarea',
                'eval'                    => array(
                                                'rte'=>'tinyMCE',
                                                'placeholder'=>'Text für Timelineinhalt eingeben',
                                             ),
                'sql'                     => "mediumtext NULL"
            )
        ),
    ),
    'sql'       => 'blob NULL'
);

class tl_content_timeline extends \Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

}