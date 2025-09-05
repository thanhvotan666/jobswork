<?php

namespace Database\Factories;

use App\Models\LocationSelect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $position = [
            'Frontend Developer',
            'Backend Developer',
            'Fullstack Developer',
            'DevOps Engineer',
            'QA Engineer',
            'Data Scientist',
            'Data Analyst',
            'Machine Learning Engineer',
            'Product Manager',
            'Project Manager',
            'UI/UX Designer',
            'System Administrator',
            'Network Engineer',
            'Security Analyst',
            'Database Administrator'
        ];
        array_push(
            $position,
            'Mobile Developer',
            'Game Developer',
            'Embedded Systems Engineer',
            'Cloud Engineer',
            'AI Researcher',
            'Blockchain Developer',
            'IT Support Specialist',
            'Technical Writer',
            'Business Analyst',
            'Scrum Master',
            'Software Architect',
            'Site Reliability Engineer',
            'IT Consultant',
            'Penetration Tester',
            'IT Auditor',
            'Sales Manager',
            'Account Executive',
            'Business Development Manager',
            'Marketing Manager',
            'Customer Success Manager'
        );
        $demand = ['fulltime', 'parttime', 'urgent', 'online', 'remote'];
        $type_salary = ['million VND', 'USD'];
        $t = $this->faker->randomElement($type_salary);
        $min_salary = $t == 'USD' ? random_int(500, 4999) : random_int(7, 49);
        $max_salary = $t == 'USD' ? random_int($min_salary, 5000) : random_int($min_salary, 50);
        $created_at = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'name' => $this->faker->jobTitle,
            'position' => $this->faker->randomElement($position),
            'degree' => $this->faker->randomElement(['Bachelor', 'Master', 'PhD']),
            'experience' => random_int(0, 6),
            'address' => $this->faker->address,
            'location' => LocationSelect::all()->random()->location,
            'description' => $this->faker->sentence,
            'requirement' => $this->faker->sentence,
            'benefits' => $this->faker->sentence,
            'expired' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'demand' => $this->faker->randomElement($demand),
            'min_salary' => $this->faker->randomElement([null, $min_salary]),
            'max_salary' => $this->faker->randomElement([null, $max_salary]),
            'type_salary' => $t,
            'admin_id' => $this->faker->randomElement([null, 1]),
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
