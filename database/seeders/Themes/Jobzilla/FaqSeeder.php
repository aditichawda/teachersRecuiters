<?php

namespace Database\Seeders\Themes\Jobzilla;

use Botble\Base\Supports\BaseSeeder;
use Botble\Faq\Models\Faq;
use Botble\Faq\Models\FaqCategory;

class FaqSeeder extends BaseSeeder
{
    public function run(): void
    {
        Faq::query()->truncate();
        FaqCategory::query()->truncate();

        $categories = [
            [
                'name' => 'General',
            ],
            [
                'name' => 'Jobs',
            ],
            [
                'name' => 'Payment',
            ],
            [
                'name' => 'Return',
            ],
        ];

        foreach ($categories as $index => $value) {
            $value['order'] = $index;
            FaqCategory::query()->create($value);
        }

        $faqItems = [
            [
                'question' => 'Where is my job posting advertised?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'What Makes Your Business Plans So Special?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'Reset Password With Phone Number?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'How do I redeem a coupon?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'How long will it take to post my job?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'Where Can I Find Market Research Reports?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'Do I need to know PHP to use TheJobs?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'How soon will I start receiving resumes?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 1,
            ],
            [
                'question' => 'How do I redeem a coupon?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 2,
            ],
            [
                'question' => 'How long will it take to post my job?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 2,
            ],
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 2,
            ],
            [
                'question' => 'Where Can I Find Market Research Reports?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 2,
            ],
            [
                'question' => 'Do I need to know PHP to use TheJobs?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 2,
            ],
            [
                'question' => 'How soon will I start receiving resumes?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 2,
            ],
            [
                'question' => 'What Makes Your Business Plans So Special?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'Reset Password With Phone Number?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'How do I redeem a coupon?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'How long will it take to post my job?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'Where Can I Find Market Research Reports?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'Do I need to know PHP to use TheJobs?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'How soon will I start receiving resumes?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 3,
            ],
            [
                'question' => 'What is your shipping policy?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 4,
            ],
            [
                'question' => 'How long will it take to post my job?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 4,
            ],
            [
                'question' => 'What is your cancellation policy?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 4,
            ],
            [
                'question' => 'Where Can I Find Market Research Reports?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 4,
            ],
            [
                'question' => 'Do I need to know PHP to use TheJobs?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 4,
            ],
            [
                'question' => 'How soon will I start receiving resumes?',
                'answer' => 'A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
                'category_id' => 4,
            ],
        ];

        foreach ($faqItems as $value) {
            Faq::query()->create($value);
        }
    }
}
