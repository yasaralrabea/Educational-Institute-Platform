<?php

namespace App\Repositories;

use App\Models\Calendar;

class CalendarRepository
{
    public function all()
    {
        return Calendar::all();
    }

    public function find($id)
    {
        return Calendar::findOrFail($id);
    }

    public function create(array $data)
    {
        return Calendar::create($data);
    }

    public function update($calendar, array $data)
    {
        return $calendar->update($data);
    }

    public function delete($calendar)
    {
        return $calendar->delete();
    }

    public function getForStudents()
    {
        return Calendar::where('students','yes')->get();
    }
}
