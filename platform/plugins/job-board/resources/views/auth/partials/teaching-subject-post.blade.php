<!-- Field 25: Teaching Subject or Post (up to 3 with priority) -->
<div class="form-group mb-4" data-step="3">
    <label class="form-label required">Teaching Subject or Post <small class="text-muted">(Can select up to 3 and set priority)</small></label>
    
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="subject_post_type" id="subject_post_teaching" value="teaching" checked onchange="handleSubjectPostTypeChange()">
            <label class="form-check-label" for="subject_post_teaching">Teaching Subjects</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="subject_post_type" id="subject_post_non_teaching" value="non-teaching" onchange="handleSubjectPostTypeChange()">
            <label class="form-check-label" for="subject_post_non_teaching">Non-Teaching Positions</label>
        </div>
    </div>
    
    <div id="teaching-subjects-container">
        <!-- Teaching subjects entries -->
    </div>
    
    <div id="non-teaching-positions-container" style="display:none;">
        <!-- Non-teaching positions entries -->
    </div>
    
    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-subject-post-btn" onclick="addSubjectPost()">
        <i class="ti ti-plus"></i> Add Subject/Post
    </button>
    
    <input type="hidden" name="teaching_subjects_posts" id="teaching_subjects_posts_json" value="">
</div>

<script>
let subjectPostCount = 0;
const maxSubjectPosts = 3;

const teachingSubjects = {
    'english-primary': 'English (Primary)',
    'english-upper-primary': 'English (Upper Primary)',
    'social-studies-primary': 'Social Studies (Primary)',
    'mathematics-secondary': 'Mathematics (Secondary)',
    'physics-secondary': 'Physics (Secondary)',
    'commerce-higher-secondary': 'Commerce (Higher Secondary)',
    'mathematics-higher-secondary': 'Mathematics (Higher Secondary)',
    'english-degree-college': 'English (Degree College)',
    'biology-higher-secondary': 'Biology (Higher Secondary)',
    'zoology-degree-college': 'Zoology (Degree College)',
    'mechanics-engineering-college': 'Mechanics (Engineering College)'
};

const nonTeachingPositions = {
    'school-principal': 'School Principal',
    'administrator': 'Administrator',
    'hr': 'HR',
    'hostel-warden': 'Hostel Warden',
    'counselor': 'Counselor',
    'academic-coordinator': 'Academic Coordinator'
};

function handleSubjectPostTypeChange() {
    const teachingRadio = document.getElementById('subject_post_teaching');
    const nonTeachingRadio = document.getElementById('subject_post_non_teaching');
    const teachingContainer = document.getElementById('teaching-subjects-container');
    const nonTeachingContainer = document.getElementById('non-teaching-positions-container');
    
    if (teachingRadio.checked) {
        teachingContainer.style.display = 'block';
        nonTeachingContainer.style.display = 'none';
    } else {
        teachingContainer.style.display = 'none';
        nonTeachingContainer.style.display = 'block';
    }
    
    // Clear existing entries
    subjectPostCount = 0;
    teachingContainer.innerHTML = '';
    nonTeachingContainer.innerHTML = '';
    updateSubjectPostButton();
}

function addSubjectPost() {
    if (subjectPostCount >= maxSubjectPosts) {
        alert('You can add maximum ' + maxSubjectPosts + ' subjects/posts.');
        return;
    }
    
    const teachingRadio = document.getElementById('subject_post_teaching');
    const isTeaching = teachingRadio.checked;
    const container = isTeaching ? 
        document.getElementById('teaching-subjects-container') : 
        document.getElementById('non-teaching-positions-container');
    
    const index = subjectPostCount;
    subjectPostCount++;
    
    const div = document.createElement('div');
    div.className = 'subject-post-entry mb-3 p-3 border rounded';
    div.id = 'subject-post-entry-' + index;
    
    const options = isTeaching ? teachingSubjects : nonTeachingPositions;
    const fieldName = isTeaching ? 'teaching_subject' : 'non_teaching_position';
    const fieldLabel = isTeaching ? 'Teaching Subject' : 'Non-Teaching Position';
    
    div.innerHTML = `
        <div class="row">
            <div class="col-md-8">
                <label class="form-label">${fieldLabel}</label>
                <select name="subject_posts[${index}][${fieldName}]" class="form-select" required>
                    <option value="">Select ${fieldLabel}</option>
                    ${Object.entries(options).map(([key, value]) => 
                        `<option value="${key}">${value}</option>`
                    ).join('')}
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Priority</label>
                <select name="subject_posts[${index}][priority]" class="form-select" required>
                    <option value="">Select Priority</option>
                    <option value="1">1 (Highest)</option>
                    <option value="2">2</option>
                    <option value="3">3 (Lowest)</option>
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeSubjectPost(${index})">
                    <i class="ti ti-trash"></i>
                </button>
            </div>
        </div>
        <input type="hidden" name="subject_posts[${index}][type]" value="${isTeaching ? 'teaching' : 'non-teaching'}">
    `;
    
    container.appendChild(div);
    updateSubjectPostButton();
    updateSubjectPostJSON();
}

function removeSubjectPost(index) {
    const entry = document.getElementById('subject-post-entry-' + index);
    if (entry) {
        entry.remove();
        subjectPostCount--;
        updateSubjectPostButton();
        updateSubjectPostJSON();
    }
}

function updateSubjectPostButton() {
    const btn = document.getElementById('add-subject-post-btn');
    if (subjectPostCount >= maxSubjectPosts) {
        btn.disabled = true;
        btn.classList.add('disabled');
    } else {
        btn.disabled = false;
        btn.classList.remove('disabled');
    }
}

function updateSubjectPostJSON() {
    const entries = document.querySelectorAll('.subject-post-entry');
    const data = [];
    
    entries.forEach((entry, index) => {
        const select = entry.querySelector('select');
        const priority = entry.querySelector('select[name*="[priority]"]').value;
        const type = entry.querySelector('input[name*="[type]"]').value;
        
        data.push({
            type: type,
            value: select.value,
            priority: priority
        });
    });
    
    document.getElementById('teaching_subjects_posts_json').value = JSON.stringify(data);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('change', function(e) {
        if (e.target.closest('.subject-post-entry')) {
            updateSubjectPostJSON();
        }
    });
});
</script>
