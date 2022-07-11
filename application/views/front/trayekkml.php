<?php
header('Content-type: application/vnd.google-earth.kml+xml kml');
header('Content-Disposition: attachment; filename="phpsql_genkml.kml"');
// Creates an array of strings to hold the lines of the KML file.
$kml = array('<?xml version="1.0" encoding="UTF-8"?>');
$kml[] = '<kml xmlns="http://earth.google.com/kml/2.1">';
$kml[] = '  <Document>';
$kml[] = '      <name>Chicago Transit Map</name>';
$kml[] = '      <description>Chicago Transit Authority train lines</description>';
$kml[] = '';
$kml[] = '  <Style id="blueLine">';
$kml[] = '      <LineStyle>';
$kml[] = '          <color>ffff0000</color>';
$kml[] = '          <width>4</width>';
$kml[] = '      </LineStyle>';
$kml[] = '  </Style>';
$kml[] = '';

// Iterates through the rows, printing a node for each row.
foreach ($view as $row) {
      $kml[] = '  <Placemark>';
      $kml[] = '        <name>'.$row->nama_trayek.'</name>';
      $kml[] = '        <styleUrl>#blueLine</styleUrl>';
      $kml[] = '        <LineString>';
      $kml[] = '            <altitudeMode>relative</altitudeMode>';
      $kml[] = '            <coordinates>
      '.$row->koordinat.'';
      $kml[] = '            </coordinates>';
      $kml[] = '        </LineString>';
      $kml[] = '  </Placemark>';
}
  

// End XML file
$kml[] = '';
$kml[] = '  </Document>';
$kml[] = '</kml>';
$kmlOutput = join("\n", $kml);
echo $kmlOutput;
?>