<!-- Field 26: Job Type -->
<div class="form-group mb-4" data-step="3">
    <label class="form-label required">Job Type</label>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="job_type[]" value="part-time" id="job_type_part_time" onchange="handleJobTypeChange()">
                <label class="form-check-label" for="job_type_part_time">Part Time</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="job_type[]" value="internship" id="job_type_internship" onchange="handleJobTypeChange()">
                <label class="form-check-label" for="job_type_internship">Internship</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="job_type[]" value="freelance" id="job_type_freelance" onchange="handleJobTypeChange()">
                <label class="form-check-label" for="job_type_freelance">Freelance</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="job_type[]" value="contract" id="job_type_contract" onchange="handleJobTypeChange()">
                <label class="form-check-label" for="job_type_contract">Contract</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="job_type[]" value="remote" id="job_type_remote" onchange="handleJobTypeChange()">
                <label class="form-check-label" for="job_type_remote">Remote</label>
            </div>
        </div>
    </div>
    
    <!-- Full-Time Section (can select up to 2 with priority) -->
    <div class="mb-3">
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="job_type[]" value="full-time" id="job_type_full_time" onchange="handleFullTimeChange()">
            <label class="form-check-label" for="job_type_full_time">Full-Time</label>
        </div>
        
        <div id="full-time-options" style="display:none;" class="ms-4">
            <p class="text-muted small mb-2">Select up to 2 Full-Time options with priority:</p>
            <div id="full-time-container">
                <!-- Full-time entries will be added here -->
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-full-time-btn" onclick="addFullTimeOption()">
                <i class="ti ti-plus"></i> Add Full-Time Option
            </button>
        </div>
    </div>
    
    <input type="hidden" name="job_types_json" id="job_types_json" value="">
</div>

<script>
let fullTimeCount = 0;
const maxFullTime = 2;

const fullTimeOptions = {
    'regular': 'Regular Full-Time',
    'permanent': 'Permanent Full-Time',
    'fixed-term': 'Fixed Term Full-Time',
    'probationary': 'Probationary Full-Time'
};

function handleJobTypeChange() {
    updateJobTypeJSON();
}

function handleFullTimeChange() {
    const checkbox = document.getElementById('job_type_full_time');
    const container = document.getElementById('full-time-options');
    
    if (checkbox.checked) {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
        // Clear full-time entries
        fullTimeCount = 0;
        document.getElementById('full-time-container').innerHTML = '';
        updateFullTimeButton();
        updateJobTypeJSON();
    }
}

function addFullTimeOption() {
    if (fullTimeCount >= maxFullTime) {
        alert('You can add maximum ' + maxFullTime + ' Full-Time options.');
        return;
    }
    
    const container = document.getElementById('full-time-container');
    const index = fullTimeCount;
    fullTimeCount++;
    
    const div = document.createElement('div');
    div.className = 'full-time-entry mb-3 p-3 border rounded';
    div.id = 'full-time-entry-' + index;
    
    div.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Full-Time Type</label>
                <select name="full_time_options[${index}][type]" class="form-select" required>
                    <option value="">Select Type</option>
                    ${Object.entries(fullTimeOptions).map(([key, value]) => 
                        `<option value="${key}">${value}</option>`
                    ).join('')}
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Priority</label>
                <select name="full_time_options[${index}][priority]" class="form-select" required>
                    <option value="">Select Priority</option>
                    <option value="1">1 (Highest)</option>
                    <option value="2">2 (Lowest)</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFullTimeOption(${index})">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
        </div>
    `;
    
    container.appendChild(div);
    updateFullTimeButton();
    updateJobTypeJSON();
}

function removeFullTimeOption(index) {
    const entry = document.getElementById('full-time-entry-' + index);
    if (entry) {
        entry.remove();
        fullTimeCount--;
        updateFullTimeButton();
        updateJobTypeJSON();
    }
}

function updateFullTimeButton() {
    const btn = document.getElementById('add-full-time-btn');
    if (fullTimeCount >= maxFullTime) {
        btn.disabled = true;
        btn.classList.add('disabled');
    } else {
        btn.disabled = false;
        btn.classList.remove('disabled');
    }
}

function updateJobTypeJSON() {
    const jobTypes = [];
    const checkboxes = document.querySelectorAll('input[name="job_type[]"]:checked');
    
    checkboxes.forEach(checkbox => {
        if (checkbox.value !== 'full-time') {
            jobTypes.push(checkbox.value);
        }
    });
    
    // Add full-time options if checked
    if (document.getElementById('job_type_full_time').checked) {
        const fullTimeEntries = document.querySelectorAll('.full-time-entry');
        const fullTimeData = [];
        
        fullTimeEntries.forEach((entry, index) => {
            const type = entry.querySelector('select[name*="[type]"]').value;
            const priority = entry.querySelector('select[name*="[priority]"]').value;
            fullTimeData.push({ type, priority });
        });
        
        jobTypes.push({
            type: 'full-time',
            options: fullTimeData
        });
    }
    
    document.getElementById('job_types_json').value = JSON.stringify(jobTypes);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('change', function(e) {
        if (e.target.closest('.full-time-entry') || e.target.name === 'job_type[]') {
            updateJobTypeJSON();
        }
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/auth/partials/job-type.blade.php ENDPATH**/ ?>