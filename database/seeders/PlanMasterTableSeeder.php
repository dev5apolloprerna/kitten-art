<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('plan_master')->delete();
        
        \DB::table('plan_master')->insert(array (
            0 => 
            array (
                'planId' => 10,
                'category_id' => 1,
                'plan_name' => '1 Month Subscription',
                'plan_session' => 4,
                'plan_amount' => '60.00',
                'plan_image' => '1737033599.png',
                'plan_description' => '<ul>
<li>Art Classes (Age: 5-8 years)</li>
<li>Class: 1 Hour Session on every Saturday</li>
<li>Cost: $60/month which includes 4 sessions</li>
<li>All Art supplies included.</li>
</ul>',
                'detail_description' => NULL,
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-16 13:19:59',
                'updated_at' => '2025-01-16 13:19:59',
            ),
            1 => 
            array (
                'planId' => 13,
                'category_id' => 1,
                'plan_name' => '3 Month Subscription',
                'plan_session' => 12,
                'plan_amount' => '150.00',
                'plan_image' => '1738912124.jpg',
                'plan_description' => '<ul>
<li>Art Classes (5-8 years)</li>
<li>$ 150 for 3 months classes</li>
<li>Session Includes: 12</li>
<li>Duration: 1 hour</li>
</ul>',
                'detail_description' => NULL,
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-16 13:27:15',
                'updated_at' => '2025-02-07 02:08:44',
            ),
            2 => 
            array (
                'planId' => 14,
                'category_id' => 1,
                'plan_name' => '6 Month Subscription',
                'plan_session' => 24,
                'plan_amount' => '250.00',
                'plan_image' => '1737034073.png',
                'plan_description' => '<ul>
<li>Art Classes (5-8 years)</li>
<li>$ 250 for 6 months classes</li>
<li>Session Includes: 24</li>
<li>Duration: 1 hour</li>
</ul>',
                'detail_description' => NULL,
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-16 13:27:53',
                'updated_at' => '2025-01-16 13:27:53',
            ),
            3 => 
            array (
                'planId' => 16,
                'category_id' => 8,
                'plan_name' => '1 month class',
                'plan_session' => 4,
                'plan_amount' => '80.00',
                'plan_image' => '1737352466.png',
                'plan_description' => '<ul>
<li>Art Classes (Age: 9-14 years)</li>
<li>Class: 1 &frac12; Hour Session on every Saturday</li>
<li>Cost: $80/month which includes 4 sessions.</li>
<li>All Art supplies included.</li>
</ul>',
                'detail_description' => NULL,
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-01-20 05:54:26',
                'updated_at' => '2025-01-21 05:35:05',
            ),
            4 => 
            array (
                'planId' => 19,
                'category_id' => 8,
                'plan_name' => '6 months Classes',
                'plan_session' => 48,
                'plan_amount' => '500.00',
                'plan_image' => '1740553349.jpeg',
                'plan_description' => '<ul>
<li>Art Classes (Age: 9-14 years)</li>
<li>Class: 1 &frac12; Hour Session on every Saturday</li>
<li>Cost: $90/month which includes 4 sessions.</li>
<li>All Art supplies included.</li>
</ul>',
                'detail_description' => NULL,
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-02-10 13:01:13',
                'updated_at' => '2025-02-26 02:02:29',
            ),
            5 => 
            array (
                'planId' => 23,
                'category_id' => 1,
                'plan_name' => 'Test',
                'plan_session' => 6,
                'plan_amount' => '20.00',
                'plan_image' => '1739977641.jpg',
                'plan_description' => '<p>Testting</p>',
                'detail_description' => '<p>Tesitin</p>',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-02-19 10:07:21',
                'updated_at' => '2025-02-27 08:57:27',
            ),
            6 => 
            array (
                'planId' => 21,
                'category_id' => 1,
                'plan_name' => '6 months Classes 5-8',
                'plan_session' => 48,
                'plan_amount' => '500.00',
                'plan_image' => '1739885574.jpg',
                'plan_description' => '<p>tEstibng</p>',
                'detail_description' => '<p>tEstibng</p>',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-02-18 08:32:54',
                'updated_at' => '2025-02-18 08:32:54',
            ),
            7 => 
            array (
                'planId' => 22,
                'category_id' => 8,
                'plan_name' => '3 months Classes',
                'plan_session' => 12,
                'plan_amount' => '250.00',
                'plan_image' => '1741256336.jpg',
                'plan_description' => '<ul>
<li>Art Classes (Age: 9-14 years)</li>
<li>Class: 1 &frac12; Hour Session on every Saturday</li>
<li>Cost: $90/month which includes 4 sessions.</li>
<li>All Art supplies included.</li>
</ul>',
                'detail_description' => '<p>test</p>',
                'iStatus' => 1,
                'isDelete' => 0,
                'created_at' => '2025-02-19 07:27:56',
                'updated_at' => '2025-03-06 05:18:56',
            ),
            8 => 
            array (
                'planId' => 24,
                'category_id' => 1,
                'plan_name' => '5 Month Subscription',
                'plan_session' => 15,
                'plan_amount' => '100.00',
                'plan_image' => '1740657981.jpg',
                'plan_description' => '<p>sldkjg</p>',
                'detail_description' => '<p>sldggl</p>',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-02-27 07:06:21',
                'updated_at' => '2025-02-27 07:10:11',
            ),
            9 => 
            array (
                'planId' => 25,
                'category_id' => 8,
                'plan_name' => 'Plan 15',
                'plan_session' => 5,
                'plan_amount' => '40.00',
                'plan_image' => '1740746357.png',
                'plan_description' => '<p>fcghcbhvdbcjcf</p>',
                'detail_description' => '<p>uyfkyvjhlvjhvjhv</p>',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-02-28 07:36:54',
                'updated_at' => '2025-02-28 07:39:23',
            ),
            10 => 
            array (
                'planId' => 26,
                'category_id' => 1,
                'plan_name' => 'Plan 1',
                'plan_session' => 5,
                'plan_amount' => '20.00',
                'plan_image' => '1741255755.jpeg',
                'plan_description' => '<p>test</p>',
                'detail_description' => '<p>test</p>',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-03-06 05:09:15',
                'updated_at' => '2025-03-06 05:09:22',
            ),
            11 => 
            array (
                'planId' => 27,
                'category_id' => 1,
                'plan_name' => 'plan test',
                'plan_session' => 5,
                'plan_amount' => '2000.00',
                'plan_image' => '1741261415.jpeg',
                'plan_description' => '<p>test</p>',
                'detail_description' => '<p>test</p>',
                'iStatus' => 1,
                'isDelete' => 1,
                'created_at' => '2025-03-06 06:43:35',
                'updated_at' => '2025-03-06 06:44:02',
            ),
        ));
        
        
    }
}