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

        $data = [
            'bonusConfigurations' => $bonusConfigurations
        ];

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
        // Retrieve POST data
        $bonusPercentage = $this->request->getPost('bonus_percentage');
        $evaluationPeriod = $this->request->getPost('evaluation_period');
        $evaluationScoreThreshold = $this->request->getPost('evaluation_score_threshold');

        // Insert new configuration
        $builder = $this->db->table('bonus_configurations');
        $builder->insert([
            'bonus_percentage' => $bonusPercentage,
            'evaluation_period' => $evaluationPeriod,
            'evaluation_score_threshold' => $evaluationScoreThreshold
        ]);

        return redirect()->to('/bonus/configure')->with('success', 'Bonus configuration saved successfully.');
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
            }

            if ($startDate) {
                // Fetch evaluations within the period and above the threshold
                $builder = $this->db->table('evaluations');
                $builder->select('evaluations.*, agent.idagent, agent.employee_number, CONCAT(agent.first_name, " ", agent.last_name) as full_name, agent.job_title, agent.grade');
                $builder->join('agent', 'evaluations.employee_id = agent.idagent');
                $builder->where('evaluations.created_at >=', $startDate);
                $builder->where('evaluations.score >=', $evaluationScoreThreshold);
                $evaluationsQuery = $builder->get();
                $evaluations = $evaluationsQuery->getResultArray();
            } else {
                $evaluations = [];
            }

            // Calculate bonus to be paid
            foreach ($evaluations as &$evaluation) {
                $evaluation['bonus_to_be_paid'] = round($evaluation['score'] * $bonusPercentage / 100, 2);
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
        echo view('templates/espaceadmin/bonus_report', $data);
        echo view('templates/espaceadmin/pied', $data);
    }

    /**
     * Line Manager: View Bonus Report for Subordinates
     */
    public function managerReport()
    {
        $session = session();
        $managerId = $session->get('cnxid');

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
            }

            if ($startDate) {
                // Fetch evaluations within the period and above the threshold for subordinates
                // Assuming there is a relationship between managers and employees
                // For example, agent table has manager_id column
                $builder = $this->db->table('evaluations');
                $builder->select('evaluations.*, agent.idagent, agent.employee_number, CONCAT(agent.first_name, " ", agent.last_name) as full_name, agent.job_title, agent.grade');
                $builder->join('agent', 'evaluations.employee_id = agent.idagent');
                $builder->where('evaluations.created_at >=', $startDate);
                $builder->where('evaluations.score >=', $evaluationScoreThreshold);
                $builder->where('agent.manager_id', $managerId); // Adjust based on your schema
                $evaluationsQuery = $builder->get();
                $evaluations = $evaluationsQuery->getResultArray();
            } else {
                $evaluations = [];
            }

            // Calculate bonus to be paid
            foreach ($evaluations as &$evaluation) {
                $evaluation['bonus_to_be_paid'] = round($evaluation['score'] * $bonusPercentage / 100, 2);
            }
            unset($evaluation); // Break the reference

            $data = [
                'evaluations' => $evaluations,
                'bonusPercentage' => $bonusPercentage,
                'evaluationPeriod' => $evaluationPeriod
            ];
        }

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

        // Fetch the latest bonus for the employee
        $builder = $this->db->table('bonuses');
        $builder->select('bonuses.*, evaluations.score, bonus_configurations.bonus_percentage');
        $builder->join('evaluations', 'bonuses.evaluation_id = evaluations.idevaluation');
        $builder->join('bonus_configurations', 'bonuses.bonus_percentage = bonus_configurations.bonus_percentage', 'left');
        $builder->where('bonuses.employee_id', $employeeId);
        $builder->orderBy('bonuses.created_at', 'DESC');
        $bonusQuery = $builder->get(1);
        $bonus = $bonusQuery->getRowArray();

        $data = [
            'bonus' => $bonus
        ];

        echo view('templates/espaceagent/entete', $data);
        echo view('templates/espaceagent/sidebar', $data);
        echo view('templates/espaceagent/topbar', $data);
        echo view('templates/espaceagent/employee_bonus', $data);
        echo view('templates/espaceagent/pied', $data);
    }
}