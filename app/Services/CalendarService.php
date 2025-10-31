<?php

namespace App\Services;

use App\Repositories\CalendarRepository;

class CalendarService
{
    protected $repo;

    public function __construct(CalendarRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $calendar = $this->repo->find($id);
        return $this->repo->update($calendar, $data);
    }

    public function delete($id)
    {
        $calendar = $this->repo->find($id);
        $calendar->condition = 'ملغي';
        $calendar->save();
        return $this->repo->delete($calendar);
    }

    public function markDone($id)
    {
        $calendar = $this->repo->find($id);
        $calendar->condition = 'تم';
        return $calendar->save();
    }

    public function studentCalendar()
    {
        return $this->repo->getForStudents();
    }
}
