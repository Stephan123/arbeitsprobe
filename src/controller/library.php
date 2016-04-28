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
			$reader = ReaderFactory::create(Type::CSV);
			$csvPaths = \Flight::get('csvPaths');


			$test = 123;
		}
		catch(\Exception $e){
			throw $e;
		}
		
	}
	

}
