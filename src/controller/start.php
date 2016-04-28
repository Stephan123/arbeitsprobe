<?php
namespace controller;

/**
 * allgemeine Übersichtsseite der Buchverwaltung
 *
 * @author Stephan.Krauss
 * @date 28.04.2016
 * @package Controller
 */

class start extends main
{

	public function index()
	{
		try{
			echo 'Startseite der Buchverwaltung:<br>';
			echo 'abrufen aller Bücher und Zeitschriften: www.meinServer.de/library/getArtikel/ <br>';
			echo 'abrufen aller Bücher und Zeitschriften, nach Titel sortiert: www.meinServer.de/library/getArtikel/titel/asc/ <br>';
			echo 'abrufen aller Bücher und Zeitschriften, nach ISBN Nummer gefiltert: www.meinServer.de/library/getArtikel/isbn/2145-8548-3325/ <br>';
			echo 'abrufen aller Bücher und Zeitschriften, nach Autor gefiltert: www.meinServer.de/library/getArtikel/name/Walter/ <br>';

		}
		catch(\Exception $e){
			throw $e;
		}
		
	}
	

}
