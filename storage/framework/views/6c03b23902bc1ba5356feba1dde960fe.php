<?php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner notifications-page');
    
    // Sample notifications - in real app, these would come from database
    $notifications = [
        [
            'id' => 1,
            'type' => 'job_alert',
            'title' => 'New Job Match Found',
            'message' => 'A new teaching position matching your profile has been posted.',
            'time' => '2 hours ago',
            'read' => false,
            'icon' => 'feather-briefcase',
            'color' => '#1967d2'
        ],
        [
            'id' => 2,
            'type' => 'application',
            'title' => 'Application Status Updated',
            'message' => 'Your application for "Mathematics Teacher" has been reviewed.',
            'time' => '5 hours ago',
            'read' => false,
            'icon' => 'feather-file-text',
            'color' => '#10b981'
        ],
        [
            'id' => 3,
            'type' => 'message',
            'title' => 'New Message from Employer',
            'message' => 'You have received a message from ABC School regarding your application.',
            'time' => '1 day ago',
            'read' => true,
            'icon' => 'feather-message-circle',
            'color' => '#f59e0b'
        ],
        [
            'id' => 4,
            'type' => 'profile',
            'title' => 'Profile View',
            'message' => 'Your profile was viewed by 5 employers this week.',
            'time' => '2 days ago',
            'read' => true,
            'icon' => 'feather-eye',
            'color' => '#8b5cf6'
        ],
        [
            'id' => 5,
            'type' => 'job_alert',
            'title' => 'New Job Match Found',
            'message' => 'A new position for "Science Teacher" is available in your area.',
            'time' => '3 days ago',
            'read' => true,
            'icon' => 'feather-briefcase',
            'color' => '#1967d2'
        ],
    ];
?>

<style>
.notifications-section {
    padding: 90px 0 50px;
    background: #f8fafc;
    min-height: 80vh;
}
.notifications-header {
    text-align: center;
    margin-bottom: 30px;
}
.notifications-header h1 {
    font-size: 36px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}
