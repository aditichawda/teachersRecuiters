<!-- Field 24: Position Type (Teaching/Non-Teaching) -->
<div class="form-group mb-4" data-step="3">
    <label class="form-label required">Are you looking a job for which position?</label>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="position_type[]" value="teaching" id="position_teaching" onchange="handlePositionTypeChange()">
                <label class="form-check-label" for="position_teaching">
                    Teaching
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="position_type[]" value="non-teaching" id="position_non_teaching" onchange="handlePositionTypeChange()">
                <label class="form-check-label" for="position_non_teaching">
                    Non-Teaching
                </label>
            </div>
        </div>
    </div>
    
    <!-- Sub-fields will appear here based on selection -->
    <div id="position-type-subfields" class="mt-3" style="display:none;">
        <!-- Dynamic sub-fields will be added here -->
    </div>
</div>

<script>
function handlePositionTypeChange() {
    const teachingChecked = document.getElementById('position_teaching').checked;
    const nonTeachingChecked = document.getElementById('position_non_teaching').checked;
    const subFieldsContainer = document.getElementById('position-type-subfields');
    
    if (!teachingChecked && !nonTeachingChecked) {
        subFieldsContainer.style.display = 'none';
        return;
    }
    
    subFieldsContainer.style.display = 'block';
    let html = '<div class="row"><div class="col-12"><p class="text-muted mb-2">Please select your preferred position type above to see available options.</p></div></div>';
    
    if (teachingChecked || nonTeachingChecked) {
        html = '<div class="alert alert-info"><strong>Selected:</strong> ';
        if (teachingChecked) html += 'Teaching ';
        if (nonTeachingChecked) html += 'Non-Teaching';
        html += '</div>';
    }
    
    subFieldsContainer.innerHTML = html;
}
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/auth/partials/position-type.blade.php ENDPATH**/ ?>