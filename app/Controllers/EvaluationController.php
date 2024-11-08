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

    
    public function signOff($evaluation_id)
    {
        $session = session();
        $agent_id = $session->get('cnxid');
        $userAccess = $session->get('idd');
    
        $evaluation = $this->getEvaluation($evaluation_id);
        $signOff = $this->db->table('sign_offs')
            ->where('evaluation_id', $evaluation_id)
            ->get()
            ->getRowArray();
    
        $data = [
            'evaluation' => $evaluation,
            'signOff' => $signOff,
        ];
    
        if ($userAccess == 1) {
            echo view('templates/espaceagent/entete', $data);
            echo view('templates/espaceagent/sidebar', $data);
            echo view('templates/espaceagent/topbar', $data);
            echo view('templates/espaceagent/sign_off', $data);
            echo view('templates/espaceagent/pied', $data);
        } elseif ($userAccess == 2) {
            echo view('templates/espacerespo/entete', $data);
            echo view('templates/espacerespo/sidebar', $data);
            echo view('templates/espacerespo/topbar', $data);
            echo view('templates/espacerespo/sign_off', $data);
            echo view('templates/espacerespo/pied', $data);
        }
    }
    
    public function submitSignOff()
    {
        $session = session();
        $agent_id = $session->get('cnxid');
        $userAccess = $session->get('idd'); // 1: Employee, 2: Line Manager
        $fullName = $session->get('nom') . ' ' . $session->get('prenoms');
    
        $evaluation_id = $this->request->getPost('evaluation_id');
    
        // Fetch the evaluation
        $evaluation = $this->getEvaluation($evaluation_id);
    
        if (!$evaluation) {
            return redirect()->back()->with('error', 'Evaluation not found.');
        }
    
        // Ensure correct user
        if (($userAccess == 1 && $evaluation['employee_id'] != $agent_id) ||
            ($userAccess == 2 && $evaluation['line_manager_n1_id'] != $agent_id)) {
            return redirect()->back()->with('error', 'Access denied.');
        }
    
        // Fetch existing sign-off record
        $signOff = $this->db->table('sign_offs')
            ->where('evaluation_id', $evaluation_id)
            ->get()
            ->getRowArray();
    
        $data = [];
    
        // Update sign-off status based on user role
        if ($userAccess == 1) { // Employee
            if ($signOff && $signOff['employee_signed']) {
                return redirect()->back()->with('error', 'You have already signed off.');
            }
    
            $data['employee_signed'] = 1;
            $data['employee_signed_at'] = date('Y-m-d H:i:s');
            $data['employee_signature'] = $fullName;
        } elseif ($userAccess == 2) { // Line Manager
            if ($signOff && $signOff['manager_signed']) {
                return redirect()->back()->with('error', 'You have already signed off.');
            }
    
            $data['manager_signed'] = 1;
            $data['manager_signed_at'] = date('Y-m-d H:i:s');
            $data['manager_signature'] = $fullName;
        } else {
            return redirect()->back()->with('error', 'Invalid user role.');
        }
    
        // Update or insert sign-off record
        if ($signOff) {
            $this->db->table('sign_offs')
                ->where('id', $signOff['id'])
                ->update($data);
        } else {
            $data['evaluation_id'] = $evaluation_id;
            $this->db->table('sign_offs')->insert($data);
        }
    
        // Check if both parties have signed
        $updatedSignOff = $this->db->table('sign_offs')
            ->where('evaluation_id', $evaluation_id)
            ->get()
            ->getRowArray();
    
        if ($updatedSignOff['employee_signed'] && $updatedSignOff['manager_signed']) {
            // Update evaluation status to 'Completed' and set completed_at
            $this->db->table('evaluations')
                ->where('idevaluation', $evaluation_id)
                ->update([
                    'status' => 'Completed',
                    'completed_at' => date('Y-m-d H:i:s'),
                ]);
        }
    
        return redirect()->back()->with('success', 'Sign-off completed successfully.');
    }

    private function determineRole($agent_id) {
        // Check if agent is a line manager
        $hasSubordinates = $this->db->table('agent')
            ->where('Responsablen1', $agent_id)
            ->orWhere('Responsablen2', $agent_id)
            ->countAllResults();

        return $hasSubordinates > 0 ? 'line_manager' : 'employee';
    }
    private function getEvaluation($evaluation_id) 
{
    try {
        return $this->db->table('evaluations')
            ->select('evaluations.*, 
                     e.nom as employee_name,
                     m1.nom as manager_n1_name,
                     m2.nom as manager_n2_name')
            ->join('agent e', 'e.idagent = evaluations.employee_id')
            ->join('agent m1', 'm1.idagent = evaluations.line_manager_n1_id')
            ->join('agent m2', 'm2.idagent = evaluations.line_manager_n2_id', 'left')
            ->where('evaluations.idevaluation', $evaluation_id)
            ->get()
            ->getRowArray();
    } catch (\Exception $e) {
        log_message('error', 'Error getting evaluation: ' . $e->getMessage());
        return null;
    }
}

private function mapPercentageToScore($percentage) 
{
    if (!is_numeric($percentage)) {
        log_message('error', 'Invalid percentage value provided: ' . $percentage);
        return null;
    }

    // Map percentage ranges to evaluation scores
    if ($percentage >= 100) return 5.0;
    if ($percentage >= 90) return 4.5;
    if ($percentage >= 70) return 4.0;
    if ($percentage >= 61) return 3.5;
    if ($percentage >= 50) return 3.0;
    if ($percentage >= 41) return 2.5;
    if ($percentage >= 31) return 2.0;
    if ($percentage >= 26) return 1.5;
    if ($percentage >= 5)  return 1.0;
    return 0.0;
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
    // public function selfAppraisal($evaluation_id)
    // {
    //     $session = session();
    //     $agent_id = $session->get('cnxid');
    //     $userAccess = $session->get('idd');

    //     if ($userAccess != 1) { // Ensure it's the employee
    //         return redirect()->back()->with('error', 'Access denied.');
    //     }

    //     $evaluation = $this->getEvaluation($evaluation_id);

    //     if (!$evaluation || $evaluation['employee_id'] != $agent_id) {
    //         return redirect()->back()->with('error', 'Evaluation not found.');
    //     }

    //     $objectives = $this->getObjectives($evaluation_id);

    //     // Fetch existing self-appraisals
    //     $selfAppraisals = $this->db->table('self_appraisals')
    //         ->where('evaluation_id', $evaluation_id)
    //         ->get()
    //         ->getResultArray();

    //     // Map self-appraisals by objective_id for easy access
    //     $selfAppraisalsByObjective = [];
    //     foreach ($selfAppraisals as $selfAppraisal) {
    //         $selfAppraisalsByObjective[$selfAppraisal['objective_id']] = $selfAppraisal;
    //     }

    //     $data = [
    //         'evaluation' => $evaluation,
    //         'objectives' => $objectives,
    //         'selfAppraisals' => $selfAppraisalsByObjective,
    //     ];

    //     // Load views
    //     echo view('templates/espaceagent/entete', $data);
    //     echo view('templates/espaceagent/sidebar', $data);
    //     echo view('templates/espaceagent/topbar', $data);
    //     echo view('templates/espaceagent/self_appraisal', $data);
    //     echo view('templates/espaceagent/pied', $data);
    // }
    
public function selfAppraisal($evaluation_id = null)
{
    if (!$evaluation_id) {
        return redirect()->back()->with('error', 'No evaluation ID provided');
    }

    try {
        $evaluation = $this->getEvaluation($evaluation_id);
        if (!$evaluation) {
            return redirect()->back()->with('error', 'Evaluation not found');
        }

        $data = [
            'evaluation' => $evaluation,
            'current_evaluation_id' => $evaluation_id
        ];

        echo view('templates/espaceagent/entete', $data);
        echo view('templates/espaceagent/sidebar', $data);
        echo view('templates/espaceagent/topbar', $data);
        echo view('templates/espaceagent/evaluation', $data);
        echo view('templates/espaceagent/pied', $data);

    } catch (\Exception $e) {
        log_message('error', 'Error in selfAppraisal: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred');
    }
}
public function submitSelfAppraisal()
{
    $session = session();
    $agent_id = $session->get('cnxid');
    $userAccess = $session->get('idd');

    if ($userAccess != 1) { // Ensure it's the employee
        return redirect()->back()->with('error', 'Access denied.');
    }

    $evaluation_id = $this->request->getPost('evaluation_id');
    $evaluation = $this->getEvaluation($evaluation_id);

    if (!$evaluation || $evaluation['employee_id'] != $agent_id) {
        return redirect()->back()->with('error', 'Invalid evaluation.');
    }

    $objective_ids = $this->request->getPost('objective_ids');
    $self_scores = $this->request->getPost('self_scores');
    $comments = $this->request->getPost('comments');
    $action = $this->request->getPost('action');

    foreach ($objective_ids as $index => $objective_id) {
        $data = [
            'evaluation_id' => $evaluation_id,
            'objective_id' => $objective_id,
            'self_score' => $self_scores[$index],
            'comments' => $comments[$index],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Check if self-appraisal exists
        $existing = $this->db->table('self_appraisals')
            ->where('evaluation_id', $evaluation_id)
            ->where('objective_id', $objective_id)
            ->get()
            ->getRowArray();

        if ($existing) {
            $this->db->table('self_appraisals')
                ->where('id', $existing['id'])
                ->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('self_appraisals')->insert($data);
        }
    }

    // Handle action: Save, Save and Share, Recall
    $is_shared = ($action == 'Save and Share') ? 1 : 0;

    $this->db->table('self_appraisals')
        ->where('evaluation_id', $evaluation_id)
        ->update(['is_shared' => $is_shared]);

    $message = 'Self-appraisal ' . ($is_shared ? 'shared' : 'saved') . ' successfully.';

    return redirect()->to('/espaceagent/evaluation/self-appraisal/' . $evaluation_id)
        ->with('success', $message);
}

public function objectiveEvaluation($evaluation_id)
{
    $session = session();
    $agent_id = $session->get('cnxid');
    $userAccess = $session->get('idd');

    if ($userAccess != 2) { // Ensure it's the Line Manager N+1
        return redirect()->back()->with('error', 'Access denied.');
    }

    $evaluation = $this->getEvaluation($evaluation_id);

    if (!$evaluation || $evaluation['line_manager_n1_id'] != $agent_id) {
        return redirect()->back()->with('error', 'Evaluation not found.');
    }

    $objectives = $this->getObjectives($evaluation_id);

    // Fetch existing objective evaluations
    $objectiveEvaluations = $this->db->table('objective_evaluations')
        ->where('evaluation_id', $evaluation_id)
        ->get()
        ->getResultArray();

    // Map evaluations by objective_id
    $evaluationsByObjective = [];
    foreach ($objectiveEvaluations as $evaluation) {
        $evaluationsByObjective[$evaluation['objective_id']] = $evaluation;
    }

    $data = [
        'evaluation' => $evaluation,
        'objectives' => $objectives,
        'objectiveEvaluations' => $evaluationsByObjective,
    ];

    // Load views
    echo view('templates/espacerespo/entete', $data);
    echo view('templates/espacerespo/sidebar', $data);
    echo view('templates/espacerespo/topbar', $data);
    echo view('templates/espacerespo/objective_evaluation', $data);
    echo view('templates/espacerespo/pied', $data);
}

public function submitObjectiveEvaluation()
{
    $session = session();
    $agent_id = $session->get('cnxid');
    $userAccess = $session->get('idd');

    if ($userAccess != 2) { // Ensure it's the Line Manager N+1
        return redirect()->back()->with('error', 'Access denied.');
    }

    $evaluation_id = $this->request->getPost('evaluation_id');
    $evaluation = $this->getEvaluation($evaluation_id);

    if (!$evaluation || $evaluation['line_manager_n1_id'] != $agent_id) {
        return redirect()->back()->with('error', 'Invalid evaluation.');
    }

    $objective_ids = $this->request->getPost('objective_ids');
    $manager_scores = $this->request->getPost('manager_scores');
    $comments = $this->request->getPost('comments');
    $action = $this->request->getPost('action');

    foreach ($objective_ids as $index => $objective_id) {
        $data = [
            'evaluation_id' => $evaluation_id,
            'objective_id' => $objective_id,
            'manager_score' => $manager_scores[$index],
            'comments' => $comments[$index],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Check if evaluation exists
        $existing = $this->db->table('objective_evaluations')
            ->where('evaluation_id', $evaluation_id)
            ->where('objective_id', $objective_id)
            ->get()
            ->getRowArray();

        if ($existing) {
            $this->db->table('objective_evaluations')
                ->where('id', $existing['id'])
                ->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('objective_evaluations')->insert($data);
        }
    }

    // Handle action: Save, Save and Share, Recall
    $is_shared = ($action == 'Save and Share') ? 1 : 0;

    $this->db->table('objective_evaluations')
        ->where('evaluation_id', $evaluation_id)
        ->update(['is_shared' => $is_shared]);

    // Calculate evaluation score
    $this->calculateEvaluationScore($evaluation_id);

    $message = 'Objective evaluation ' . ($is_shared ? 'shared' : 'saved') . ' successfully.';

    return redirect()->to('/espacerespo/evaluation/objective-evaluation/' . $evaluation_id)
        ->with('success', $message);
}

private function calculateEvaluationScore($evaluation_id)
{
    $scores = $this->db->table('objective_evaluations')
        ->select('manager_score')
        ->where('evaluation_id', $evaluation_id)
        ->get()
        ->getResultArray();

    $total_weight = $this->db->table('objectives')
        ->selectSum('weight')
        ->where('evaluation_id', $evaluation_id)
        ->get()
        ->getRow()->weight;

    $total_score = 0;
    $total_objectives = count($scores);

    if ($total_objectives == 0 || $total_weight == 0) {
        return;
    }

    foreach ($scores as $score) {
        $total_score += $score['manager_score'];
    }

    // Calculate the average percentage
    $average_percentage = ($total_score / $total_weight) * 100;

    // Map average percentage to evaluation score
    $evaluation_score = $this->mapPercentageToScore($average_percentage);

    // Update evaluations table
    $this->db->table('evaluations')
        ->where('idevaluation', $evaluation_id)
        ->update([
            'evaluation_score' => $evaluation_score,
            // Update status if necessary
            // 'status' => 'Ready to be signed off', // Use appropriate status
        ]);
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