<?php

namespace App\Repositories;

use App\Models\Fin;
use App\Models\Budget;

class FinRepository
{
    public function all($filters = [])
    {
        $query = Fin::query();

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['from'])) {
            $query->whereDate('date', '>=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $query->whereDate('date', '<=', $filters['to']);
        }

        return $query->orderBy('date', 'desc')->get();
    }

    public function find($id)
    {
        return Fin::findOrFail($id);
    }

    public function create(array $data)
    {
        return Fin::create($data);
    }

    public function update(Fin $fin, array $data)
    {
        return $fin->update($data);
    }

    public function delete(Fin $fin)
    {
        return $fin->delete();
    }

    public function getBudget()
    {
        return Budget::first();
    }

    public function updateBudget($amount)
    {
        $budget = $this->getBudget();
        $budget->budget = $amount;
        $budget->save();
        return $budget;
    }
}
