<?php

namespace App\Console\Commands;

use App\Models\Application;
use App\Models\Availability;
use App\Models\Company;
use App\Models\Department;
use App\Models\DepartmentType;
use App\Models\GradeLevel;
use App\Models\Group;
use App\Models\Location;
use App\Models\Module;
use App\Models\StaffType;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Dependency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dependencies:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating dependencies...');
        $department = $this->department();
        $level = $this->level();
        $status = $this->status();
        $location = $this->location();
        $type = $this->staffType();
        $company = $this->company();

        $this->info('Creating admin user...');
        $user = User::create([
            'grade_level_id' => $level->id,
            'department_id' => $department->id,
            'staff_type_id' => $type->id,
            'availability_id' => $status->id,
            'location_id' => $location->id,
            'company_id' => $company->id,
            'firstname' => 'Super',
            'surname' => 'Administrator',
            'staff_no' => 'AD001',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $group = $this->administrator()['group'];

        $user->groups()->save($group);
        $this->info('Dependencies installed successfully!!');
    }

    private function group()
    {
        return Group::create([
            'name' => 'Administrators',
            'label' => 'administrators',
            'isActive' => true
        ]);
    }

    private function status()
    {
        return Availability::create([
            'name' => 'Available',
            'label' => 'available'
        ]);
    }

    private function application()
    {
        return Application::create([
            'name' => 'Administration',
            'code' => 'ADMIN',
            'path' => '/administration',
            'icon' => 'engineering',
            'description' => 'Administrator Modules'
        ]);
    }

    private function administrator(): array
    {
        $application = $this->application();
        $group = $this->group();

        $module = Module::create([
            'application_id' => $application?->id,
            'name' => 'Modules',
            'code' => 'MODS',
            'path' => '/administration/modules',
            'icon' => 'widgets',
            'description' => 'Administrator Modules Children'
        ]);

        $module->groups()->save($group);
        $application->groups()->save($group);

        return compact('module', 'group');
    }

    private function location()
    {
        return Location::create([
            'name' => 'Yenagoa, Bayelsa',
            'label' => 'yenagoa-bayelsa',
            'hasFloors' => true
        ]);
    }

    private function staffType()
    {
        return StaffType::create([
            'name' => 'Permanent',
            'label' => Str::slug('Permanent')
        ]);
    }

    private function department()
    {
        $type = DepartmentType::create([
            'name' => 'Directorate',
            'label' => 'directorate'
        ]);

        if (! $type) {
            return false;
        }

        return Department::create([
            'department_type_id' => $type->id,
            'name' => 'Administration',
            'code' => 'SAD',
        ]);
    }

    private function level()
    {
        return GradeLevel::create([
            'name' => 'Technical Administrator',
            'key' => 'TAR'
        ]);
    }

    private function company()
    {
        return Company::create([
            'name' => 'Nigerian Content Development and Monitoring Board',
            'acronym' => 'NCDMB',
            'type' => 'owner'
        ]);
    }
}
