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
        $agent_id = $session->get('cnxid');
        $userAccess = $session->get('idd');
        
        // Debugging statements
        echo "<script>console.log('Agent ID: " . $agent_id . "');</script>";
        echo "<script>console.log('User Access: " . $userAccess . "');</script>";
    
        // Get current evaluation data
        $current_evaluation = $this->getCurrentEvaluation($agent_id);
        $objectives = [];
        if ($current_evaluation) {
            $objectives = $this->getObjectives($current_evaluation['idevaluation']);
        }
        // Prepare common data
        $data = [
            'agent_id' => $agent_id,
        ];
    
        // Route to appropriate view based on user access level
        if ($userAccess == 1) { // Employee
            if($this->db){
                echo "<script>console.log('Database connected');</script>";
            }
            $data['current_evaluation'] = $this->getCurrentEvaluation($agent_id);

            if ($data['current_evaluation']) {
                $data['objectives'] = $this->getObjectives($data['current_evaluation']['idevaluation']);
            }
            echo view('templates/espaceagent/entete', $data);
            echo view('templates/espaceagent/sidebar', $data);
            echo view('templates/espaceagent/topbar', $data);
            echo view('templates/espaceagent/evaluation', $data);
            echo view('templates/espaceagent/pied', $data);
        } 
        elseif ($userAccess == 2) { // Line Manager
            $data['pending_evaluations'] = $this->getPendingEvaluations($agent_id);
            $data['completed_evaluations'] = $this->getCompletedEvaluations($agent_id);
            echo view('templates/espacerespo/entete', $data);
            echo view('templates/espacerespo/sidebar', $data);
            echo view('templates/espacerespo/topbar', $data);
            echo view('templates/espacerespo/evaluation', $data);
            echo view('templates/espacerespo/pied', $data);
        } 
        else { // Admin
            $data['evaluations'] = $this->getAllEvaluations();
            echo view('templates/espaceadmin/entete', $data);
            echo view('templates/espaceadmin/sidebar', $data);
            echo view('templates/espaceadmin/topbar', $data);
            echo view('templates/espaceadmin/evaluation', $data);
            echo view('templates/espaceadmin/pied', $data);            
        }
    }

    public function setObjectives($evaluation_id)
{
    $session = session();
    $agent_id = $session->get('cnxid');
    $userAccess = $session->get('idd');

    if ($userAccess != 2) {
        return redirect()->back()->with('error', 'Access denied.');
    }

    $evaluation = $this->db->table('evaluations')
        ->select('evaluations.*, agent.nom as employee_name')
        ->join('agent', 'agent.idagent = evaluations.employee_id')
        ->where('idevaluation', $evaluation_id)
        ->get()
        ->getRowArray();

    if (!$evaluation) {
        return redirect()->back()->with('error', 'Evaluation not found.');
    }

    $data = [
        'evaluation' => $evaluation,
        'agent_id' => $agent_id,
    ];

    echo view('templates/espacerespo/entete', $data);
    echo view('templates/espacerespo/sidebar', $data);
    echo view('templates/espacerespo/topbar', $data);
    echo view('templates/espacerespo/set_objectives', $data);
    echo view('templates/espacerespo/pied', $data);
}

    private function getAllEvaluations() {
        return $this->db->table('evaluations')
            ->select('evaluations.*, 
                     e.nom as employee_name,
                     m1.nom as manager_n1_name,
                     m2.nom as manager_n2_name')
            ->join('agent e', 'e.idagent = evaluations.employee_id')
            ->join('agent m1', 'm1.idagent = evaluations.line_manager_n1_id')
            ->join('agent m2', 'm2.idagent = evaluations.line_manager_n2_id', 'left')
            ->get()
            ->getResultArray();
    }

    private function getPendingEvaluations($manager_id) {
        return $this->db->table('evaluations')
            ->select('evaluations.*, agent.nom as employee_name')
            ->join('agent', 'agent.idagent = evaluations.employee_id')
            ->where('line_manager_n1_id', $manager_id)
            ->where('status', 'Started')
            ->get()
            ->getResultArray();
    }

    private function getCompletedEvaluations($manager_id) {
        return $this->db->table('evaluations')
            ->select('evaluations.*, agent.nom as employee_name')
            ->join('agent', 'agent.idagent = evaluations.employee_id')
            ->where('line_manager_n1_id', $manager_id)
            ->where('status', 'Completed')
            ->get()
            ->getResultArray();
    }

    private function getCurrentEvaluation($employee_id) {
        return $this->db->table('evaluations')
            ->where('employee_id', $employee_id)
            ->orderBy('started_at', 'DESC')
            ->get()
            ->getRowArray();
    }

    private function getObjectives($evaluation_id) {
        if (!$evaluation_id) return [];
        
        return $this->db->table('objectives')
            ->where('evaluation_id', $evaluation_id)
            ->get()
            ->getResultArray();
    }


    public function startEvaluation() {
        $session = session();
        $employee_id = $session->get('cnxid');
        
        $agent = $this->agentModel->find($employee_id);
        
        $data = [
            'employee_id' => $employee_id,
            'line_manager_n1_id' => $agent['Responsablen1'],
            'line_manager_n2_id' => $agent['Responsablen2'],
            'status' => 'Started',
            'started_at' => date('Y-m-d H:i:s')
        ];

        $this->db->table('evaluations')->insert($data);
        return redirect()->to('/espaceagent/evaluation');
    }

    public function submitObjectives() {
        $evaluation_id = $this->request->getPost('evaluation_id');
        $objectives = $this->request->getPost('objectives');
    
        // Validate total weight
        $total_weight = 0;
        foreach ($objectives as $objective) {
            $total_weight += floatval($objective['weight']);
        }
    
        if ($total_weight != 100) {
            return redirect()->back()->with('error', 'Total weight must equal 100%');
        }
    
        // Insert objectives
        foreach ($objectives as $objective) {
            $insertData = [
                'evaluation_id' => $evaluation_id,
                'title' => $objective['title'],
                'description' => $objective['description'],
                'specific_goals' => $objective['specific_goals'] ?? null,
                'key_actions' => $objective['key_actions'] ?? null,
                'resources_required' => $objective['resources_required'] ?? null,
                'start_date' => $objective['start_date'],
                'end_date' => $objective['end_date'],
                'success_metrics' => $objective['success_metrics'] ?? null,
                'potential_challenges' => $objective['potential_challenges'] ?? null,
                'support_needed' => $objective['support_needed'] ?? null,
                'weight' => $objective['weight']
            ];
    
            $this->db->table('objectives')->insert($insertData);
        }
    
        return redirect()->to('/espacerespo/evaluation')->with('success', 'Objectives saved successfully.');
    }

    public function agreeObjective()
{
    $objective_id = $this->request->getPost('objective_id');
    $agreement = $this->request->getPost('agreement');
    $comments = $this->request->getPost('comments');

    // Update the objective with the employee's agreement and comments
    $this->db->table('objectives')
        ->where('idobjective', $objective_id)
        ->update([
            'agreement' => $agreement,
            'employee_comments' => $comments
        ]);

    return redirect()->back()->with('success', 'Your response has been saved.');
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