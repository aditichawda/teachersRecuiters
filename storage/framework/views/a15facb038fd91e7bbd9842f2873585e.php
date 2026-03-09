<?php
    $candidates->loadMissing(['country', 'state', 'city', 'favoriteSkills', 'slugable', 'educations', 'experiences']);
    $canViewCandidates = $canViewCandidates ?? true;
?>

<?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        // Helper function for formatting
        $formatLabel = function($v) { return ucwords(str_replace('_', ' ', (string)$v)); };
        
        // Institution Type Labels
        $instLabels = [
            'cbse_school' => 'CBSE', 'icse_school' => 'ICSE', 'cambridge_school' => 'Cambridge',
            'ib_school' => 'IB', 'state_board_school' => 'State Board', 'play_school' => 'Play School',
            'engineering_college' => 'Engineering', 'medical_college' => 'Medical',
            'nursing_college' => 'Nursing', 'edtech_company' => 'EdTech',
            'coaching_institute' => 'Coaching', 'university' => 'University'
        ];
        
        // Get institution types - try multiple access methods
        $instTypes = [];
        if (!empty($candidate->institution_types)) {
            $instTypes = is_array($candidate->institution_types) ? $candidate->institution_types : json_decode($candidate->institution_types, true);
        }
        if (empty($instTypes) && !empty($candidate->institution_type)) {
            $instTypes = is_array($candidate->institution_type) ? $candidate->institution_type : [$candidate->institution_type];
        }
        $instTypes = is_array($instTypes) ? array_filter($instTypes) : [];
        $instTypeDisplay = !empty($instTypes) ? implode(', ', array_map(function($it) use ($instLabels) {
            return $instLabels[$it] ?? ucwords(str_replace('_', ' ', $it));
        }, array_slice($instTypes, 0, 2))) : '—';
        
        // Current Location
        $currentLocation = '—';
        // Try multiple ways to get location
        $cityName = $candidate->city_name ?? ($candidate->city->name ?? null);
        $stateName = $candidate->state_name ?? ($candidate->state->name ?? null);
        if ($cityName) {
            $currentLocation = $cityName;
            if ($stateName) $currentLocation .= ', ' . $stateName;
        } elseif ($stateName) {
            $currentLocation = $stateName;
        } elseif ($candidate->address) {
            $currentLocation = Str::limit($candidate->address, 30);
        }
        
        // Total Experience
        $totalExp = $candidate->total_experience ?? '—';
        if ($totalExp && $totalExp !== '—') {
            $totalExp = $formatLabel($totalExp);
        }
        
        // Teaching Subjects / Non-Teaching Roles
        $subjectsRoles = '—';
        $positionType = $candidate->position_type ?? null;
        // Handle both string and array formats
        if (is_string($positionType)) {
            $positionType = json_decode($positionType, true) ?? $positionType;
        }
        if ($positionType === 'teaching' || (is_array($positionType) && in_array('teaching', $positionType))) {
            $subjects = $candidate->teaching_subjects ?? [];
            if (is_string($subjects)) {
                $subjects = json_decode($subjects, true) ?? [];
            }
            if (is_array($subjects) && !empty($subjects)) {
                $subjectsList = array_slice(array_filter($subjects), 0, 3);
                $subjectsRoles = 'Teaching: ' . implode(', ', array_map($formatLabel, $subjectsList));
                if (count($subjects) > 3) $subjectsRoles .= ' +' . (count($subjects) - 3) . ' more';
            }
        } elseif ($positionType === 'non_teaching' || (is_array($positionType) && in_array('non_teaching', $positionType))) {
            $nonTeach = $candidate->non_teaching_positions ?? [];
            if (is_string($nonTeach)) {
                $nonTeach = json_decode($nonTeach, true) ?? [];
            }
            if (is_array($nonTeach) && !empty($nonTeach)) {
                $nonTeachList = array_slice(array_filter($nonTeach), 0, 3);
                $subjectsRoles = 'Non-Teaching: ' . implode(', ', array_map($formatLabel, $nonTeachList));
                if (count($nonTeach) > 3) $subjectsRoles .= ' +' . (count($nonTeach) - 3) . ' more';
            }
        }
        
        // Teaching Certification
        $certifications = '—';
        $certs = $candidate->teaching_certifications ?? [];
        if (is_string($certs)) {
            $certs = json_decode($certs, true) ?? [];
        }
        if (is_array($certs) && !empty($certs)) {
            $certList = array_slice(array_filter($certs), 0, 2);
            $certifications = implode(', ', array_map($formatLabel, $certList));
            if (count($certs) > 2) $certifications .= ' +' . (count($certs) - 2) . ' more';
        }
        
        // Highest Qualification Level
        $highestQual = '—';
        $quals = $candidate->qualifications ?? [];
        if (is_string($quals)) {
            $quals = json_decode($quals, true) ?? [];
        }
        // Also try to get from educations relationship if qualifications field is empty
        if (empty($quals) && $candidate->educations && $candidate->educations->isNotEmpty()) {
            $quals = $candidate->educations->map(function($edu) {
                return [
                    'level' => $edu->degree_level ?? $edu->degree ?? '',
                    'specialization' => $edu->specialization ?? $edu->major ?? '',
                    'institution' => $edu->school ?? $edu->institution ?? ''
                ];
            })->toArray();
        }
        if (is_array($quals) && !empty($quals)) {
            // Find highest level (assuming order: bachelors < masters < phd, etc.)
            $levelOrder = ['diploma' => 1, 'bachelors' => 2, 'masters' => 3, 'phd' => 4, 'post_graduate' => 3, 'doctorate' => 4];
            $highest = null;
            $highestOrder = 0;
            foreach ($quals as $q) {
                $level = is_array($q) ? ($q['level'] ?? '') : '';
                if (empty($level)) continue;
                $order = $levelOrder[strtolower($level)] ?? 0;
                if ($order > $highestOrder) {
                    $highestOrder = $order;
                    $highest = $q;
                }
            }
            if ($highest) {
                $level = is_array($highest) ? ($highest['level'] ?? '') : '';
                $highestQual = $formatLabel($level);
                if (is_array($highest) && !empty($highest['specialization'])) {
                    $highestQual .= ' (' . $formatLabel($highest['specialization']) . ')';
                }
            }
        }
        
        // Last Profile Updated
        $lastUpdated = $candidate->updated_at ? $candidate->updated_at->diffForHumans() : '—';
        
        // Profile Status (only show if open for employer view)
        $profileStatus = '—';
        if ($candidate->is_public_profile && $candidate->available_for_hiring) {
            $profileStatus = 'Open for Hiring';
        } elseif ($candidate->is_public_profile) {
            $profileStatus = 'Profile Visible';
        }
        
        // Gender
        $gender = $candidate->gender ? ucfirst($candidate->gender) : null;
        
        // Marital Status
        $maritalStatus = $candidate->marital_status ? ucwords(str_replace('_', ' ', $candidate->marital_status)) : null;
        
        // Notice Period
        $noticePeriod = $candidate->notice_period ? $formatLabel($candidate->notice_period) : null;
        
        // Current Work Status
        $workStatus = $candidate->current_work_status ? $formatLabel($candidate->current_work_status) : null;
        
        // Expected Salary
        $expectedSalary = null;
        if ($candidate->expected_salary) {
            $expectedSalary = '₹' . number_format($candidate->expected_salary);
            if ($candidate->expected_salary_period) {
                $expectedSalary .= ' / ' . $formatLabel($candidate->expected_salary_period);
            }
        }
        
        // Languages (first 2-3)
        $languages = null;
        if (is_array($candidate->languages) && !empty($candidate->languages)) {
            $langList = array_slice($candidate->languages, 0, 2);
            $langNames = array_map(function($lang) {
                $langName = is_array($lang) ? ($lang['language'] ?? '') : (string)$lang;
                return ucwords(str_replace('_', ' ', $langName));
            }, $langList);
            $languages = implode(', ', array_filter($langNames));
            if (count($candidate->languages) > 2) {
                $languages .= ' +' . (count($candidate->languages) - 2);
            }
        }
    ?>
    
    <div class="cand-card-list <?php echo e(!$canViewCandidates ? 'candidate-card-blur-wrap' : ''); ?>" data-can-view="<?php echo e($canViewCandidates ? '1' : '0'); ?>" style="position: relative; display: flex; align-items: flex-start; gap: 16px; padding: 16px; padding-left: 20px; border: 1px solid #e5e7eb; border-left: 4px solid #e5e7eb; border-radius: 8px; margin-bottom: 16px; background: #fff; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.borderColor='#0073d1'; this.style.borderLeftColor='#0073d1';" onmouseout="this.style.borderColor='#e5e7eb'; this.style.borderLeftColor='#e5e7eb';">
        <?php if($candidate->is_featured): ?>
            <span class="cl-featured" style="position: absolute; top: 12px; right: 12px; background: #dc2626; color: #fff; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: 600; z-index: 2; text-transform: uppercase; letter-spacing: 0.5px;"><?php echo e(__('Featured')); ?></span>
        <?php endif; ?>
        <?php if(!$canViewCandidates): ?>
        <div class="candidate-card-blur-content" style="display: flex; align-items: flex-start; gap: 16px; flex: 1; min-width: 0;">
        <?php endif; ?>
        
        <div class="cl-avatar" style="flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
            <img src="<?php echo e($candidate->avatar_url); ?>" alt="<?php echo e($candidate->name); ?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; object-position: center; border: 2px solid #e5e7eb; display: block;">
        </div>
        
        
        <div class="cl-info" style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 8px;">
            
            <a href="<?php echo e($canViewCandidates ? $candidate->url : '#'); ?>" class="cl-name <?php echo e(!$canViewCandidates ? 'cl-name-locked' : ''); ?>" <?php if(!$canViewCandidates): ?> data-bs-toggle="modal" data-bs-target="#candidateLockModal" onclick="event.preventDefault();" <?php endif; ?> style="font-size: 16px; font-weight: 600; color: #0073d1; text-decoration: none; display: block; margin-bottom: 4px;"><?php echo e($candidate->name); ?></a>
            
            
            <div class="cl-details-list" style="display: flex; flex-direction: column; gap: 6px; flex-wrap: wrap; max-height: 140px;">
                
                <?php if($currentLocation !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-map-pin" style="font-size: 12px; color: #94a3b8; width: 14px;"></i>
                        <span><strong><?php echo e(__('Location')); ?>:</strong> <?php echo e($currentLocation); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($totalExp !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-briefcase" style="font-size: 12px; color: #94a3b8; width: 14px;"></i>
                        <span><strong><?php echo e(__('Experience')); ?>:</strong> <?php echo e($totalExp); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($certifications !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-award" style="font-size: 12px; color: #94a3b8; width: 14px;"></i>
                        <span><strong><?php echo e(__('Certifications')); ?>:</strong> <?php echo e($certifications); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($lastUpdated !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-clock" style="font-size: 12px; color: #94a3b8; width: 14px;"></i>
                        <span><strong><?php echo e(__('Updated')); ?>:</strong> <?php echo e($lastUpdated); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($instTypeDisplay !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-building" style="font-size: 12px; color: #94a3b8; width: 14px;"></i>
                        <span><strong><?php echo e(__('Institution Type')); ?>:</strong> <?php echo e($instTypeDisplay); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($subjectsRoles !== '—'): ?>
                    <div style="display: flex; align-items: flex-start; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-book" style="font-size: 12px; color: #94a3b8; width: 14px; margin-top: 2px;"></i>
                        <span><strong><?php echo e(__('Subjects/Roles')); ?>:</strong> <?php echo e($subjectsRoles); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($highestQual !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-graduation-cap" style="font-size: 12px; color: #94a3b8; width: 14px;"></i>
                        <span><strong><?php echo e(__('Qualification')); ?>:</strong> <?php echo e($highestQual); ?></span>
                    </div>
                <?php endif; ?>
                
                
                <?php if($profileStatus !== '—'): ?>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #64748b;">
                        <i class="feather-check-circle" style="font-size: 12px; color: #10b981; width: 14px;"></i>
                        <span><strong><?php echo e(__('Status')); ?>:</strong> <?php echo e($profileStatus); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if(!$canViewCandidates): ?>
        </div>
        <div class="candidate-card-blur-overlay" data-bs-toggle="modal" data-bs-target="#candidateLockModal" role="button" tabindex="0">
            <p class="overlay-text"><?php echo e(trans('plugins/job-board::messages.buy_package_to_view_profiles')); ?></p>
        </div>
        <?php endif; ?>
        
        
        <?php if(! JobBoardHelper::isDisabledPublicProfile() && $candidate->url): ?>
            <div class="cl-right" style="flex-shrink: 0; display: flex; align-items: flex-end; align-self: flex-end; margin-left: auto;">
                <?php if($canViewCandidates): ?>
                    <a href="<?php echo e($candidate->url); ?>" class="cl-view-btn" style="background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.3s; white-space: nowrap; box-shadow: 0 2px 6px rgba(0, 115, 209, 0.25);"><?php echo e(__('View Profile')); ?> →</a>
                <?php else: ?>
                    <a href="#" class="cl-view-btn cl-view-btn-locked" data-bs-toggle="modal" data-bs-target="#candidateLockModal" style="background: linear-gradient(135deg, #0073d1 0%, #005bb5 100%); color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.3s; white-space: nowrap; box-shadow: 0 2px 6px rgba(0, 115, 209, 0.25);"><?php echo e(__('View Profile')); ?> →</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\Aditi\platform\themes/jobzilla/views/job-board/partials/candidates/list.blade.php ENDPATH**/ ?>