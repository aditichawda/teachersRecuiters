{{ header }}

<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <tr>
        <td style="padding: 20px 0;">
            <h2 style="color: #1967d2; margin: 0 0 20px 0;">{{ 'plugins/job-board::email.email_templates.job_alert_notification_title' | trans({'job_name': job_name}) | raw }}</h2>
            
            <p style="font-size: 16px; line-height: 24px; color: #333; margin: 0 0 15px 0;">
                {{ 'plugins/job-board::email.email_templates.job_alert_notification_greeting' | trans({'account_name': account_name}) | raw }}
            </p>
            
            <p style="font-size: 16px; line-height: 24px; color: #333; margin: 0 0 20px 0;">
                {{ 'plugins/job-board::email.email_templates.job_alert_notification_message' | trans({'alert_name': alert_name}) | raw }}
            </p>
            
            <!-- Alert Preferences Section -->
            <div style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="color: #1967d2; margin: 0 0 15px 0; font-size: 18px;">{{ 'plugins/job-board::email.email_templates.job_alert_notification_preferences' | trans | raw }}</h3>
                
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding: 8px 0; color: #666; font-size: 14px;">
                            {{ 'plugins/job-board::email.email_templates.job_alert_notification_job_area' | trans({'job_area': job_area}) | raw }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #666; font-size: 14px;">
                            {{ 'plugins/job-board::email.email_templates.job_alert_notification_job_type' | trans({'job_type': job_type}) | raw }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #666; font-size: 14px;">
                            {{ 'plugins/job-board::email.email_templates.job_alert_notification_location' | trans({'location': location}) | raw }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #666; font-size: 14px;">
                            {{ 'plugins/job-board::email.email_templates.job_alert_notification_salary' | trans({'salary_range': salary_range}) | raw }}
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Job Details Section -->
            <div style="background-color: #ffffff; border: 2px solid #1967d2; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="color: #1967d2; margin: 0 0 15px 0; font-size: 18px;">{{ 'plugins/job-board::email.email_templates.job_alert_notification_job_details' | trans | raw }}</h3>
                
                <p style="font-size: 16px; font-weight: bold; color: #333; margin: 0 0 10px 0;">
                    {{ 'plugins/job-board::email.email_templates.job_alert_notification_job_title' | trans({'job_name': job_name}) | raw }}
                </p>
                
                {% if company_name %}
                <p style="font-size: 14px; color: #666; margin: 0 0 15px 0;">
                    {{ 'plugins/job-board::email.email_templates.job_alert_notification_company' | trans({'company_name': company_name}) | raw }}
                </p>
                {% endif %}
                
                {% if job_description %}
                <div style="margin: 15px 0;">
                    <p style="font-size: 14px; font-weight: bold; color: #333; margin: 0 0 8px 0;">{{ 'plugins/job-board::email.email_templates.job_alert_notification_description' | trans | raw }}</p>
                    <p style="font-size: 14px; color: #666; line-height: 20px; margin: 0;">
                        {{ job_description | slice(0, 200) }}{% if job_description | length > 200 %}...{% endif %}
                    </p>
                </div>
                {% endif %}
                
                <!-- View Job Button -->
                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0 0 0;">
                    <tr>
                        <td align="center">
                            <a href="{{ job_url }}" style="display: inline-block; padding: 12px 30px; background-color: #1967d2; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">
                                {{ 'plugins/job-board::email.email_templates.job_alert_notification_view_button' | trans | raw }}
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Browse All Jobs Button -->
            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                <tr>
                    <td align="center">
                        <a href="{{ view_jobs_url }}" style="display: inline-block; padding: 10px 25px; background-color: #10b981; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;">
                            {{ 'plugins/job-board::email.email_templates.job_alert_notification_browse_button' | trans | raw }}
                        </a>
                    </td>
                </tr>
            </table>
            
            <!-- Manage Alerts Link -->
            <p style="font-size: 14px; color: #666; text-align: center; margin: 20px 0 10px 0;">
                {{ 'plugins/job-board::email.email_templates.job_alert_notification_manage_alerts' | trans | raw }}
                <a href="{{ unsubscribe_url }}" style="color: #1967d2; text-decoration: none;">{{ 'plugins/job-board::email.email_templates.job_alert_notification_unsubscribe' | trans | raw }}</a>
            </p>
            
            <p style="font-size: 14px; color: #666; text-align: center; margin: 20px 0 0 0;">
                {{ 'plugins/job-board::email.email_templates.job_alert_notification_thanks' | trans | raw }}
            </p>
            
            <p style="font-size: 14px; color: #666; text-align: center; margin: 10px 0 0 0;">
                {{ 'plugins/job-board::email.email_templates.job_alert_notification_regards' | trans | raw }}<br>
                <strong>{{ 'plugins/job-board::email.email_templates.job_alert_notification_team' | trans | raw }}</strong>
            </p>
        </td>
    </tr>
</table>

{{ footer }}
