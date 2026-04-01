<?php

namespace Botble\JobBoard\Tables\Fronts\BulkActions;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Table\Abstracts\TableBulkActionAbstract;
use Illuminate\Database\Eloquent\Model;

class ExportResumesBulkAction extends TableBulkActionAbstract
{
    public function __construct()
    {
        $this->label(trans('plugins/job-board::dashboard.export_resumes_of_selected'));
    }

    public function dispatch(Model $model, array $ids): BaseHttpResponse
    {
        $url = route('public.account.applicants.export-resumes') . '?ids=' . implode(',', $ids);

        return BaseHttpResponse::make()
            ->setNextUrl($url)
            ->setMessage(trans('plugins/job-board::dashboard.export_resumes_redirect'));
    }
}