.notifications-header p {
    font-size: 16px;
    color: #64748b;
}
.notifications-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 15px;
}
.notifications-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    justify-content: center;
    flex-wrap: wrap;
}
.notification-tab {
    padding: 10px 24px;
    border: 2px solid #e2e8f0;
    background: #fff;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s ease;
}
.notification-tab:hover {
    border-color: var(--primary-color, #1967d2);
    color: var(--primary-color, #1967d2);
}
.notification-tab.active {
    background: var(--primary-color, #1967d2);
    border-color: var(--primary-color, #1967d2);
    color: #fff;
}
.notifications-list {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}
.notification-item {
    display: flex;
    align-items: flex-start;
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s ease;
    cursor: pointer;
}
.notification-item:last-child {
    border-bottom: none;
}
.notification-item:hover {
    background: #f8fafc;
}
.notification-item.unread {
    background: #f0f9ff;
    border-left: 4px solid var(--primary-color, #1967d2);
}
.notification-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #fff;
    margin-right: 15px;
    flex-shrink: 0;
}
.notification-content {
    flex: 1;
}
.notification-title {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 5px;
}
.notification-item.unread .notification-title {
    font-weight: 700;
}
.notification-message {
    font-size: 14px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 8px;
}
.notification-time {
    font-size: 12px;
    color: #94a3b8;
}
.notification-actions {
    display: flex;
    gap: 10px;
    margin-left: 15px;
}
.notification-action-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    color: #64748b;
}
.notification-action-btn:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: var(--primary-color, #1967d2);
}
.empty-notifications {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}
.empty-notifications i {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
}
.empty-notifications h3 {
    font-size: 20px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 10px;
}
.empty-notifications p {
    font-size: 14px;
    color: #94a3b8;
}
@media(max-width: 768px) {
    .notifications-section { padding: 70px 0 40px; }
    .notifications-container { padding: 0 15px; }
    .notifications-header { margin-bottom: 25px; }
    .notifications-header h1 { font-size: 28px; }
    .notifications-tabs { gap: 8px; margin-bottom: 15px; }
    .notification-tab { padding: 8px 16px; font-size: 13px; }
    .notification-item { padding: 12px 15px; }
    .notification-icon { width: 40px; height: 40px; font-size: 20px; margin-right: 12px; }
    .notification-title { font-size: 15px; }
    .notification-message { font-size: 13px; }
}
</style>

<section class="notifications-section">
    <div class="container">
        <div class="notifications-header">
            <h1><?php echo e(__('Notifications')); ?></h1>
            <p><?php echo e(__('Stay updated with your job applications and opportunities')); ?></p>
        </div>

        <div class="notifications-container">
            <div class="notifications-tabs">
                <button class="notification-tab active" data-filter="all">
                    <?php echo e(__('All')); ?> <span class="badge">5</span>
                </button>
                <button class="notification-tab" data-filter="unread">
                    <?php echo e(__('Unread')); ?> <span class="badge">2</span>
                </button>
                <button class="notification-tab" data-filter="read">
                    <?php echo e(__('Read')); ?> <span class="badge">3</span>
                </button>
            </div>

            <div class="notifications-list">
                <?php if(count($notifications) > 0): ?>
                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="notification-item <?php echo e(!$notification['read'] ? 'unread' : ''); ?>" 
                             data-type="<?php echo e($notification['type']); ?>"
                             data-read="<?php echo e($notification['read'] ? 'true' : 'false'); ?>">
                            <div class="notification-icon" style="background: <?php echo e($notification['color']); ?>;">
                                <i class="<?php echo e($notification['icon']); ?>"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title"><?php echo e($notification['title']); ?></div>
                                <div class="notification-message"><?php echo e($notification['message']); ?></div>
                                <div class="notification-time"><?php echo e($notification['time']); ?></div>
                            </div>
                            <div class="notification-actions">
                                <?php if(!$notification['read']): ?>
                                    <button class="notification-action-btn" title="<?php echo e(__('Mark as read')); ?>">
                                        <i class="feather-check"></i>
                                    </button>
                                <?php endif; ?>
                                <button class="notification-action-btn" title="<?php echo e(__('Delete')); ?>">
                                    <i class="feather-trash-2"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="empty-notifications">
                        <i class="feather-bell-off"></i>
                        <h3><?php echo e(__('No notifications')); ?></h3>
                        <p><?php echo e(__('You are all caught up! New notifications will appear here.')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab filtering
    document.querySelectorAll('.notification-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            // Update active tab
            document.querySelectorAll('.notification-tab').forEach(function(t) {
                t.classList.remove('active');
            });
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');
            const items = document.querySelectorAll('.notification-item');

            items.forEach(function(item) {
                if (filter === 'all') {
                    item.style.display = 'flex';
                } else if (filter === 'unread') {
                    item.style.display = item.classList.contains('unread') ? 'flex' : 'none';
                } else if (filter === 'read') {
                    item.style.display = item.classList.contains('unread') ? 'none' : 'flex';
                }
            });
        });
    });

    // Mark as read
    document.querySelectorAll('.notification-action-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const item = this.closest('.notification-item');
            
            if (this.querySelector('.feather-check')) {
                // Mark as read
                item.classList.remove('unread');
                item.style.background = '#fff';
                item.style.borderLeft = 'none';
                this.remove();
            } else if (this.querySelector('.feather-trash-2')) {
                // Delete notification
                if (confirm('<?php echo e(__('Are you sure you want to delete this notification?')); ?>')) {
                    item.style.transition = 'opacity 0.3s';
                    item.style.opacity = '0';
                    setTimeout(function() {
                        item.remove();
                    }, 300);
                }
            }
        });
    });
});
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/notifications.blade.php ENDPATH**/ ?>