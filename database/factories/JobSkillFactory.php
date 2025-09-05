<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobSkill>
 */
class JobSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skills = [
            ['name' => 'Business'],
            ['name' => 'Programming'],
            ['name' => 'Design'],
            ['name' => 'Marketing'],
            ['name' => 'Project Management'],
            ['name' => 'Data Analysis'],
            ['name' => 'Content Writing'],
            ['name' => 'SEO'],
            ['name' => 'Sales'],
            ['name' => 'Customer Care'],
            ['name' => 'Network Administration'],
            ['name' => 'Web Development'],
            ['name' => 'Graphic Design'],
            ['name' => 'Product Management'],
            ['name' => 'App Development'],
            ['name' => 'Software Testing'],
            ['name' => 'Human Resources Management'],
            ['name' => 'Consulting'],
            ['name' => 'Business Development'],
            ['name' => 'Financial Management'],
            ['name' => 'English'],
            ['name' => 'Japanese'],
            ['name' => 'Korean'],
            ['name' => 'Chinese'],
            ['name' => 'French'],
        ];
        return [
            'name' => $this->faker->randomElement($skills)['name'],
        ];
    }
}
