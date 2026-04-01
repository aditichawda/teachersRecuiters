<div class="py-4">
    <div class="container">
        <div class="row">
            @foreach ($companies as $company)
                <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                    <div class="text-center p-3">
                        <a
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-original-title="{{ $company->name }}"
                            href="{{ $company->url }}"
                            title="{{ $company->name }}"
                        >
                            <img
                                class="img-fluid"
                                src="{{ RvMedia::getImageUrl($company->logo) }}"
                                alt="{{ $company->name }}"
                            >
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
