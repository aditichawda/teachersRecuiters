<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Models\WalkinDriveAdRequest;
use Botble\JobBoard\Tables\WalkinDriveAdRequestTable;
use Illuminate\Http\Request;

class WalkinDriveAdRequestController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(__('Walk-in Drive Ad Requests'), route('walkin-drive-ad-requests.index'));
    }

    public function index(WalkinDriveAdRequestTable $table)
    {
        $this->pageTitle(__('Walk-in Drive Ad Requests'));

        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function edit(int $id)
    {
        $item = WalkinDriveAdRequest::query()->with(['account', 'company'])->findOrFail($id);
        $this->pageTitle(__('Edit Walk-in Drive Ad Request #:id', ['id' => $item->id]));
        return view('plugins/job-board::walkin-drive-ad-requests.edit', compact('item'));
    }

    public function update(Request $request, int $id)
    {
        $item = WalkinDriveAdRequest::query()->findOrFail($id);

        $request->validate([
            'status' => ['required', 'string', 'in:pending,approved,rejected'],
            'message' => ['nullable', 'string', 'max:5000'],
        ]);

        $updates = [
            'status' => $request->input('status'),
            'message' => $request->input('message'),
        ];
        if ($request->input('status') === WalkinDriveAdRequest::STATUS_APPROVED) {
            $updates['approved_at'] = now();
            $updates['approved_by'] = auth()->id();
        }
        $item->update($updates);

        return redirect()
            ->route('walkin-drive-ad-requests.index')
            ->with('success_msg', __('Walk-in Drive Ad request updated.'));
    }

    public function destroy(int $id)
    {
        $item = WalkinDriveAdRequest::query()->findOrFail($id);
        $item->delete();
        return $this->httpResponse()->setMessage(__('Request deleted.'));
    }
}
