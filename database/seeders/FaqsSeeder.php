<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [

            // ============================
            // ADMIN FAQs
            // ============================

            // System Management - User Management
            ['question' => 'How to add, update, or remove members?', 'answer' => 'Admins can manage members through the User Management section in the dashboard.', 'target_audience' => 'admin', 'type' => 'System Management'],
            ['question' => 'How to reset a member’s password?', 'answer' => 'Go to User Management, select the member, and choose reset password option.', 'target_audience' => 'admin', 'type' => 'System Management'],
            ['question' => 'How to verify or approve new member registrations?', 'answer' => 'Navigate to Pending Users in the dashboard and approve or reject applications.', 'target_audience' => 'admin', 'type' => 'System Management'],

            // Content Management
            ['question' => 'How to add/edit/delete training events?', 'answer' => 'Use the Training Management section to add, edit, or remove training events.', 'target_audience' => 'admin', 'type' => 'Content Management'],
            ['question' => 'How to upload announcements or news updates?', 'answer' => 'Admins can upload announcements through the Announcements tab in the dashboard.', 'target_audience' => 'admin', 'type' => 'Content Management'],
            ['question' => 'How to manage uploaded documents/resources?', 'answer' => 'Go to Resource Management to upload or manage files.', 'target_audience' => 'admin', 'type' => 'Content Management'],

            // System Features
            ['question' => 'How to use the dashboard and interpret data/statistics?', 'answer' => 'The dashboard provides summaries of user activity, requests, and events.', 'target_audience' => 'admin', 'type' => 'System Features'],
            ['question' => 'How to manage requests (e.g., for tools, training, or assistance)?', 'answer' => 'Requests are handled in the Requests tab where admins can approve or decline.', 'target_audience' => 'admin', 'type' => 'System Features'],
            ['question' => 'How to handle notifications and messaging features?', 'answer' => 'Notifications are automatically sent; admins can also broadcast messages through the messaging tool.', 'target_audience' => 'admin', 'type' => 'System Features'],

            // Support & Troubleshooting
            ['question' => 'What to do if a member cannot log in?', 'answer' => 'Check if the account is active and reset the password if needed.', 'target_audience' => 'admin', 'type' => 'Support & Troubleshooting'],
            ['question' => 'How to fix display issues or missing data?', 'answer' => 'Clear browser cache or refresh the data; if unresolved, contact IT support.', 'target_audience' => 'admin', 'type' => 'Support & Troubleshooting'],
            ['question' => 'How to report system errors/bugs?', 'answer' => 'Use the Report Issue button or email the IT support team.', 'target_audience' => 'admin', 'type' => 'Support & Troubleshooting'],
            ['question' => 'When should admins escalate issues to the system developer/IT team?', 'answer' => 'Escalate if issues affect multiple users or system-wide features.', 'target_audience' => 'admin', 'type' => 'Support & Troubleshooting'],
            ['question' => 'How to provide support contact details to members?', 'answer' => 'Admins can share contact info via announcements or user messages.', 'target_audience' => 'admin', 'type' => 'Support & Troubleshooting'],

            // Policy & Guidelines
            ['question' => 'How to ensure member data is kept secure?', 'answer' => 'Always follow data privacy policies and restrict unauthorized access.', 'target_audience' => 'admin', 'type' => 'Policy & Guidelines'],
            ['question' => 'What content can/cannot be uploaded?', 'answer' => 'Only official documents, training materials, and relevant announcements are allowed.', 'target_audience' => 'admin', 'type' => 'Policy & Guidelines'],
            ['question' => 'How to moderate discussions or comments (if any)?', 'answer' => 'Admins may remove inappropriate content and warn violators.', 'target_audience' => 'admin', 'type' => 'Policy & Guidelines'],

            // Training & Knowledge
            ['question' => 'Step-by-step guides for new admins.', 'answer' => 'Refer to the Admin Guide PDF available in the dashboard.', 'target_audience' => 'admin', 'type' => 'Training & Knowledge'],
            ['question' => 'Best practices for maintaining records.', 'answer' => 'Regularly update member and event records and keep data accurate.', 'target_audience' => 'admin', 'type' => 'Training & Knowledge'],
            ['question' => 'How to help members access training schedules or announcements?', 'answer' => 'Direct members to the Training or Announcements section in the mobile app.', 'target_audience' => 'admin', 'type' => 'Training & Knowledge'],


            // ============================
            // SUPPORT STAFF FAQs
            // ============================
            ['question' => 'How do I assist members who have trouble using the mobile app?', 'answer' => 'Guide them step by step or escalate to IT support if technical issues occur.', 'target_audience' => 'support-staff', 'type' => 'Support Staff'],
            ['question' => 'What is the process for helping members reset their password?', 'answer' => 'Verify their identity, then use the admin panel to reset or assist them in using the Forgot Password option.', 'target_audience' => 'support-staff', 'type' => 'Support Staff'],
            ['question' => 'How can I forward unresolved issues to the admin or IT team?', 'answer' => 'Record the issue details and escalate it through the official support ticket system.', 'target_audience' => 'support-staff', 'type' => 'Support Staff'],


            // ============================
            // USER FAQs
            // ============================
            ['question' => 'How can I register as a member in SWISA-AGAP?', 'answer' => 'Go to the mobile app, select Register, and fill out the membership form.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'How do I update my profile information?', 'answer' => 'Go to your Profile section and click Edit to update details.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'What should I do if I forget my password?', 'answer' => 'Use the Forgot Password option in the login screen to reset your password.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'How can I see the training schedules?', 'answer' => 'Check the Training section in the mobile app for upcoming schedules.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'Where can I access announcements and updates?', 'answer' => 'All announcements are available under the Announcements tab in the app.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'How do I request for assistance (tools, training, or support)?', 'answer' => 'Use the Request feature in the app to send your request to admins.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'How do I upload proof of participation or documents?', 'answer' => 'Go to the Upload Documents section in the app to submit your files.', 'target_audience' => 'user', 'type' => 'General'],
            ['question' => 'Who do I contact for technical support?', 'answer' => 'Contact details of the support team are available in the Help section of the app.', 'target_audience' => 'user', 'type' => 'General'],
        ];

        DB::table('faqs')->insert($faqs);
    }
}
