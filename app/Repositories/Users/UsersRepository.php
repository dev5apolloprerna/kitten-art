<?php

namespace App\Repositories\Users;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UsersRepository.
 */

use App\Models\User;
use App\Models\Group;
use App\Models\Tenant;
use App\Models\Department;
use Illuminate\Support\Facades\Bus;
use App\Jobs\User\ImportUserProcess;
use Spatie\Permission\Models\Role;
use App\Helpers\ConfigMailHelper;
use DB;

class UsersRepository implements UsersRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    public function find($id)
    {
        return User::with('roles')->find($id)->toArray();
    }

    public function all()
    {
        return User::with(['department'])->get()->toArray();
    }

    public function createOrUpdate($request, $id = null)
    {
        $data = $request->all();
        if ($id) {
            $user = User::find($id);
        } else {
            $user = new User;
            $user->user_type = $data['user_type'];
            if (isset($data['tenant_id'])) {
                $user->tenant_id = $data['tenant_id'];
            }
            /*$user->username  = "user".str_pad(mt_rand(100,99999999),8,'0',STR_PAD_LEFT);*/
        }
        $middle_name = " ";
        if (!empty($data['middle_name'])) {
            $middle_name = " " . $data['middle_name'] . " ";
        }
        $user->name   = $data['first_name'] . $middle_name . $data['last_name'];
        $user->first_name   = $data['first_name'];
        $user->middle_name   = $data['middle_name'];
        $user->last_name   = $data['last_name'];
        $user->email  = $data['email'];
        if (isset($data['emp_id'])) {
            $user->emp_id  = $data['emp_id'];
        }
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password  = bcrypt($data['password']);
        }
        if (isset($data['department_id']) && !empty($data['department_id'])) {
            $user->department_id  = $data['department_id'];
        }
        $user->status = 0;
        if (isset($data['status'])) {
            $user->status = 1;
        }
        $user->save();
        $user->syncRoles($data['roles']);
        if (!$id) {
            $username = self::generateUserName($user);
            $user->username = $username;
        }
        if (isset($data['is_hod']) && !empty($data['is_hod'])) {
            Department::where('id', $data['department_id'])->update(['hod' => $user->id]);
        }
        return $user;
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
    }

    public function import($data)
    {
        //Get Default roles here
        $roles = Role::where('is_default', 1)->pluck('name')->toArray();
        $groups = Group::where('is_default', 1)->pluck('id')->toArray();
        // Create an empty Batch and then dispatch it
        $batch = Bus::batch([])->dispatch();
        $chunks = array_chunk($data, 100);
        $header = [];
        $template = emailTemplate('Send Welcome User Email');
        $queue_domain = env('APP_URL');
        foreach ($chunks as $key => $chunk) {
            $mail_settings = ConfigMailHelper::getMailConfig();
            $tenant = Tenant::with(['master_user'])->find(auth()->user()->tenant_id)->toArray();
            // Get File Content and save it as an array
            $data = array_map('str_getcsv', $chunk);
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }
            $batch->options['queue'] = $queue_domain;
            // add The Job to the batch
            $batch->add(new ImportUserProcess($data, $header, $roles, $groups, $tenant, $template, $mail_settings, $queue_domain));
        }
        return $batch->id;
    }


    public function generateUserName($user)
    {
        $tenant  = DB::table('tenants')->where('id', $user->tenant_id)->first();
        $latest_user = DB::table('users')->where('tenant_id', $user->tenant_id)->where('username', '!=', '')->orderby('id', 'DESC')->first();
        if (is_object($latest_user)) {
            $extract_number  = explode($tenant->short_name, $latest_user->username);
            $number = ltrim($extract_number[1], '0');
            $number = $number + 1;
            $code = str_pad($number, 4, "0", STR_PAD_LEFT);
        } else {
            $code = "0001";
        }
        $username = $tenant->short_name . $code;
        DB::table('users')->where('id', $user->id)->update(['username' => $username]);
        return $username;
    }


    public function usersSummary()
    {
        $year = "";
        if (isset($_REQUEST['year']) && is_numeric($_REQUEST['year'])) {
            $year = $_REQUEST['year'];
        }
        $users = User::query();
        if (!empty($year)) {
            $users = $users->whereyear('created_at', $year);
        }
        $total_users = $users->count();
        $active_users = $users->where('status', 1)->count();
        $in_active_users = $users->where('status', 0)->count();
        $departments = Department::get()->toArray();

        $counts_summary = [
            [
                'title' => 'Total Users',
                'value' => $total_users,
            ],
            [
                'title' => 'Active Users',
                'value' => $active_users,
            ],
            [
                'title' => 'Inactive Users',
                'value' => $in_active_users,
            ],
            [
                'title' => 'Department',
                'value' => count($departments)
            ]
        ];

        $series = array();
        $dept_roles = array();
        $dept_count = array();
        $dept_name = array();
        foreach ($departments as $key => $dept) {
            $bar_labels[] = $dept['name'];
            $dept_users = User::with('roles')->where('department_id', $dept['id']);
            if (!empty($year)) {
                $dept_users = $dept_users->whereyear('created_at', $year);
            }
            $dept_users = $dept_users->get();
            $dept_users = toArray($dept_users);
            $user_roles = array();
            foreach ($dept_users as $ukey => $user) {
                if ($user['user_type'] != "tenant_master") {
                    $user_roles[] = array_column($user['roles'], 'id');
                }
            }
            $user_roles = \Arr::flatten($user_roles);
            //echo "<pre>"; print_r($user_roles);
            $series[$key]['x'] = $dept['name'];
            $series[$key]['y'] = count($dept_users);
            $dept_count[] = count($dept_users);
            $dept_name[] = $dept['name'];

            $dept_roles[$key]['dept_name'] = $dept['name'];
            $dept_roles[$key]['total_roles'] = count(array_unique($user_roles));
        }
        $departments_summary['dept_count'] = $dept_count;
        $departments_summary['dept_name'] = $dept_name;
        //echo "<pre>"; print_r($dept_roles); die; cassata@9876543210   cassata@qaz@#
        $departments_summary['series'] = $series;
        $departments_summary['dept_roles'] = $dept_roles;
        return array('counts_summary' => $counts_summary, 'departments_summary' => $departments_summary);
    }

    public function updateProfile($request)
    {
        $data = $request->all();
        $user = User::find(auth()->user()->id);
        $middle_name = " ";
        if (!empty($data['middle_name'])) {
            $middle_name = " " . $data['middle_name'] . " ";
        }
        $user->name   = $data['first_name'] . $middle_name . $data['last_name'];
        $user->first_name   = $data['first_name'];
        $user->middle_name   = $data['middle_name'];
        $user->last_name   = $data['last_name'];
        $user->email  = $data['email'];
        $user->save();
        return $user;
    }

    public function updatePassword($request)
    {
        $data = $request->all();
        $user = User::find(auth()->user()->id);
        $user->password  = \Hash::make($data['password']);
        $user->save();
        return $user;
    }

    public function userUpdatePassword($request)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        $user->password  = \Hash::make($data['password']);
        $user->save();
        return $user;
    }
}
