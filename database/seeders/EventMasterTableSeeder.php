<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventMasterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('event_master')->delete();
        
        \DB::table('event_master')->insert(array (
            0 => 
            array (
                'event_id' => 1,
                'event_name' => 'And Sew It Begins: Beginner Hand Sewing Class',
                'category_id' => 1,
                'capacity' => '10 student',
                'Instructors' => 'Nicole L., Julia E., Rachel C.',
                'discounts' => 'Sibling Discount',
                'location' => '9113 Leesville Rd, Suite 102, Raleigh, NC 27613',
                'detail_description' => '<h2>Class Experience</h2>

<p>And Sew It Begins: Join us at Paint Paper Paste for a beginner hand sewing course! No previous sewing experience required - we will begin with the&nbsp;<strong>basics of threading and knot tying, explore several different stitches and embroidery</strong>, and artists will walk away with at least two completed sewing projects in this 6 week course!</p>

<p>&nbsp;</p>

<p>Registration for And Sew It Begins is based on class series. Single/drop-in classes are not permitted.&nbsp;<strong>Artists must be in 3rd-7th grade to participate in this class series.</strong>&nbsp;&nbsp;Afterschool Art Adventures Make-Up Policy applies to this offering. &nbsp;See our policies on our website for more details.&nbsp;</p>

<p>&nbsp;</p>

<h3>Class Requirements</h3>

<ul>
<li>Beginner level class - no prior sewing skills necessary!&nbsp;</li>
<li>Artists must be currently enrolled in 3rd-7th grade to participate</li>
<li>Be sure to bring your imagination and creativity!</li>
</ul>

<h3>Sample Class Format</h3>

<ul>
<li>4:25 - Drop-off begins</li>
<li>4:30 - Instruction begins promptly at class start time</li>
<li>5:25-5:30 - All students must be promptly picked up by 5:30pm.&nbsp;Failure to pick child up on time will result in a late pickup fee, charged to the registrant&#39;s card on file at the time of pickup.</li>
</ul>

<h3>Other Things To Know</h3>

<p>Cancellation Policy</p>

<p><strong>AFTERSCHOOL ART ADVENTURES:&nbsp;</strong>Cancellations made AT LEAST 1 month/30 days prior to the first class date will receive a full refund, less a $50 cancellation fee for Full Semester Registrations and $15 cancellation fee for Monthly Registrations</p>

<hr />
<h2>What To Bring</h2>

<ul>
<li>Water bottles are welcome! Please finish any afterschool snacks prior to entering the studio.</li>
<li>Light jacket (our studio runs cold!)</li>
</ul>

<hr />',
                'to_date' => '2025-02-10',
                'from_date' => '2025-01-06',
                'to_time' => '17:30:00',
                'from_time' => '16:30:00',
                'image' => '1736423339.jpg',
                'created_at' => '2024-12-24 10:14:42',
                'updated_at' => '2025-01-31 17:34:27',
            ),
            1 => 
            array (
                'event_id' => 3,
                'event_name' => 'Great Outdoors Trackout Camp',
                'category_id' => 1,
                'capacity' => '14 Students',
                'Instructors' => 'Maureen C.',
                'discounts' => 'Sibling Discount',
                'location' => '9113 Leesville Rd, Suite 103, Raleigh, NC 27613',
                'detail_description' => '<h2>Class Experience</h2>

<p>&nbsp;</p>

<p>Join us for a week full of art exploration fueled by the great outdoors! &nbsp;From camping landscapes to animal drawings, we will dive into all forms of art in this school&#39;s out camp.</p>

<p>&nbsp;</p>

<p>?Sign up for the full week OR for individual days!</p>

<p>&nbsp;</p>

<p>⭐️Artists must be currently enrolled in&nbsp;<strong>Kindergarten-5th grade&nbsp;</strong>to participate in School&rsquo;s Out offerings. &nbsp;<em>Artists enrolled in transitional kindergarten or not currently enrolled in kindergarten are not permitted.</em></p>

<p>&nbsp;</p>

<h3>Class Requirements</h3>

<ul>
<li>?Art-friendly clothes (artists often get MESSY while creating!)</li>
<li>⭐️Artists must be in Kindergarten-5th grade to participate in School&rsquo;s Out offerings. &nbsp;Artists enrolled in transitional kindergarten or not currently enrolled in kindergarten are not permitted.&nbsp;</li>
<li>?Be sure to bring your imagination and creativity!</li>
</ul>

<h3>Sample Class Format</h3>

<ul>
<li>❤️8:50 - Drop-off begins</li>
<li>?9:05 - Instruction begins</li>
<li>?10:30-10:45 - Snack break&nbsp;</li>
<li>?12:00-12:30 - Lunchtime&nbsp;</li>
<li>?12:45-1:55 - Independent art activities&nbsp;</li>
<li>?1:55-2:00 - All students must be promptly picked up by 2:00pm. Failure to pick child up on time will result in a late pickup fee, collected at the time of pickup.&nbsp;</li>
</ul>

<h3>Other Things To Know</h3>

<p><img src="https://cdn-p0.hisawyer.com/packs/static/app/assets/images/pdp_icons/cancellation-policy@2x-47dea2935762f969f9e1.png" /></p>

<p>Cancellation Policy</p>

<p><strong>TRACKOUT CAMPS:&nbsp;</strong>Cancellations made AT LEAST 1 month/30 days prior to the first day will receive a full refund, less a $50 cancellation fee for Full Week Registrations and $15 cancellation fee per day for Single Day Registrations.</p>

<hr />
<h2>What To Bring</h2>

<p>&nbsp;</p>

<p>Copy</p>

<ul>
<li>?Art-friendly clothes (Dress for mess - we will get MESSY while we create!)</li>
<li>?Water bottle</li>
<li>?Nut-free snack</li>
<li>?Nut-free lunch</li>
<li>?Blanket or towel for outside snacktime</li>
<li>?Light jacket (our studio runs cold!)</li>
</ul>',
                'to_date' => '2025-02-07',
                'from_date' => '2025-02-03',
                'to_time' => '14:00:00',
                'from_time' => '09:00:00',
                'image' => '1739961947.png',
                'created_at' => '2025-01-20 12:43:04',
                'updated_at' => '2025-02-19 05:45:47',
            ),
        ));
        
        
    }
}