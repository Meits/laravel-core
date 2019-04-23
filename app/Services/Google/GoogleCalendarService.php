<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 16-Nov-18
 * Time: 11:41
 */

namespace App\Srvices\Google;


use App\Models\FreeSessionApplication;
use Google;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarService
{

    public static function handleAddToCalendar(FreeSessionApplication $application)
    {

        $client = Google::getClient();
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        $service = Google::make('Calendar');
        $event = new Google_Service_Calendar_Event(array(
            'summary' => 'Free session',
            //'location' => 'location',
            'description' => $application->email. " ". $application->phone,
            'start' => array(
                'dateTime' => $application->date_free_session->format('Y-m-d')."T".$application->date_free_session->format('H:i:s'),
                'timeZone' => $application->city,
            ),
            'end' => array(
                'dateTime' => $application->date_free_session->format('Y-m-d')."T".$application->date_free_session->addHour()->format('H:i:s'),
                'timeZone' => $application->city,
            )
        ));

        $calendarId = 'rani@ranimaree.com';
        $event = $service->events->insert($calendarId, $event);

        return true;
    }
}