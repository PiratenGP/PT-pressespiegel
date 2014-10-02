<?php
wp_enqueue_style( "pt-pressespiegel", plugin_dir_url(__FILE__)."style.css" );

function esort($a, $b) {
	$d1 = $a['date'];
	$d2 = $b['date'];
	if ($d1 < $d2) {
		return 1;
	} elseif ($d2 < $d1) {
		return -1;
	} else {
		return 0;
	}
}

class PT_pressespiegel {


	static public function shortcode($atts) {
		$options = get_option("pt_pressespiegel");
		$entries = $options['entries'];
		
		uasort($entries, "esort");
		
		ob_start();
		include('shortcode/list.php');
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}
	


	static public function adminmenu() {
		
		
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		if ($_GET['reset'] == "1") update_option("pt_pressespiegel", null);
		
		$options = get_option("pt_pressespiegel");
/*
$data = <<< DATA
<table>
<tbody>

<tr><td nowrap="nowrap"><strong>31.05.2014</strong></td><td>NWZ Göppingen</td><td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-beraten-ueber-Fraktion;art5583,2631298"><strong>Piraten beraten über Fraktion</strong></a></td></tr>
<tr>
<td nowrap="nowrap"><strong>30.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-sehen-sich-nicht-als-Schmuggler;art5583,2629401"><strong>Piraten sehen sich nicht als "Schmuggler"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Strebt-OB-Till-im-Kreistag-Fraktionsvorsitz-an;art5583,2627624"><strong>Strebt OB Till im Kreistag Fraktionsvorsitz an?</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.05.2014</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.gemeinderatswahl-in-goeppingen-der-lohn-fuer-die-konfrontation.051a1428-098c-45cc-973a-1f1e367c7a1d.html"><strong>Linke Sieger und eine bürgerliche Mehrheit</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Stuehleruecken-im-Goeppinger-Gemeinderat;art1158499,2624763"><strong>Stühlerücken im Göppinger Gemeinderat</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/KOMMENTAR-GOePPINGEN-Neue-Unruhe-kuendigt-sich-an;art1158499,2624780"><strong>Neue Unruhe kündigt sich an</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Gewaehlter-Pirat-erklaert-Verzicht-auf-sein-Mandat;art1158499,2624764"><strong>Aufregung um Piratenpartei</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.05.2014</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.kreis-goeppingen-vor-der-wahl-politprominenz-strebt-in-den-kreistag.72cc7804-6c90-4f8b-bc80-0bd00c1d5cde.html"><strong>Viel Politprominenz strebt in den Kreistag</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>22.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Im-Goeppinger-Gemeinderat-koennte-es-noch-unuebersichtlicher-werden;art5583,2617580"><strong>Im Göppinger Gemeinderat könnte es noch unübersichtlicher werden</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>20.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Protest nicht ignorieren</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/NACHRICHTEN-vom-17-Mai-2014;art5583,2609205"><strong>Piraten für Bürgerhaushalt</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>15.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Piraten kritisieren Politik</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>14.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Gymnasiasten-befragen-Politiker-beim-Speeddating;art5583,2603522"><strong>Gymnasiasten befragen Politiker beim "Speeddating"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Größter Verlierer mit Sitz belohnt</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.05.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Groesster-Verlierer-mit-Sitz-belohnt;art5573,2600566"><strong>Größter Verlierer mit Sitz belohnt</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.05.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/WAHLKALENDER;art5573,2600283"><strong>Wahlkalender</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>12.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/WAHLKALENDER;art5583,2598066"><strong>Wahlkalender</strong></a></td>
</tr>
<td nowrap="nowrap"><strong>09.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/NACHRICHTEN-vom-9-Mai-2014;art5583,2593850"><strong>Mehr Geld für Straßen</strong></a></td>

<tr>
<td nowrap="nowrap"><strong>07.05.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/NACHRICHTEN-vom-7-Mai-2014;art5583,2589413"><strong>Piraten für Märklinwelt</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.04.2014</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.wahlserie-goeppingen-der-waehler-soll-erloesung-bringen.7a63e742-c95d-490a-84b3-e65344d08ded.html"><strong>Wahlserie: Göppingen - Der Wähler soll Erlösung bringen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.04.2014</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.wahlserie-gingen-die-gingener-warten-auf-den-tag-x.0023a386-a854-4c6b-91a3-8e9d2a0d5bc6.html"><strong>Wahlserie: Gingen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.04.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-wollen-Transparenz;art5573,2566018"><strong>Piraten wollen Transparenz</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.04.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Piraten wollen Transparenz</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>08.04.2014</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.neubau-der-klinik-am-eichert-die-planung-erfolgt-von-innen.4f27c4c5-1f9c-4082-a655-185d3a9a6add.html"><strong>Die Planung erfolgt von „innen“</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>04.04.2014</strong></td>
<td>NWZ</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-Kosten-fuer-Klinikneubau-laufen-davon;art5583,2537141"><strong>Piraten: Kosten für Klinikneubau laufen davon</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>04.04.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/56-Wahlvorschlaege-wurden-zugelassen-Bei-der-Kreistagswahl-treten-429-Bewerber-an;art5573,2537175"><strong>56 Wahlvorschläge wurden zugelassen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>04.04.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>56 Wahlvorschläge wurden zugelassen</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>04.04.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Regionalwahl-ohne-Piraten-und-AfD;art5583,2536695"><strong>Regionalwahl ohne Piraten und AfD</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>02.04.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Wahlvorschlaege-zugelassen;art5583,2532515"><strong>Wahlvorschläge zugelassen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>01.04.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><strong>„Es bleibt G’schmäckle“</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>31.03.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Klinikneubau-Piraten-pochen-auf-Transparenz;art5583,2528367"><strong>Klinikneubau: Piraten pochen auf Transparenz</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Die-AfD-tritt-nicht-bei-der-Kreistagswahl-an;art5583,2524303"><strong>Die AfD tritt nicht bei der Kreistagswahl an</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><strong>Die AfD tritt nicht bei der Kreistagswahl an</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>20.03.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-fordern-mehr-Transparenz;art5573,2510320"><strong>Piraten fordern mehr Transparenz</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.03.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Kritik-an-Info-Abenden;art5583,2503960"><strong>Kritik an Info-Abenden</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.02.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Hoffnung-auf-Sitze;art5583,2473456"><strong>Hoffnung auf Sitze</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>02.02.2014</strong></td>
<td>Sonntag Aktuell</td>
<td><strong>Piraten fordern Liveübertragungen</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.01.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislinger_alb/GINGEN;art5567,2405465"><strong>Gingen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.01.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Kritik an Razavi und Gegenangriff auf Binder</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.01.2014</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Kritik-an-Razavi-und-Gegenangriff-auf-Binder;art5573,2403599"><strong>Kritik an Razavi und Gegenangriff auf Binder</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>15.01.2014</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Piraten treten an</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>14.01.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-kritisieren-Vorgehen;art5583,2397022"><strong>Piraten kritisieren Vorgehen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>07.01.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piratenpartei-begruesst-Urteil;art5583,2385074"><strong>Piratenpartei begrüßt Urteil</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>03.01.2014</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Kritik-an-fehlender-Inklusion;art5583,2381395"><strong>Kritik an fehlender Inklusion</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.12.2013</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Piratenpartei: Wirbel um Falschmeldung</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.12.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><strong>Piratenpartei: Wirbel um Falschmeldung</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.12.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/NACHRICHTEN-vom-28-Dezember-2013;art5583,2375159"><strong>Piraten mit Kreisverband</strong></a> (Falschmeldung!)</td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.12.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-gruenden-Kreisverband;art5573,2374990"><strong>Piraten gründen Kreisverband</strong></a> (Falschmeldung!)</td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.12.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Klinikneubau-Piraten-warnen-vor-Desaster;art5583,2360941"><strong>Klinikneubau: Piraten warnen vor "Desaster"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.12.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Klinikneubau-Piraten-warnen-vor-Desaster;art5573,2360865"><strong>Klinikneubau: Piraten warnen vor "Desaster"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>03.12.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Buerger-sollen-ins-Boot;art5583,2336540"><strong>Bürger sollen ins Boot</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>03.12.2013</strong></td>
<td>Gesilinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-fordern-Entscheid-ueber-Klinik-Neubau;art5573,2336627"><strong>Piraten fordern Entscheid über Klinik-Neubau</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.11.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Kommunalwahl-Piraten-treten-an;art5583,2308971"><strong>Kommunalwahl: Piraten treten an</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.09.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Die-Hoffnung-stirbt-zuletzt;art5573,2208446"><strong>Die Hoffnung stirbt zuletzt</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.09.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><strong>Die Hoffnung stirbt zuletzt</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.09.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Jungwaehler-lauschen-Bundestagskandiaten;art5573,2199879"><strong>Jungwähler lauschen Bundestagskandiaten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>11.09.2013</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.bundestagswahl-vier-kandidaten-und-viele-randgruppen.fa8de94b-29fe-4d1f-8859-1b33756c690b.html"><strong>Vier Kandidaten und viele Randgruppen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>10.09.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-appellieren-an-Stadt-Goeppingen;art5573,2193640"><strong>Piraten appellieren an Stadt Göppingen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>20.08.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Kandidaten-diskutieren-ueber-mehr-Demokratie;art5583,2160986"><strong>Kandidaten diskutieren über mehr Demokratie</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>20.08.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><strong>Wahlkampf kommt in Bewegung</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.08.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Volksentscheid-bundesweit;art5583,2151112"><strong>Volksentscheid bundesweit?</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.07.2013</strong></td>
<td>Stuttgarter Zeitung</td>
<td><strong>Die Violetten dürfen nicht</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.07.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><strong>Bundestagswahl: Neun Bewerber im Wahlkreis</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.07.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Bundestagswahl-Neun-Bewerber-im-Wahlkreis;art5583,2127875"><strong>Bundestagswahl: Neun Bewerber im Wahlkreis</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>26.07.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Wahlpodium-Kandidaten-im-Clinch;art5583,2126763"><strong>Wahlpodium: Kandidaten im Clinch</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>26.07.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Wahlpodium-Kandidaten-im-Clinch;art5573,2126521"><strong>Wahlpodium: Kandidaten im Clinch</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>25.07.2013</strong></td>
<td>Stuttgarter Zeitung</td>
<td><strong>Auch die Jungen von heute müssen für ihr Alter sparen</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.07.2013</strong></td>
<td>Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/12657-suessen-wahlpodium-mit-eindeutigen-gewinn"><strong>Süßen: Wahlpodium mit eindeutigen Gewinnern</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.07.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Der-Rollenwechsel-wird-nicht-leicht;art5583,2123269"><strong>"Der Rollenwechsel wird nicht leicht"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.07.2013</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Kurz notiert</strong></td>
</tr>
<tr></tr>
<tr>
<td nowrap="nowrap"><strong>16.07.2013</strong></td>
<td>NWZ Göppingen</td>
<td><strong>Kurz notiert</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.07.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Sicheres-Internet-Piraten-klaeren-auf;art5573,2106198"><strong>Sicheres Internet: Piraten klären auf</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.05.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Pirat-mit-Helfersyndrom;art5583,2009579"><strong>Pirat mit "Helfersyndrom"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.04.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-erfreut-ueber-Resonanz-auf-ihren-Vorstoss;art5583,1952057"><strong>Piraten erfreut über Resonanz auf ihren Vorstoß</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>10.04.2013</strong></td>
<td>Stuttgarter Zeitung</td>
<td><strong>Pirat meldet Gemeinderat bei "abgeordnetenwatch" an</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>10.04.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Der-OB-will-nicht-antworten;art5583,1940156"><strong>Der OB will nicht antworten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>09.04.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-im-Kreis-glauben-an-neuen-Aufschwung;art5583,1937903"><strong>Piraten im Kreis glauben an neuen Aufschwung</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>09.04.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Zweite-Kandidatenkuer-fuer-die-Bundestagswahl;art5583,1937398"><strong>Zweite Kandidatenkür für die Bundestagswahl</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>08.04.2013</strong></td>
<td>Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/2011-06-07-21-16-23/10875-goeppingen-piratenpartei-fuer-mehr-buergerbeteiligung.html"><strong>Göppingen: Piratenpartei für mehr Bürgerbeteiligung</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>08.04.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-melden-direkten-Draht-zu-Stadtraeten-an;art5583,1935277"><strong>Piraten melden direkten Draht zu Stadträten an</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>08.04.2013</strong></td>
<td>Geislinger Zeitung</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-melden-direkten-Draht-zu-Stadtraeten-an;art5583,1935277"><strong>Piraten melden direkten Draht zu Stadträten an</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>03.04.2013</strong></td>
<td>NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-kritisieren-die-Schulpolitik-in-Goeppingen;art5583,1928374"><strong>Piraten kritisieren die Schulpolitik in Göppingen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.03.2013</strong></td>
<td>Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.abwaertstrend-der-piraten-ein-ruf-nach-respekt-und-hoeflichkeit.d34c792a-302a-42d2-80d1-a0fa9bdefd88.presentation.print.v2.html"><strong>Ein Ruf nach Respekt und Höflichkeit</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>11.03.2013</strong></td>
<td>Filstalexpress</td>
<td><a href="http://filstalexpress.de/2011-06-07-21-16-16/10429-goeppingen-piratenpartei-kritisiert-schulpolitik-der-stadt.html"><strong>Piratenpartei kritisiert Schulpolitik der Stadt</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>01.03.2013</strong></td>
<td>Filstalexpress</td>
<td><a href="http://filstalexpress.de/2011-06-07-21-16-23/10294-kreis-lobbyinteressen-siegen-ueber-vernunft-koalition-beschliesst-mit-stimmen.html"><strong>Kreis: Lobbyinteressen siegen über Vernunft: Koalition beschließt mit Stimmen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.12.2012</strong></td>
<td>Das war 2012</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Jahresrueckblick-CDU-sorgt-fuer-Paukenschlag;art5573,1783860"><strong>Jahresrückblick: CDU sorgt für Paukenschlag</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>19.12.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piratenpartei-im-Kreis-schlittert-in-die-Krise;art5573,1774062"><strong>Piratenpartei im Kreis schlittert in die Krise</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.12.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piratenpartei-im-Kreis-schlittert-in-die-Krise;art5583,1772622"><strong>Piratenpartei im Kreis schlittert in die Krise</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.12.2012</strong></td>
<td nowrap="nowrap">Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.kein-kreisverband-fuer-goeppingen-piraten-verlaesst-der-mut.f0105759-136a-41c0-ab72-eb4dadd6a3ca.html"><strong>Piraten verlässt der Mut</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.12.2012</strong></td>
<td nowrap="nowrap">Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/2011-06-07-21-16-23/9276-piraten-kritisieren-legalisierung-der-koerperverletzung-durch-cdu-und-fdp.html"><strong>Piraten kritisieren Legalisierung der Körperverletzung durch CDU und FDP</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>08.12.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-kritisieren-CDU-Beschluss;art5583,1759388"><strong>Piraten kritisieren CDU-Beschluss</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>07.12.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-kritisieren-CDU-Beschluss-zur-Ehe;art5573,1757576"><strong>Piraten kritisieren CDU-Beschluss zur Ehe</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>13.12.2012</strong></td>
<td nowrap="nowrap">Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/2011-06-07-21-16-23/9170-kreis-piraten-kritisieren-cdu-beschluss-vom-bundesparteitag.html"><strong>Kreis: Piraten kritisieren CDU-Beschluss vom Bundesparteitag</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.11.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Von-hohem-oeffentlichen-Interesse;art5573,1746629"><strong>Von hohem öffentlichen Interesse</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.11.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Klinikneubau-Piraten-fordern-Offenlegung;art5583,1746683"><strong>Klinikneubau: Piraten fordern Offenlegung</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.11.2012</strong></td>
<td nowrap="nowrap">Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/2011-06-07-21-16-23/9054-kreis-piratenpartei-fordert-offenlegung-der-klinik-gutachten.html"><strong>Kreis: Piratenpartei fordert Offenlegung der Klinik-Gutachten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.11.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-fuer-noch-weitere-Senkung;art5573,1742866"><strong>Piraten für noch weitere Senkung</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.11.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-fordern-Wahlalter-noch-weiter-senken;art5583,1741128"><strong>Piraten fordern: Wahlalter noch weiter senken</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.11.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td nowrap="nowrap"><strong>Pirat kandidiert jetzt doch nicht</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.11.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Pirat-kandidiert-jetzt-doch-nicht;art5573,1737357"><strong>Pirat kandidiert jetzt doch nicht</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.11.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Timo-Czerwonka-fuer-Kreisvorstand;art5573,1735603"><strong>Timo Czerwonka für Kreisvorstand</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.11.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Timo-Czerwonka-fuer-Kreisvorstand;art5583,1735495"><strong>Timo Czerwonka für Kreisvorstand</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>22.11.2012</strong></td>
<td nowrap="nowrap">SWP Online</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Wahl-zum-Kreisvorstand-Kandidat-fuer-Piraten;art5583,1735192"><strong>Wahl zum Kreisvorstand: Kandidat für Piraten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>16.11.2012</strong></td>
<td nowrap="nowrap">Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/2011-06-07-21-16-23/8863-kreis-senkung-des-wahlalters-geht-piratenpartei-noch-nicht-weit-genug.html"><strong>Kreis: Senkung des Wahlalters geht Piratenpartei noch nicht weit genug</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>15.11.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-Kritik-an-CDU-und-FDP;art5583,1722885"><strong>Piraten-Kritik an CDU und FDP</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>14.11.2012</strong></td>
<td nowrap="nowrap">Filstalexpress</td>
<td><a href="http://www.filstalexpress.de/2011-06-07-21-16-23/8809-kreis-goeppinger-bundestagsabgeordnete-verhindern-mehr-transparenz.html"><strong>Kreis: Göppinger Bundestagsabgeordnete verhindern mehr Transparenz</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.10.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-im-Kreis-in-Personalnot;art5573,1688466"><strong>Piraten im Kreis in Personalnot</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>02.10.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/OB-WAHLKALENDER;art5583,1657801"><strong>OB-WAHLKALENDER</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>19.09.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/OB-Sessel-Sieben-Bewerber-stehen-zur-Wahl;art5573,1639088"><strong>OB-Sessel: Sieben Bewerber stehen zur Wahl</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>19.09.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/OB-Sessel-Sieben-Bewerber-stehen-zur-Wahl;art5583,1638462"><strong>OB-Sessel: Sieben Bewerber stehen zur Wahl</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.09.2012</strong></td>
<td nowrap="nowrap">SWP online</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Stefan-Klotz-ist-aus-dem-Rennen-um-den-OB-Posten;art5583,1638462"><strong>Stefan Klotz ist aus dem Rennen um den OB-Posten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>31.08.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Ein-Pirat-will-das-Rathaus-entern;art5573,1612816"><strong>Ein Pirat will das Rathaus entern</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>31.08.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Ein-Pirat-will-das-Rathaus-entern;art5583,1613028"><strong>Ein Pirat will das Rathaus entern</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.08.2012</strong></td>
<td nowrap="nowrap">Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.ob-wahl-in-goeppingen-piraten-wollen-tills-rathaus-entern.99a70b49-80d6-4c6f-9ae8-3e0a5e600595.html"><strong>Piraten wollen Tills Rathaus entern</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.07.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/61-Jaehriger-wird-Piratenkandidat;art5583,1557272"><strong>61-Jähriger wird Piratenkandidat</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>23.07.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piratenpartei-im-Kreis-nominiert-Schellong;art5573,1555790"><strong>Piratenpartei im Kreis nominiert Schellong</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>19.07.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Goeppinger-Piraten-waehlen-Kandidaten;art5583,1548717"><strong>Göppinger Piraten wählen Kandidaten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.07.2012</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Piraten-waehlen-Kandidaten;art5573,1547049"><strong>Piraten wählen Kandidaten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.05.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td nowrap="nowrap"><strong>Piraten schreiben Brief</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>07.05.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.webcitation.org/query?url=http%3A%2F%2Fwww.swp.de%2Fgoeppingen%2Flokales%2Fgoeppingen%2FWahlergebnis-Freude-bei-FDP-und-Piraten%3Bart5583%2C1450383&amp;date=2012-05-07"><strong>Wahlergebnis: Freude bei FDP und Piraten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>20.04.2012</strong></td>
<td nowrap="nowrap">Stuttgarter Zeitung</td>
<td><a href="http://www.stuttgarter-zeitung.de/inhalt.piratenpartei-in-goeppingen-offline-ins-rathaus.023eb553-0e0b-4a99-938f-6b0fd57ccba6.html"><strong>Offline ins Rathaus</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>17.04.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Kinder-sollen-Politik-in-der-Schule-machen;art5583,1422388">"Kinder sollen Politik in der Schule machen"</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>27.03.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Goeppinger-Piraten-freuen-sich-mit-Saarlaendern;art5583,1395167">Göppinger Piraten freuen sich mit Saarländern</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>21.03.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-machen-bei-Buendnis-mit;art5583,1386755">Piraten machen bei Bündnis mit</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.02.2012</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-treffen-sich-in-Faurndau;art5583,1356624">Piraten treffen sich in Faurndau</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>22.12.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piraten-und-CDU-streiten-ueber-Quorum;art5583,1266720">Piraten und CDU streiten über Quorum</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>16.11.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/NWZ-FORUM-STUTTGART-21;art5583,1214925">Stuttgart 21: Piraten informieren</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>04.10.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/Piratenpartei-will-Fuss-fassen;art5573,1141503">Piratenpartei will Fuß fassen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>04.10.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Piratenpartei-will-Fuss-fassen;art5583,1141722,A">Piratenpartei will Fuß fassen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>30.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/Heimvorteil-gilt-nur-bedingt;art5573,901816">Heimvorteil gilt nur bedingt</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/mittleres_filstal/Drei-Bewerber-aus-einem-Dorf;art5777,900533,A">Drei Bewerber aus einem Dorf</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Schluss-mit-Schmusen;art5583,898727,A">Schluss mit Schmusen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Fuenf-Mandate-fuer-den-Kreis;art5583,898804">Fünf Mandate für den Kreis</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Linke-hofft-vergebens-auf-ein-gutes-Ergebnis;art5583,898709">Linke hofft vergebens auf ein gutes Ergebnis</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/Katerstimmung-bei-FDP-und-Linke;art5573,898518">Katerstimmung bei FDP und Linke</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>28.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/Erstmals-zwei-Abgeordnete;art5573,898570">Erstmals zwei Abgeordnete</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>25.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/Vier-kleine-Parteien-im-Rennen;art5573,895336">Vier kleine Parteien im Rennen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Auch-vier-kleine-Parteien-gehen-ins-Rennen;art5583,893931">Auch vier kleine Parteien gehen ins Rennen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/Das-Kreuz-mit-den-Kreuzen;art5573,893561,A">Das Kreuz mit den Kreuzen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>24.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Das-Kreuz-mit-den-Kreuzen;art5583,893933">Das Kreuz mit den Kreuzen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>21.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/U18-Wahl-Jugendliche-fuer-Politikwechsel;art5573,888432">U18-Wahl: Jugendliche für Politikwechsel</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>21.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong>U18-Wahl: Jugendliche für Politikwechsel</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>18.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Atomunfall-bestimmt-den-Wahlkampf;art5583,885385">Atomunfall bestimmt den Wahlkampf</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>15.03.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Podium-fuer-Jugendliche;art5583,879892">Podium für Jugendliche</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>15.03.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/U-18-Wahlen-im-Kreis-Goeppingen;art5573,880063">U-18-Wahlen im Kreis Göppingen</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>16.02.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Der-Schilderwald-gedeiht-praechtig;art5583,843117">Der Schilderwald gedeiht prächtig</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>02.02.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong>Der Countdown läuft</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>02.02.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/art5583,824031">Der Countdown läuft</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.01.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong></strong><strong>Vermutlich gibt es neun Bewerber</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.01.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/art5583,819572"><strong>Vermutlich gibt es neun Bewerber</strong></a>
</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.01.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/art5573,818990"><strong>Wahlkreis 10 Göppingen</strong></a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.01.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Wahlkreis-10-Goeppingen;art5583,819134"><strong>Wahlkreis 10 Göppingen</strong></a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.01.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/art5573,818979"><strong>Wahlkreis 11 Geislingen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>29.01.2011</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><a href="http://www.swp.de/goeppingen/lokales/goeppingen/Wahlkreis-11-Geislingen;art5583,819123"><strong>Wahlkreis 11 Geislingen</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>21.01.2011</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/Im-Vorstand-der-Piraten;art5573,653694"><strong>Im Vorstand der "Piraten"</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>01.10.2010</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><a href="http://www.swp.de/geislingen/lokales/geislingen/art5573,807596"><strong>Czerwonka will für die Piraten antreten</strong></a></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>07.04.2010</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/art5583,431569">"Piraten" machen Leinen los</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>03.04.2010</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong> <a href="http://www.swp.de/geislingen/lokales/geislingen/art5573,428519">Auch die Piraten wollen in den Landtag </a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>11.02.2010</strong></td>
<td nowrap="nowrap">Mitteilungsblatt Lauterstein</td>
<td><strong>Piratenpartei Lauterstein</strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>11.02.2010</strong></td>
<td nowrap="nowrap">NWZ Göppingen</td>
<td><strong><a href="http://www.swp.de/goeppingen/lokales/goeppingen/art5583,360302">Kandidaten der Piraten</a></strong></td>
</tr>
<tr>
<td nowrap="nowrap"><strong>11.02.2010</strong></td>
<td nowrap="nowrap">Geislinger Zeitung</td>
<td><strong><a href="http://www.swp.de/geislingen/lokales/geislingen/art5573,360376">1500 Mitglieder im Land</a>
</strong></td>
</tr>
</tbody>
</table>      
DATA;

preg_match_all('/<tr.*?>(.*?)<\/tr>/si', $data, $rows);

foreach ($rows[1] as $row) {
	preg_match_all('/<td.*?>(.*?)<\/td>/si', $row, $match);
	$date = strip_tags($match[1][0]);
	$source = strip_tags($match[1][1]);
	$title = strip_tags($match[1][2]);
	preg_match('/href=\"(.*?)\"/si', $match[1][2], $match);
	$url = $match[1];
		$ar = array(
			"date"	=>	strtotime($date),
			"source"	=> $source,
			"title"	=>	$title,
			"url"	=>	$url
		);
		$options['entries'][] = $ar;
		update_option("pt_pressespiegel", $options);
}
*/
		
		$page = $_REQUEST['pt-pressespiegel-page'];
		if (!$page) $page = "home";
		
		if ($_POST['pt-pressespiegel-action'] == "entry-add") {
			
			$data_date = strtotime($_POST['pt-pressespiegel-date']);
			$data_title = htmlspecialchars(trim(stripslashes($_POST['pt-pressespiegel-title'])));
			$data_source = htmlspecialchars(trim(stripslashes($_POST['pt-pressespiegel-source'])));
			$data_url = trim($_POST['pt-pressespiegel-url']);
			
			
			if ($data_title == "") $error[] = "Titel";
			if ($data_source == "") $error[] = "Quelle";
			if (!$data_date) $error[] = "Datum";
			
			if (count($error) == 0) {
				$newar = array(
					"date"		=>		$data_date,
					"title"		=>		$data_title,
					"source"	=>		$data_source,
					"url"		=>		$data_url,
				);
				$options['entries'][] = $newar;
				update_option("pt_pressespiegel", $options);
				
				$success[] = "Eintrag hinzugefügt.";
			}
			$page = "home";
		}

		if ($_POST['pt-pressespiegel-action'] == "entry-del") {
			$data_id = $_POST['pt-pressespiegel-id'];
			if (!$options['entries'][$data_id]) $error[] = "Fehler";
			if (count($error) == 0) {
				unset($options['entries'][$data_id]);
				update_option("pt_pressespiegel", $options);
				
				$success[] = "Eintrag entfernt.";
			}
			$page = "home";
		}
		
		if ($_POST['pt-pressespiegel-action'] == "queue-add") {
					if ($_POST['pt-pressespiegel-queue-add']) {
					echo "ha";
						$data_id = $_POST['pt-pressespiegel-id'];
						if (!$options['queue'][$data_id]) $error[] = "Fehler";
						if (count($error) == 0) {
							$newar = $options['queue'][$data_id];
							$options['entries'][] = $newar;
							unset($options['queue'][$data_id]);
							update_option("pt_pressespiegel", $options);
							
							$success[] = "Eintrag hinzugefügt.";
						}
					
					} else if ($_POST['pt-pressespiegel-queue-del']) {
						$data_id = $_POST['pt-pressespiegel-id'];
						if (!$options['queue'][$data_id]) $error[] = "Fehler";
						if (count($error) == 0) {
							unset($options['queue'][$data_id]);
							update_option("pt_pressespiegel", $options);
							
							$success[] = "Eintrag entfernt.";
						}
					}
					$page = "queue";
		}
		
		if (count($success) > 0) {
			foreach ($success as $val) {
				?>
				<div class="hinweis updated">
				<?php echo $val; ?>
				</div>
				<?php
			}
		}
		if (count($error) > 0) {
			foreach ($error as $val) {
				?>
				<div class="hinweis error">
				<?php echo $val; ?>
				</div>
				<?php
			}
		}
		
		switch ($page) {
			default:
			case "home":
				include('admin/home.php');
				break;
			case "queue":
				include('admin/queue.php');
				break;
		}
	}

	
}

add_shortcode( "pt-pressespiegel", array("PT_pressespiegel", "shortcode"));
?>