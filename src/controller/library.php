<?php
namespace controller;

/**
 * darstellen aller Bücher und Zeitschriften der Bücherverwaltung
 *
 * + alle Zeitschriften und Bücher
 * 		+ gemeinsame Spalten
 * 			+ Titel
 * 			+ ISBN - Nummer
 * 			+ Autoren
* 		+ unterschiedliche Spalten
 * 			+ Erscheinungsdatum ( Zeitschriften )
 * 			+ Kurzbeschreibung ( Bücher )
 *
 * @author Stephan.Krauss
 * @date 28.04.2016
 * @package Controller
 */

class library extends main
{

	public function getArtikel()
	{
		try{
			$csvPaths = \Flight::get('csvPaths');

			switch ($this->searchTyp) {
			    case 'all':
					$zeitschriften = $this->parseCsv($csvPaths['zeitschriften']);
					$buecher = $this->parseCsv($csvPaths['buecher']);
					$artikel = array_merge($zeitschriften, $buecher);
					$this->artikel = array_walk_recursive($artikel, , $this->searchValue);
			        break;
			    default:
					$this->artikel = $this->parseCsv($csvPaths['zeitschriften']);
					$this->artikel = $this->parseCsv($csvPaths['buecher']);
			}

			var_dump($this->artikel);
		}
		catch(\Exception $e){
			throw $e;
		}
	}
	
	protected function sortTitel()
	{
		$test = 123;

		return;
	}

	
	

}
