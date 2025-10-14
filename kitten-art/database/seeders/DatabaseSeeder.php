<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);
        $this->call(BatchMasterTableSeeder::class);
        $this->call(CategoryMasterTableSeeder::class);
        $this->call(EventMasterTableSeeder::class);
        $this->call(GalleryMasterTableSeeder::class);
        $this->call(HomePageTableSeeder::class);
        $this->call(InquiryTableSeeder::class);
        $this->call(PlanMasterTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SendemaildetailsTableSeeder::class);
        $this->call(ServiceImagesTableSeeder::class);
        $this->call(ServiceMasterTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(StudentAttendanceTableSeeder::class);
        $this->call(StudentAttendanceMasterTableSeeder::class);
        $this->call(StudentInquiryMasterTableSeeder::class);
        $this->call(StudentLedgerTableSeeder::class);
        $this->call(StudentMasterTableSeeder::class);
        $this->call(StudentRenewPlanTableSeeder::class);
        $this->call(StudentSubscriptionTableSeeder::class);
        $this->call(TestimonialTableSeeder::class);
        $this->call(TrialMasterTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
