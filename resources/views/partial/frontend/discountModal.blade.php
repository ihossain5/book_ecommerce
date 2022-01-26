@if ($discountOffer->is_visible !=0)
<div class="modal fade" id="discountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
          <img src="{{asset('images/'.$discountOffer->image)}}" alt="logo" class="img-fluid w-100">
      </div>

    </div>
  </div>
</div>
@endif
