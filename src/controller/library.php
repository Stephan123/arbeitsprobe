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

	public function getAll()
	{
		try{
			$csvPaths = \Flight::get('csvPaths');

			// Bücher
			$buecher = $csvPaths['buecher'];
			$artikel = $this->parseCsv($buecher);

			// Zeitschriften
			$zeitschriften = $csvPaths['zeitschriften'];
			$artikel = $this->parseCsv($zeitschriften);

			echo json_encode($artikel);
		}
		catch(\Exception $e){
			throw $e;
		}
	}

	
	

}
