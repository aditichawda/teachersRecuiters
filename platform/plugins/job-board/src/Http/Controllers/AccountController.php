<?php

namespace Botble\JobBoard\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\JobBoard\Enums\AccountTypeEnum;
use Botble\JobBoard\Forms\AccountForm;
use Botble\JobBoard\Http\Requests\AccountCreateRequest;
use Botble\JobBoard\Http\Requests\AccountEditRequest;
use Botble\JobBoard\Http\Resources\AccountResource;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Tables\AccountTable;
use Botble\Media\Models\MediaFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/job-board::job-board.name'))
            ->add(trans('plugins/job-board::account.name'), route('accounts.index'));
    }

    public function index(AccountTable $dataTable)
    {
        $this->pageTitle(trans('plugins/job-board::account.name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/job-board::account.create'));

        return AccountForm::create()
            ->remove('is_change_password')
            ->renderForm();
    }

    public function store(AccountCreateRequest $request)
    {
        $form = AccountForm::create()->setRequest($request);

        $form->saving(function (AccountForm $form): void {
            $account = $form->getModel();
            $request = $form->getRequest();

            $request->merge(['password' => Hash::make($request->input('password'))]);
            $fullName = trim(($request->input('first_name', '') . ' ' . $request->input('last_name', '')));
            $request->merge(['full_name' => $fullName]);
            $account->fill($request->input());
            $account->is_featured = $request->input('is_featured', false);
            $verifiedAt = Carbon::now();
            $account->email_verified_at = $verifiedAt;
            $account->confirmed_at = $verifiedAt;

            if ($request->input('avatar_image')) {
                $image = MediaFile::query()
                    ->where('url', $request->input('avatar_image'))
                    ->first();

                if ($image) {
                    $account->avatar_id = $image->id;
                }
            }

            $account->save();
        });

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('accounts.index'))
            ->setNextUrl(route('accounts.edit', $form->getModel()->getKey()))
            ->withCreatedSuccessMessage();
    }

    public function edit(Account $account, Request $request)
    {
        try {
            $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $account->name ?? '']));

            $account->password = null;

            event(new BeforeEditContentEvent($request, $account));

            return AccountForm::createFromModel($account)
                ->renderForm();
        } catch (\Throwable $e) {
            report($e);

            return redirect()
                ->route('accounts.index')
                ->with('error_msg', 'Edit failed: ' . $e->getMessage());
        }
    }

    public function update(Account $account, AccountEditRequest $request)
    {
        AccountForm::createFromModel($account)
            ->setRequest($request)
            ->saving(function (AccountForm $form): void {
                $request = $form->getRequest();
                $account = $form->getModel();

                if ($request->input('is_change_password') == 1) {
                    $request->merge(['password' => Hash::make($request->input('password'))]);
                    $data = $request->input();
                } else {
                    $data = $request->except('password');
                }
                $data['full_name'] = trim(($request->input('first_name', '') . ' ' . $request->input('last_name', '')));
                $account->fill($data);
                $account->is_featured = $request->input('is_featured', false);

                if ($request->input('avatar_image')) {
                    $imageId = MediaFile::query()
                        ->where('url', $request->input('avatar_image'))
                        ->value('id');

                    if ($imageId) {
                        $account->avatar_id = $imageId;
                    }
                }

                $account->save();

                // Only update email_verified_at and confirmed_at when the field was sent (both together)
                if ($request->has('confirmed_at')) {
                    $isConfirmedEmail = $request->input('confirmed_at');
                    if ($isConfirmedEmail && ! $account->confirmed_at) {
                        $verifiedAt = Carbon::now();
                        $account->email_verified_at = $verifiedAt;
                        $account->confirmed_at = $verifiedAt;
                    }
                    if (! $isConfirmedEmail && $account->confirmed_at) {
                        $account->email_verified_at = null;
                        $account->confirmed_at = null;
                    }
                }

                $account->save();
            });

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('accounts.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Account $account)
    {
        return DeleteResourceAction::make($account);
    }

    public function getList(Request $request)
    {
        $keyword = BaseHelper::stringify($request->input('q'));

        if (! $keyword) {
            return $this
                ->httpResponse()
                ->setData([]);
        }

        $data = Account::query()
            ->where('jb_accounts.type', AccountTypeEnum::EMPLOYER)
            ->when($keyword, function ($query) use ($keyword): void {
                $query->where(function ($query) use ($keyword): void {
                    $query->where('jb_accounts.full_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('jb_accounts.first_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('jb_accounts.last_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('jb_accounts.email', 'LIKE', "%{$keyword}%");
                });
            })
            ->select(['jb_accounts.id', 'jb_accounts.first_name', 'jb_accounts.last_name', 'jb_accounts.full_name', 'jb_accounts.email'])
            ->take(10)
            ->get();

        return $this
            ->httpResponse()
            ->setData(AccountResource::collection($data));
    }

    public function getAllEmployers()
    {
        return Account::query()
            ->where('type', AccountTypeEnum::EMPLOYER)
            ->get()
            ->map(fn (Account $a) => $a->name)
            ->all();
    }

}
