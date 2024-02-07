<?php

/**
 * @package   TimelineBundle
 * @author    Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2024
 */

// Wir definieren hier nun den Namespace zu dieser Datei – wird in der /Classes/Employee.php verwendet um auf diese Datei für die CTE Erweiterung per Namespace zu verweisen.
namespace zill\TimelineBundle\Helper;



class HelperClass extends \Backend
{
    // Contao Funktion um den derzeitigen Backend Nutzer für Rechteabfragen und die Datenbank für weitere Abfragen zu bekommen
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
        $this->import('Database');
    }


    public function prepareArrayDataForTemplate($data)
    {
        $data = \StringUtil::deserialize($data, true);

        foreach($data as $key => $currentArray) {

            if ($currentArray['singleSRC'] != '') {
                $objFile = \FilesModel::findByUuid($currentArray['singleSRC']);
                if ($objFile) {
                    $data[$key]['singleSRC'] = $objFile->path;
                    $obj = new \stdClass();
                    \Controller::addImageToTemplate($obj, $data[$key]);

                    if ($data[$key]['alt']) $obj->picture['alt'] = $data[$key]['alt'];

                    $data[$key]['arrPicture'][] = $obj;
                    unset($data[$key]['singleSRC']);
                }
            }
        }
        return $data;
    }
}
