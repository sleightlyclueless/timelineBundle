<?php

/**
 * @package   TimelineBundle
 * @author    Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2024
 */

// Wir definieren hier nun den Namespace zu dieser Datei – wird in der /TimelineBundle/Resources/contao/config/config.php verwendet um auf diese Class Datei für die CTE Erweiterung per Namespace zu verweisen.
namespace zill\TimelineBundle\Classes;

// Wir holen uns externe Helperclass Funktionen unter /EmployeeBundle/Helper/Helperclass.php per Namespace. Diese werden immer nach dem Schema HelperClass::Funktionsname per Namespace dazu genommen. Die einzelnen Funktionen sind in der Helperclass Datei näher beschrieben und dienen dem zentralen Verwenden von Funktionen und dem gleichzeitigen Auslagern von Code zur modularen und besseren Lesbarkeit.
use zill\TimelineBundle\Helper\HelperClass;

// Es handelt sich hierbei um ein Inhalts- Content Element für Artikel (CTE), weswegen wir hier die \ContentElement Klasse von Contao erweitern – wurde in der /TimelineBundle/Resources/contao/config/config.php so definiert und wird nun hier weiter geführt.
class Timeline extends \ContentElement
{
    // Das hier ist das Content Template als zentraler String für die FRONTEND (FE) AUSGABE - Wird hier zentral definiert und kann dann mit $this->strTemplate in den private functions verwendet werden.
    protected $strTemplate = 'ce_timeline';


    // ===============================================BACKEND===============================================
    // Die Generate Funktion ist verantwortlich für die Backend Ausgabe des Elements, also das was wir im Backend in der Elementübersicht als "wildcards" über dieses Element angezeigt bekommen. (In diesem Fall "### Zeitstrahl ###" und weitere Angaben je nach Typ der Ausgabe).
    public function generate()
	{
        // Nur wenn wir uns im Backend befinden wollen wir die folgenden Funktionen für das Generieren der Wildcards ausführen
        if (TL_MODE == 'BE')
		{
			// Es gibt ein Standard Template für Backend Wildcards. Dieses Template erzeugt die Standard Backend Karte - so eine wollen wir natürlich auch für eine einheitliche Darstellung.
            $this->strTemplate          = 'be_wildcard';
            $this->Template             = new \BackendTemplate($this->strTemplate);

			// Die wildcard im Template ist der untere Teil des Elements. Dort schreiben wir "### Zeitstrahl ###" aus der languages Datei default.php hin
            $this->Template->wildcard   = $GLOBALS['ZI_T']['MSC']['wildcard_header'];

            // Jetzt brauchen wir noch den Title und evtl. sonstige Angaben für die fertige Wildcard. Diese varriieren je nach dem welcher Typ der Zeitstrahl-Ausgabe gewählt wurde (Einzeln, Individuelle Checkboxen, nach Abteilungen, Alle). Für diese Fälle müssen wir per switch-case unterschiedliche Abfragen der Fälle für die Wildcard Titles erstellen.
            $this->Template->title = $GLOBALS['ZI_T']['MSC']['template_title_all'];

			// Backend Template parsen und entsprechend weitergeben
            return $this->Template->parse();
        }
		// Funktion parsen und backend wildcard ausgeben
        return parent::generate();
    }


    // ===============================================FRONTEND===============================================
	// Die compile Funktion erzeugt die Ausgabe für das Frontend, bzw. gibt die Werte an das obig definierte standard Template weiter und dieses gibt es dann im Frontend weiter aus.
    protected function compile()
    {
        $helper = new HelperClass();
        $arrData = $helper->prepareArrayDataForTemplate($this->arrData['timeline']);
        $this->Template->arrTimelineData = $arrData;
    }
}
