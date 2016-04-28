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
			echo 'abrufen aller Bücher und Zeitschriften: www.meinServer.de/library/getAll/';
		}
		catch(\Exception $e){
			throw $e;
		}
		
	}
	

}
