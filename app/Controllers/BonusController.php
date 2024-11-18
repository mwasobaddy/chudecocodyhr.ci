<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BonusController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Admin: Configure Bonus Settings
     */
    public function configure()
{
    $session = session();
    $agent_id = $session->get('cnxid');
    $userAccess = $session->get('idd');
    
    // Fetch all bonus configurations
    $builder = $this->db->table('bonus_configurations');
    $query = $builder->get();
    $bonusConfigurations = $query->getResultArray();

    $employeeBuilder = $this->db->table('agent');
    $employees = $employeeBuilder
        ->orderBy('TRIM(nom)', 'ASC') 
        ->get()
        ->getResultArray();

    $data = [
        'bonusConfigurations' => $bonusConfigurations,
        'employees' => $employees,
    ];

    // Fetch eligible evaluations
    $evaluations = [];
    foreach ($employees as $employee) {
        // Get the bonus configuration for the employee
        $configBuilder = $this->db->table('bonus_configurations');
        $config = $configBuilder->where('employee_id', $employee['matricule'])->get()->getRowArray();

        if ($config) {
            // Get the employee's evaluation
            $evalBuilder = $this->db->table('evaluations');
            $evaluation = $evalBuilder->where('employee_id', $employee['matricule'])->get()->getRowArray();

            if ($evaluation && $evaluation['evaluation_score'] >= $config['evaluation_score_threshold']) {
                // Calculate bonus
                $bonusAmount = $employee['salary'] * ($config['bonus_percentage'] / 100);

                $evaluations[] = [
                    'employee_number'    => $employee['matricule'],
                    'full_name'          => $employee['nom'],
                    'grade'              => $employee['grade'],
                    'evaluation_score'   => $evaluation['evaluation_score'],
                    'bonus_percentage'   => $config['bonus_percentage'],
                    'bonus_to_be_paid'   => $bonusAmount,
                ];
            }
        }
    }

    $data['evaluations'] = $evaluations;

    // Load views with $data
    echo view('templates/espaceadmin/entete', $data);
    echo view('templates/espaceadmin/sidebar', $data);
    echo view('templates/espaceadmin/topbar', $data);
    echo view('templates/espaceadmin/bonus_configuration', $data);
    echo view('templates/espaceadmin/pied', $data);
}

    /**
     * Admin: Save Bonus Configuration
     */
    public function saveConfiguration()
    {
        $employeeId = $this->request->getPost('employee_id');
        $bonusPercentage = $this->request->getPost('bonus_percentage');
        $evaluationPeriod = $this->request->getPost('evaluation_period');
        $evaluationScoreThreshold = $this->request->getPost('evaluation_score_threshold');
    
        $data = [
            'employee_id' => $employeeId,
            'bonus_percentage' => $bonusPercentage,
            'evaluation_period' => $evaluationPeriod,
            'evaluation_score_threshold' => $evaluationScoreThreshold
        ];
    
        // Insert or update configuration for the employee
        $builder = $this->db->table('bonus_configurations');
        $existingConfig = $builder->where('employee_id', $employeeId)->get()->getRow();
    
        if ($existingConfig) {
            $builder->where('employee_id', $employeeId)->update($data);
        } else {
            $builder->insert($data);
        }
    
        return redirect()->back()->with('success', 'La configuration du bonus a été sauvegardée avec succès.');
    }

    /**
     * Admin: View Bonus Report
     */
    public function report()
    {
        // Get the latest bonus configuration
        $builder = $this->db->table('bonus_configurations');
        $builder->orderBy('created_at', 'DESC');
        $latestConfigQuery = $builder->get(1);
        $config = $latestConfigQuery->getRowArray();

        if (!$config) {
            // No configuration found
            $data = [
                'evaluations' => [],
                'bonusPercentage' => null,
                'evaluationPeriod' => null
            ];
        } else {
            $evaluationPeriod = $config['evaluation_period'];
            $bonusPercentage = $config['bonus_percentage'];
            $evaluationScoreThreshold = $config['evaluation_score_threshold'];

            // Determine the date range based on evaluation period
            $currentDate = new \DateTime();
            switch ($evaluationPeriod) {
                case '3 months':
                    $startDate = $currentDate->modify('-3 months')->format('Y-m-d H:i:s');
                    break;
                case '6 months':
                    $startDate = $currentDate->modify('-6 months')->format('Y-m-d H:i:s');
                    break;
                case '12 months':
                    $startDate = $currentDate->modify('-12 months')->format('Y-m-d H:i:s');
                    break;
                default:
                    $startDate = null;
                    break;
            }

            if ($startDate) {
                $builder = $this->db->table('evaluations');
                $builder->select('evaluations.*, agent.matricule, agent.nom, agent.IDgrade as grade');
                $builder->join('agent', 'evaluations.employee_id = agent.idagent');
                $builder->where('evaluations.completed_at >=', $startDate); // Use 'completed_at'
                $builder->where('evaluations.evaluation_score >=', $evaluationScoreThreshold); // Use 'evaluation_score'
                $evaluationsQuery = $builder->get();
                $evaluations = $evaluationsQuery->getResultArray();
                log_message('debug', 'Start Date: ' . $startDate);
                log_message('debug', 'Number of evaluations found: ' . count($evaluations));
            } else {
                $evaluations = [];
            }

            foreach ($evaluations as &$evaluation) {
                // Calculate bonus amount
                $evaluation['bonus_to_be_paid'] = round($evaluation['evaluation_score'] * $bonusPercentage / 100, 2); // Use 'evaluation_score'

                // Check if bonus already exists
                $bonusExists = $this->db->table('bonuses')
                    ->where('evaluation_id', $evaluation['idevaluation'])
                    ->get()
                    ->getRowArray();

                if (!$bonusExists) {
                    // Insert bonus record
                    $this->db->table('bonuses')->insert([
                        'employee_id' => $evaluation['employee_id'],
                        'evaluation_id' => $evaluation['idevaluation'],
                        'bonus_amount' => $evaluation['bonus_to_be_paid'],
                        'bonus_percentage' => $bonusPercentage,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
            unset($evaluation); // Break the reference

            $data = [
                'evaluations' => $evaluations,
                'bonusPercentage' => $bonusPercentage,
                'evaluationPeriod' => $evaluationPeriod
            ];
        }

        echo view('templates/espaceadmin/entete', $data);
        echo view('templates/espaceadmin/sidebar', $data);
        echo view('templates/espaceadmin/topbar', $data);
        echo view('templates/espaceadmin/bonus_configuration', $data);
        echo view('templates/espaceadmin/pied', $data);
    }

    /**
     * Line Manager: View Bonus Report for Subordinates
     */
    public function managerReport()
{
    $session = session();
    $managerId = $session->get('cnxid'); // Manager's ID from session

    // Fetch employees under this manager
    $employeeBuilder = $this->db->table('agent');
    $employees = $employeeBuilder->where('Responsablen1' || 'Responsablen2', $managerId)
        ->orderBy('nom', 'ASC')
        ->get()
        ->getResultArray();

    $evaluations = [];

    foreach ($employees as $employee) {
        // Get the bonus configuration for the employee
        $configBuilder = $this->db->table('bonus_configurations');
        $config = $configBuilder->where('employee_id', $employee['matricule'])->get()->getRowArray();

        // Skip if no config
        if (!$config) {
            continue;
        }

        // Get the employee's evaluation
        $evalBuilder = $this->db->table('evaluations');
        $evaluation = $evalBuilder->where('employee_id', $employee['matricule'])->get()->getRowArray();

        // Skip if no evaluation
        if (!$evaluation) {
            continue;
        }

        // Check if the evaluation score meets the threshold
        if ($evaluation['evaluation_score'] >= $config['evaluation_score_threshold']) {
            // Calculate bonus
            $bonusAmount = $employee['salary'] * ($config['bonus_percentage'] / 100);

            $evaluations[] = [
                'employee_number'    => $employee['matricule'],
                'full_name'          => $employee['nom'],
                'job_title'          => $employee['poste'],
                'grade'              => $employee['grade'],
                'score'              => $evaluation['evaluation_score'],
                'bonus_percentage'   => $config['bonus_percentage'],
                'bonus_to_be_paid'   => $bonusAmount,
            ];
        }
    }

    $data = [
        'evaluations' => $evaluations,
    ];

    // Load the manager_report view with $data
    echo view('templates/espacerespo/entete', $data);
    echo view('templates/espacerespo/sidebar', $data);
    echo view('templates/espacerespo/topbar', $data);
    echo view('templates/espacerespo/manager_report', $data);
    echo view('templates/espacerespo/pied', $data);
}
    /**
     * Employee: View Bonus Details
     */
    public function employeeBonus()
    {
        $session = session();
        $employeeId = $session->get('cnxid');

        // Get employee's details
        $employeeBuilder = $this->db->table('agent');
        $employee = $employeeBuilder->where('idagent', $employeeId)->get()->getRowArray();
        
    
        // Get employee's bonus configuration
        $configBuilder = $this->db->table('bonus_configurations');
        $config = $configBuilder->where('employee_id', $employee['matricule'])->get()->getRow();
    
        // Get employee's evaluation
        $evalBuilder = $this->db->table('evaluations');
        $evaluation = $evalBuilder->where('employee_id', $employee['matricule'])->get()->getRow();
    
        if ($config && $evaluation) {
            if ($evaluation->score >= $config->evaluation_score_threshold) {
                // Calculate bonus
                $bonusAmount = $evaluation->salary * ($config->bonus_percentage / 100);
    
                $data['bonus'] = [
                    'bonus_amount' => $bonusAmount,
                    'score' => $evaluation->evaluation_score,
                    'bonus_percentage' => $config->bonus_percentage,
                    'created_at' => $evaluation->created_at
                ];
            } else {
                $data['bonus'] = null;
            }
        } else {
            $data['bonus'] = null;
        }

        echo view('templates/espaceagent/entete', $data);
        echo view('templates/espaceagent/sidebar', $data);
        echo view('templates/espaceagent/topbar', $data);
        echo view('templates/espaceagent/employee_bonus', $data);
        echo view('templates/espaceagent/pied', $data);
    }
}