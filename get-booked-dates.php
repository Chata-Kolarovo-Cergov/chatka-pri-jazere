<?php
require_once 'ical/class.iCalReader.php';

// List of iCal URLs (add your Airbnb/Booking.com .ics links here)
$icalUrls = [
    'https://ical.booking.com/v1/export?t=4c166132-c8c5-409e-99ea-562f7bffbd0e',
    // Add more .ics links if you have them
];

$booked = [];
$debugInfo = [];

foreach ($icalUrls as $url) {
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
}

header('Content-Type: application/json');
echo json_encode(array_values(array_unique($booked)));
?>
