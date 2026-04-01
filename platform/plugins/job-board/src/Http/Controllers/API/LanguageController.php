<?php

namespace Botble\JobBoard\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Http\Resources\LanguageResource;
use Botble\JobBoard\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends BaseController
{
    public function index(Request $request)
    {
        $languages = Language::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->when($request->input('keyword'), function ($query, $keyword): void {
                $query->where('name', 'LIKE', "%{$keyword}%");
            })
            ->oldest('order')
            ->latest()
            ->paginate(min($request->integer('per_page', 20), 100));

        return $this
            ->httpResponse()
            ->setData(LanguageResource::collection($languages))
            ->toApiResponse();
    }

    public function show(int $id)
    {
        $language = Language::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->find($id);

        if (! $language) {
            return $this
                ->httpResponse()
                ->setError()
                ->setCode(404)
                ->setMessage(trans('plugins/job-board::messages.language_not_found'));
        }

        return $this
            ->httpResponse()
            ->setData(new LanguageResource($language))
            ->toApiResponse();
    }
}
