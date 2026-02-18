<div class="form-group mb-4">
    <h4 class="section-head-small mb-4">{{ __('Keyword') }}</h4>
    <div class="input-group">
        <input type="text" name="keyword" value="{{ BaseHelper::stringify(request()->query('keyword')) }}" class="form-control" placeholder="{{ __('Candidate Name or Keyword') }}">
        <button class="btn" type="submit">
            <i class="feather-search"></i>
        </button>
    </div>
</div>
