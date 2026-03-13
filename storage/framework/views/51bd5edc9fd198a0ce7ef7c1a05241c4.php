<!-- Field 23: Educational Institutions (up to 3 with priority) -->
<div class="form-group mb-4" data-step="3">
    <label class="form-label required">Looking job for which type of educational Institutions <small class="text-muted">(Can add up to 3 and set priority)</small></label>
    
    <div id="educational-institutions-container">
        <!-- Institution entries will be added here dynamically -->
    </div>
    
    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-institution-btn" onclick="addEducationalInstitution()">
        <i class="ti ti-plus"></i> Add Institution
    </button>
    
    <input type="hidden" name="educational_institutions" id="educational_institutions_json" value="">
</div>

<script>
let institutionCount = 0;
const maxInstitutions = 3;

const institutionTypes = {
    'school': {
        label: 'School',
        subField: {
            type: 'select',
            name: 'school_board_type',
            label: 'Select School Board/Type',
            options: {
                '': 'Select Board/Type',
                'cbse': 'CBSE',
                'cicse': 'CICSE',
                'cambridge': 'Cambridge',
                'igcse': 'IGCSE',
                'ib': 'IB',
                'primary': 'Primary',
                'play': 'Play',
                'state-board': 'State Board'
            }
        }
    },
    'edtech-company': { label: 'Edtech Company' },
    'online-education-platform': { label: 'Online Education Platform' },
    'college': {
        label: 'College',
        subField: {
            type: 'select',
            name: 'college_type',
            label: 'Select College Type',
            options: {
                '': 'Select College Type',
                'medical-college': 'Medical College',
                'engineering-college': 'Engineering College',
                'nursing-college': 'Nursing College',
                'arts-college': 'Arts College',
                'commerce-college': 'Commerce College',
                'science-college': 'Science College'
            }
        }
    },
    'coaching-institute': {
        label: 'Coaching Institute',
        subField: {
            type: 'select',
            name: 'coaching_type',
            label: 'Select Coaching Type',
            options: {
                '': 'Select Coaching Type',
                'jee-neet': 'JEE & NEET Coaching',
                'banking': 'Banking Coaching',
                'ssc': 'SSC Coaching',
                'upsc': 'UPSC Coaching',
                'gate': 'GATE Coaching',
                'cat': 'CAT Coaching'
            }
        }
    },
    'book-publishing-company': { label: 'Book Publishing Company' },
    'non-profit-organization': { label: 'Non-Profit Organization' },
    'university': { label: 'University' },
    'distance-learning': { label: 'Distance Learning' },
    'teacher-training-academy': { label: 'Teacher Training Academy' },
    'sports-academy': { label: 'Sports Academy' }
};

const stateBoards = {
    'mp-board': 'MP Board',
    'rajasthan-board': 'Rajasthan Board',
    'maharashtra-board': 'Maharashtra Board',
    'gujarat-board': 'Gujarat Board',
    'karnataka-board': 'Karnataka Board',
    'tamil-nadu-board': 'Tamil Nadu Board',
    'west-bengal-board': 'West Bengal Board',
    'up-board': 'UP Board'
};

