<?php

namespace Botble\JobBoard\Http\Requests;

use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;

class AccountEditRequest extends Request
{
    public function rules(): array
    {
        $account = $this->route('account');
        $accountId = $account && is_object($account) ? $account->getKey() : (is_numeric($account) ? $account : null);

        $rules = [
            'first_name' => 'required|max:120|min:2',
            'last_name' => 'nullable|max:120',
            'confirmed_at' => new OnOffRule(),
            'email' => 'required|max:60|min:6|email|unique:jb_accounts,email,' . ($accountId ?? 0),
            'unique_id' => 'nullable|string|unique:jb_accounts,unique_id,' . ($accountId ?? 0),
        ];

        if ($this->input('is_change_password') == 1) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        return $rules;
    }
}
