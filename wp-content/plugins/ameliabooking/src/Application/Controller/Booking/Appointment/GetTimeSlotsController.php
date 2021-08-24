<?php

namespace AmeliaBooking\Application\Controller\Booking\Appointment;

use AmeliaBooking\Application\Commands\Booking\Appointment\GetTimeSlotsCommand;
use AmeliaBooking\Application\Controller\Controller;
use Slim\Http\Request;

/**
 * Class GetTimeSlotsController
 *
 * @package AmeliaBooking\Application\Controller\Booking\Appointment
 */
class GetTimeSlotsController extends Controller
{
    /**
     * Fields for calendar service that can be received from front-end
     *
     * @var array
     */
    protected $allowedFields = [
        'serviceId',
        'weekDays',
        'startDateTime',
        'providerIds',
        'extras',
        'excludeAppointmentId',
        'persons',
        'group',
        'page',
        'timeZone',
    ];

    /**
     * Instantiates the Get Time Slots command to hand it over to the Command Handler
     *
     * @param Request $request
     * @param         $args
     *
     * @return mixed
     * @throws \RuntimeException
     */
    protected function instantiateCommand(Request $request, $args)
    {
        $command = new GetTimeSlotsCommand($args);
        $command->setField('serviceId', (int)$request->getQueryParam('serviceId', 0));
        $command->setField('locationId', (int)$request->getQueryParam('locationId', 0));
        $command->setField('weekDays', (array)$request->getQueryParam('weekDays', [1, 2, 3, 4, 5, 6, 7]));
        $command->setField('startDateTime', (string)$request->getQueryParam('startDateTime', ''));
        $command->setField('endDateTime', (string)$request->getQueryParam('endDateTime', ''));
        $command->setField('providerIds', (array)$request->getQueryParam('providerIds', []));
        $command->setField('extras', (array)json_decode($request->getQueryParam('extras', []), true));
        $command->setField('excludeAppointmentId', (int)$request->getQueryParam('excludeAppointmentId', []));
        $command->setField('persons', (int)$request->getQueryParam('persons', 1));
        $command->setField('group', (int)$request->getQueryParam('group', 0));
        $command->setField('page', (string)$request->getQueryParam('page', ''));
        $command->setField('timeZone', (string)$request->getQueryParam('timeZone', ''));
        $requestBody = $request->getParsedBody();
        $this->setCommandFields($command, $requestBody);

        return $command;
    }
}
