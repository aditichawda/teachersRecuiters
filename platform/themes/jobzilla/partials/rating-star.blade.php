@for($i = 1 ; $i <= $star; $i++)
    <span><i class="fa fa-star"></i></span>
@endfor
@for($i = 1 ; $i <= (5 - $star); $i++)
    <span><i class="fa fa-star" style="color: grey"></i></span>
@endfor
