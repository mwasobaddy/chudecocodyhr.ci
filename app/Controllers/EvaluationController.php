<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\AgentModel;

class EvaluationController extends Controller {
    protected $agentModel;
    protected $db;

    public function __construct() {
        $this->agentModel = new AgentModel();
        $this->db = \Config\Database::connect();
    }

    public function index() {
        $session = session();
        $agent_id = $session->get('idagent');
        $role = $this->determineRole($agent_id);

        $data = [
            'role' => $role,
            'evaluations' => $this->getEvaluationsForAgent($agent_id, $role)
        ];

        return view('evaluation/index', $data);
    }

    public function startEvaluation() {
        $session = session();
        $employee_id = $session->get('idagent');
        
        $agent = $this->agentModel->find($employee_id);
        
        $data = [
            'employee_id' => $employee_id,
            'line_manager_n1_id' => $agent['Responsablen1'],
            'line_manager_n2_id' => $agent['Responsablen2'],
            'status' => 'Started',
            'started_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('evaluations')->insert($data);
        return redirect()->to('/evaluation');
    }

    public function submitObjectives() {
        $session = session();
        $evaluation_id = $this->request->getPost('evaluation_id');
        $objectives = $this->request->getPost('objectives');

        // Validate total weight = 100%
        $total_weight = 0;
        foreach ($objectives as $objective) {
            $total_weight += floatval($objective['weight']);
        }

        if ($total_weight != 100) {
            return redirect()->back()->with('error', 'Total weight must equal 100%');
        }

        // Insert objectives
        foreach ($objectives as $objective) {
            $this->db->table('objectives')->insert([
                'evaluation_id' => $evaluation_id,
                'title' => $objective['title'],
                'description' => $objective['description'],
                'specific_goals' => $objective['specific_goals'],
                'key_actions' => $objective['key_actions'],
                'resources_required' => $objective['resources_required'],
                'start_date' => $objective['start_date'],
                'end_date' => $objective['end_date'],
                'success_metrics' => $objective['success_metrics'],
                'potential_challenges' => $objective['potential_challenges'],
                'support_needed' => $objective['support_needed'],
                'weight' => $objective['weight']
            ]);
        }

        return redirect()->to('/evaluation');
    }

    public function submitAgreement() {
        $objective_id = $this->request->getPost('objective_id');
        $agreement = $this->request->getPost('agreement');
        $comments = $this->request->getPost('employee_comments');

        $this->db->table('objectives')
            ->where('idobjective', $objective_id)
            ->update([
                'agreement' => $agreement,
                'employee_comments' => $comments
            ]);

        return redirect()->back();
    }

    public function signOff() {
        $session = session();
        $evaluation_id = $this->request->getPost('evaluation_id');
        $agent_id = $session->get('idagent');

        $this->db->table('sign_offs')->insert([
            'evaluation_id' => $evaluation_id,
            'agent_id' => $agent_id
        ]);

        // Check if all required signatures are present
        $this->checkAndUpdateStatus($evaluation_id);

        return redirect()->to('/evaluation');
    }

    private function determineRole($agent_id) {
        // Check if agent is a line manager
        $hasSubordinates = $this->db->table('agent')
            ->where('Responsablen1', $agent_id)
            ->orWhere('Responsablen2', $agent_id)
            ->countAllResults();

        return $hasSubordinates > 0 ? 'line_manager' : 'employee';
    }

    private function getEvaluationsForAgent($agent_id, $role) {
        if ($role === 'line_manager') {
            return $this->db->table('evaluations')
                ->where('line_manager_n1_id', $agent_id)
                ->orWhere('line_manager_n2_id', $agent_id)
                ->get()->getResultArray();
        }

        return $this->db->table('evaluations')
            ->where('employee_id', $agent_id)
            ->get()->getResultArray();
    }

    private function checkAndUpdateStatus($evaluation_id) {
        $evaluation = $this->db->table('evaluations')
            ->where('idevaluation', $evaluation_id)
            ->get()->getRowArray();

        $required_signatures = 2; // Employee and Line Manager N+1
        if ($evaluation['line_manager_n2_id']) {
            $required_signatures = 3; // Include Line Manager N+2
        }

        $signatures = $this->db->table('sign_offs')
            ->where('evaluation_id', $evaluation_id)
            ->countAllResults();

        if ($signatures >= $required_signatures) {
            $this->db->table('evaluations')
                ->where('idevaluation', $evaluation_id)
                ->update([
                    'status' => 'Completed',
                    'completed_at' => date('Y-m-d H:i:s')
                ]);
        }
    }
}