<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Models\AdmissionEnquiry;
use Botble\JobBoard\Tables\AdmissionEnquiryTable;

class AdmissionEnquiryController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(__('Admission Enquiries'), route('admission-enquiries.index'));
    }

    public function index(AdmissionEnquiryTable $table)
    {
        $this->pageTitle(__('Admission Enquiries'));

        // DataTables sends "draw" when requesting data; also accept ajax/wantsJson
        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function destroy(AdmissionEnquiry $admission_enquiry)
    {
        return DeleteResourceAction::make($admission_enquiry);
    }
}
