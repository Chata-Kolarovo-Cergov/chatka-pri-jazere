<?php
require_once 'ical/class.iCalReader.php';

// Google Calendar iCal URL
$icalUrls = [
    'https://calendar.google.com/calendar/ical/marekholic0%40gmail.com/public/basic.ics',
];

$booked = [];

foreach ($icalUrls as $url) {
    try {
        $ical = new ICal($url);
        foreach ($ical->events() as $event) {
            $start = date('Y-m-d', strtotime($event['DTSTART']));
            $end = date('Y-m-d', strtotime($event['DTEND']));
            // Mark each date in the range as booked
            $current = $start;
            while ($current < $end) {
                $booked[] = $current;
                $current = date('Y-m-d', strtotime("$current +1 day"));
            }
        }
    } catch (Exception $e) {
        // Ak nastane chyba, pokračujeme ďalej
        error_log("Error reading iCal: " . $e->getMessage());
    }
}

header('Content-Type: application/json');
echo json_encode(array_values(array_unique($booked)));
?>