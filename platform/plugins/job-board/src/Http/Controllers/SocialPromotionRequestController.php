<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Models\CreditConsumption;
use Botble\JobBoard\Models\SocialPromotionRequest;
use Botble\JobBoard\Tables\SocialPromotionRequestTable;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SocialPromotionRequestController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(__('Social Promotion Requests'), route('social-promotion-requests.index'));
    }

    public function index(SocialPromotionRequestTable $table)
    {
        $this->pageTitle(__('Social Promotion Requests'));

        if (request()->has('draw') || request()->ajax() || request()->wantsJson()) {
            return $table->ajax();
        }

        return $table->renderTable();
    }

    public function downloadImage(int $id)
    {
        $item = SocialPromotionRequest::query()->findOrFail($id);
        if (! $item->image) {
            return redirect()->route('social-promotion-requests.index')->with('error_msg', __('No image to download.'));
        }
        $realPath = RvMedia::getRealPath($item->image);
        if (! $realPath || ! is_file($realPath)) {
            return redirect()->route('social-promotion-requests.index')->with('error_msg', __('File not found.'));
        }
        $filename = basename($item->image);
        return response()->download($realPath, $filename, [
            'Content-Type' => mime_content_type($realPath) ?: 'application/octet-stream',
        ]);
    }

    public function edit(int $id)
    {
        $item = SocialPromotionRequest::query()->with(['account', 'company'])->findOrFail($id);
        $this->pageTitle(__('Edit Social Promotion Request #:id', ['id' => $item->id]));
        return view('plugins/job-board::social-promotion-requests.edit', compact('item'));
    }

    public function update(Request $request, int $id)
    {
        $item = SocialPromotionRequest::query()->where('status', SocialPromotionRequest::STATUS_PENDING)->findOrFail($id);

        $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:60'],
            'message' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
        ]);

        $imageUrl = $item->image;
        /** @var UploadedFile|null $imageFile */
        $imageFile = $request->file('image');
        if ($imageFile) {
            $result = RvMedia::uploadFromBlob($imageFile, null, 0, 'social-promotion');
            if (! $result['error'] && isset($result['data']->url)) {
                $imageUrl = $result['data']->url;
            }
        }

        $item->update([
            'title' => $request->input('title'),
            'tag' => $request->input('tag'),
            'platform' => $request->input('platform'),
            'message' => $request->input('message'),
            'image' => $imageUrl,
        ]);

        return redirect()->route('social-promotion-requests.index')->with('success_msg', __('Request updated.'));
    }

    public function accept(Request $request, int $id)
    {
        $req = SocialPromotionRequest::query()->where('status', 'pending')->findOrFail($id);
        $account = $req->account;
        if (! $account) {
            $msg = __('Employer account not found.');
            if ($request->expectsJson()) {
                return $this->httpResponse()->setError()->setMessage($msg);
            }
            return redirect()->route('social-promotion-requests.index')->with('error_msg', $msg);
        }

        $credits = CreditConsumption::getCreditsForFeature('employer', CreditConsumption::FEATURE_SOCIAL_PROMOTION, 3000);
        if ($account->credits < $credits) {
            $msg = __('Employer has insufficient credits.');
            if ($request->expectsJson()) {
                return $this->httpResponse()->setError()->setMessage($msg);
            }
            return redirect()->route('social-promotion-requests.index')->with('error_msg', $msg);
        }

        CreditConsumption::deductForFeature(
            $account,
            CreditConsumption::FEATURE_SOCIAL_PROMOTION,
            $credits,
            'Social Promotion – ' . ($req->platform ?: 'social')
        );

        $req->update([
            'status' => SocialPromotionRequest::STATUS_ACCEPTED,
            'accepted_at' => now(),
            'accepted_by' => auth()->id(),
        ]);

        if ($request->expectsJson()) {
            return $this->httpResponse()->setMessage(__('Request accepted. Credits deducted.'));
        }
        return redirect()->route('social-promotion-requests.index')->with('success_msg', __('Request accepted. Credits deducted.'));
    }

    public function reject(Request $request, int $id)
    {
        $req = SocialPromotionRequest::query()->where('status', 'pending')->findOrFail($id);
        $req->update(['status' => SocialPromotionRequest::STATUS_REJECTED]);
        if ($request->expectsJson()) {
            return $this->httpResponse()->setMessage(__('Request rejected.'));
        }
        return redirect()->route('social-promotion-requests.index')->with('success_msg', __('Request rejected.'));
    }
}