function addEducationalInstitution() {
    if (institutionCount >= maxInstitutions) {
        alert('You can add maximum ' + maxInstitutions + ' institutions.');
        return;
    }
    
    const container = document.getElementById('educational-institutions-container');
    const index = institutionCount;
    institutionCount++;
    
    const div = document.createElement('div');
    div.className = 'institution-entry mb-3 p-3 border rounded';
    div.id = 'institution-entry-' + index;
    
    div.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Institution Type</label>
                <select name="educational_institutions[${index}][type]" class="form-select institution-type-select" data-index="${index}" onchange="handleInstitutionTypeChange(${index})" required>
                    <option value="">Select Type</option>
                    ${Object.entries(institutionTypes).map(([key, value]) => 
                        `<option value="${key}">${value.label}</option>`
                    ).join('')}
                </select>
            </div>
            <div class="col-md-4 institution-subfield-${index}">
                <!-- Sub-field will be added here dynamically -->
            </div>
            <div class="col-md-3">
                <label class="form-label">Priority</label>
                <select name="educational_institutions[${index}][priority]" class="form-select" required>
                    <option value="">Select Priority</option>
                    <option value="1">1 (Highest)</option>
                    <option value="2">2</option>
                    <option value="3">3 (Lowest)</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeInstitution(${index})">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
        </div>
        <div class="row mt-2 state-board-field-${index}" style="display:none;">
            <div class="col-md-4">
                <label class="form-label">Select State Board</label>
                <select name="educational_institutions[${index}][state_board]" class="form-select">
                    <option value="">Select State Board</option>
                    ${Object.entries(stateBoards).map(([key, value]) => 
                        `<option value="${key}">${value}</option>`
                    ).join('')}
                </select>
            </div>
        </div>
    `;
    
    container.appendChild(div);
    updateInstitutionButton();
}

function handleInstitutionTypeChange(index) {
    const select = document.querySelector(`#institution-entry-${index} .institution-type-select`);
    const type = select.value;
    const subFieldContainer = document.querySelector(`.institution-subfield-${index}`);
    const stateBoardContainer = document.querySelector(`.state-board-field-${index}`);
    
    // Clear sub-field
    subFieldContainer.innerHTML = '';
    stateBoardContainer.style.display = 'none';
    
    if (!type || !institutionTypes[type] || !institutionTypes[type].subField) {
        return;
    }
    
    const subField = institutionTypes[type].subField;
    
    if (subField.type === 'select') {
        subFieldContainer.innerHTML = `
            <label class="form-label">${subField.label}</label>
            <select name="educational_institutions[${index}][${subField.name}]" class="form-select" onchange="handleSchoolBoardChange(${index})" required>
                ${Object.entries(subField.options).map(([key, value]) => 
                    `<option value="${key}">${value}</option>`
                ).join('')}
            </select>
        `;
    }
}

function handleSchoolBoardChange(index) {
    const select = document.querySelector(`#institution-entry-${index} select[name*="[school_board_type]"]`);
    const stateBoardContainer = document.querySelector(`.state-board-field-${index}`);
    
    if (select && select.value === 'state-board') {
        stateBoardContainer.style.display = 'block';
        const stateBoardSelect = stateBoardContainer.querySelector('select');
        if (stateBoardSelect) {
            stateBoardSelect.setAttribute('required', 'required');
        }
    } else {
        stateBoardContainer.style.display = 'none';
        const stateBoardSelect = stateBoardContainer.querySelector('select');
        if (stateBoardSelect) {
            stateBoardSelect.removeAttribute('required');
        }
    }
}

function removeInstitution(index) {
    const entry = document.getElementById('institution-entry-' + index);
    if (entry) {
        entry.remove();
        institutionCount--;
        updateInstitutionButton();
        updateInstitutionJSON();
    }
}

function updateInstitutionButton() {
    const btn = document.getElementById('add-institution-btn');
    if (institutionCount >= maxInstitutions) {
        btn.disabled = true;
        btn.classList.add('disabled');
    } else {
        btn.disabled = false;
        btn.classList.remove('disabled');
    }
}

function updateInstitutionJSON() {
    const entries = document.querySelectorAll('.institution-entry');
    const data = [];
    
    entries.forEach((entry, index) => {
        const type = entry.querySelector('.institution-type-select').value;
        const priority = entry.querySelector('select[name*="[priority]"]').value;
        const subFieldSelect = entry.querySelector('.institution-subfield-' + index + ' select');
        const stateBoardSelect = entry.querySelector('.state-board-field-' + index + ' select');
        
        const entryData = {
            type: type,
            priority: priority
        };
        
        if (subFieldSelect) {
            const subFieldName = subFieldSelect.name.match(/\[([^\]]+)\]/)[1];
            entryData[subFieldName] = subFieldSelect.value;
        }
        
        if (stateBoardSelect && stateBoardSelect.value) {
            entryData.state_board = stateBoardSelect.value;
        }
        
        data.push(entryData);
    });
    
    document.getElementById('educational_institutions_json').value = JSON.stringify(data);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to update JSON when fields change
    document.addEventListener('change', function(e) {
        if (e.target.closest('.institution-entry')) {
            updateInstitutionJSON();
        }
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\plugins\job-board\/resources/views/auth/partials/educational-institutions.blade.php ENDPATH**/ ?>