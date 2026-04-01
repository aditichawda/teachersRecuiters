<?php

namespace Botble\JobBoard\Http\Controllers\API;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Controllers\BaseController;
use Botble\JobBoard\Http\Resources\SpecializationResource;
use Botble\JobBoard\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends BaseController
{
    public function index(Request $request)
    {
        $specializations = Specialization::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->when($request->input('keyword'), function ($query, $keyword): void {
                $query->where('name', 'LIKE', "%{$keyword}%");
            })
            ->oldest('order')
            ->latest()
            ->paginate(min($request->integer('per_page', 20), 100));

        return $this
            ->httpResponse()
            ->setData(SpecializationResource::collection($specializations))
            ->toApiResponse();
    }

    public function show(int $id)
    {
        $specialization = Specialization::query()
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->find($id);

        if (! $specialization) {
            return $this
                ->httpResponse()
                ->setError()
                ->setCode(404)
                ->setMessage(trans('plugins/job-board::messages.specialization_not_found'));
        }

        return $this
            ->httpResponse()
            ->setData(new SpecializationResource($specialization))
            ->toApiResponse();
    }
}
