<?php

namespace App\Services;

use App\Repositories\FinRepository;

class FinService
{
    protected $repo;

    public function __construct(FinRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listFins($filters = [])
    {
        $fins = $this->repo->all($filters);
        $budget = $this->repo->getBudget();

        $income = $fins->where('type', 'income')->sum('amount');
        $expense = $fins->where('type', 'expense')->sum('amount');

        return compact('fins', 'budget', 'income', 'expense');
    }

    public function createFin(array $data)
    {
        $fin = $this->repo->create($data);
        $budget = $this->repo->getBudget();

        if ($fin->type == 'income') {
            $budget->budget += $fin->amount;
        } elseif ($fin->type == 'expense') {
            $budget->budget -= $fin->amount;
        }

        $budget->save();
        return $fin;
    }

    public function updateFin($fin, array $data)
    {
        $budget = $this->repo->getBudget();

        $oldAmount = $fin->getOriginal('amount');
        $oldType = $fin->getOriginal('type');

        $this->repo->update($fin, $data);

        // تعديل الميزانية حسب التغير
        if ($oldType == 'income') {
            $budget->budget -= $oldAmount;
        } elseif ($oldType == 'expense') {
            $budget->budget += $oldAmount;
        }

        if ($fin->type == 'income') {
            $budget->budget += $fin->amount;
        } elseif ($fin->type == 'expense') {
            $budget->budget -= $fin->amount;
        }

        $budget->save();
        return $fin;
    }

    public function deleteFin($fin)
    {
        $budget = $this->repo->getBudget();

        if ($fin->type == 'income') {
            $budget->budget -= $fin->amount;
        } elseif ($fin->type == 'expense') {
            $budget->budget += $fin->amount;
        }

        $budget->save();
        $this->repo->delete($fin);
    }

    public function updateBudget($amount)
    {
        return $this->repo->updateBudget($amount);
    }
}
