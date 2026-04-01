{{ header }}

<p>{{ 'plugins/job-board::email.email_templates.job_alert_greeting' | trans({'account_name': account_name}) }}</p>

<p>{{ 'plugins/job-board::email.email_templates.job_alert_message' | trans({'alert_name': alert_name}) }}</p>

<p><strong>{{ 'plugins/job-board::email.email_templates.job_alert_job_title' | trans({'job_name': job_name}) | raw }}</strong></p>

{% if company_name %}
<p>{{ 'plugins/job-board::email.email_templates.job_alert_company' | trans({'company_name': company_name}) }}</p>
{% endif %}

{% if job_area %}
<p>{{ 'plugins/job-board::email.email_templates.job_alert_job_area' | trans({'job_area': job_area}) }}</p>
{% endif %}

{% if location %}
<p>{{ 'plugins/job-board::email.email_templates.job_alert_location' | trans({'location': location}) }}</p>
{% endif %}

{% if salary_range %}
<p>{{ 'plugins/job-board::email.email_templates.job_alert_salary' | trans({'salary_range': salary_range}) }}</p>
{% endif %}

{% if job_type %}
<p>{{ 'plugins/job-board::email.email_templates.job_alert_job_type' | trans({'job_type': job_type}) }}</p>
{% endif %}

{% if job_description %}
<p>{{ 'plugins/job-board::email.email_templates.job_alert_description' | trans({'job_description': job_description}) }}</p>
{% endif %}

<p style="text-align: center; margin: 30px 0;">
    <a href="{{ job_url }}" style="display: inline-block; padding: 12px 30px; color: #ffffff; background-color: #007bff; border-radius: 5px; text-decoration: none; font-weight: bold;">
        {{ 'plugins/job-board::email.email_templates.job_alert_view_job_button' | trans }}
    </a>
</p>

<p style="text-align: center; margin: 20px 0;">
    <a href="{{ view_jobs_url }}" style="display: inline-block; padding: 10px 25px; color: #ffffff; background-color: #6c757d; border-radius: 5px; text-decoration: none;">
        {{ 'plugins/job-board::email.email_templates.job_alert_view_all_jobs_button' | trans }}
    </a>
</p>

{% if unsubscribe_url %}
<p style="margin-top: 30px; font-size: 12px; color: #666;">
    {{ 'plugins/job-board::email.email_templates.job_alert_unsubscribe' | trans({'unsubscribe_url': unsubscribe_url}) | raw }}
</p>
{% endif %}

<p>{{ 'plugins/job-board::email.email_templates.job_alert_regards' | trans }}<br>{{ site_title }}</p>

{{ footer }}
