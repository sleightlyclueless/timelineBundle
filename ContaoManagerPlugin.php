<?php

/**
 * @package   TimelineBundle
 * @author    (c) Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2024
 */

// Namespace: Der eindeutige Pfad, der auf diese entsprechende PHP Datei zeigt, damit sie von anderen Orten aus per use statement eindeutig aufgerufen und oder referenziert werden kann. Diese Datei wird von der /src/TimelineBundle/composer.json aufgerufen, die wiederrum durch den /composer.json im root aufgerufen wurde.
namespace zill\TimelineBundle;

// Um Bundles zu den Contao Core (Standard) Bundles hinzu zu nehmen, gibt es die Contao Funktion "getBundles" vom "BundlePluginInterface"
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\CoreBundle\ContaoCoreBundle;

// Lade das BundlePluginInterface von Contao
class ContaoManagerPlugin implements BundlePluginInterface
{
    // Ziehe dir die Bundles und Konfigurationsdateien vom Bundle Parser
	public function getBundles(ParserInterface $parser)
	{
        // Lade unser Bundle in die Config hinzu – allerdings erst nach dem Core Bundle, damit wir keine DCA Konflikte haben
		return [
            BundleConfig::create(TimelineBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
		];
	}
}
