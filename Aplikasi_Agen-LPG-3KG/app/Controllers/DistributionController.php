<?php

namespace App\Controllers;

use App\Models\DistributionModel;
use App\Models\UsersModels;

class DistributionController extends BaseController
{
    protected $distributionModel;
    protected $usersModel;

    public function __construct()
    {
        $this->distributionModel = new DistributionModel();
        $this->usersModel = new UsersModels();
    }

    public function index()
    {
        $data['distributions'] = $this->distributionModel->findAll();
        return view('distribution/index', $data);
    }

    public function plan()
    {
        $data['users'] = $this->usersModel->findAll();
        return view('distribution/plan', $data);
    }

    public function createPlan()
    {
        $this->distributionModel->save([
            'base_id' => $this->request->getPost('base_id'),
            'lpg_amount' => $this->request->getPost('lpg_amount'),
            'distribution_date' => $this->request->getPost('distribution_date'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/distribution');
    }

    public function editPlan($id)
    {
        $data['distribution'] = $this->distributionModel->find($id);
        $data['users'] = $this->usersModel->findAll();
        return view('distribution/plan', $data);
    }

    public function updatePlan($id)
    {
        $this->distributionModel->update($id, [
            'base_id' => $this->request->getPost('base_id'),
            'lpg_amount' => $this->request->getPost('lpg_amount'),
            'distribution_date' => $this->request->getPost('distribution_date'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/distribution');
    }

    public function deletePlan($id)
    {
        $this->distributionModel->delete($id);
        return redirect()->to('/distribution');
    }
}