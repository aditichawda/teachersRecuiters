<?php
    Theme::set('header_css_class', '');
    Theme::set('withPageHeader', false);
    Theme::set('bodyClass', 'hide-page-banner notifications-page');
    
    // Dynamic notifications from database
    $notifications = $notifications ?? collect([]);
    $unreadCount = $unreadCount ?? 0;
    $readCount = $readCount ?? 0;
    $totalCount = $notifications->count();
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
                    <?php echo e(__('All')); ?> <span class="badge"><?php echo e($totalCount); ?></span>
                </button>
                <button class="notification-tab" data-filter="unread">
                    <?php echo e(__('Unread')); ?> <span class="badge"><?php echo e($unreadCount); ?></span>
                </button>
                <button class="notification-tab" data-filter="read">
                    <?php echo e(__('Read')); ?> <span class="badge"><?php echo e($readCount); ?></span>
                </button>
            </div>

            <div class="notifications-list">
                <?php if(count($notifications) > 0): ?>
                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="notification-item <?php echo e(!$notification['read'] ? 'unread' : ''); ?>" 
                             data-type="<?php echo e($notification['type']); ?>"
                             data-read="<?php echo e($notification['read'] ? 'true' : 'false'); ?>"
                             data-id="<?php echo e($notification['id']); ?>">
                            <?php if(!empty($notification['action_url'])): ?>
                                <a href="<?php echo e($notification['action_url']); ?>" style="text-decoration: none; color: inherit; display: flex; flex: 1; align-items: flex-start;">
                            <?php endif; ?>
                            <div class="notification-icon" style="background: <?php echo e($notification['color']); ?>;">
                                <i class="<?php echo e($notification['icon']); ?>"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title"><?php echo e($notification['title']); ?></div>
                                <div class="notification-message"><?php echo e($notification['message']); ?></div>
                                <div class="notification-time"><?php echo e($notification['time']); ?></div>
                            </div>
                            <?php if(!empty($notification['action_url'])): ?>
                                </a>
                            <?php endif; ?>
                            <div class="notification-actions">
                                <?php if(!$notification['read']): ?>
                                    <button class="notification-action-btn mark-read-btn" 
                                            data-id="<?php echo e($notification['id']); ?>"
                                            title="<?php echo e(__('Mark as read')); ?>">
                                        <i class="feather-check"></i>
                                    </button>
                                <?php endif; ?>
                                <button class="notification-action-btn delete-btn" 
                                        data-id="<?php echo e($notification['id']); ?>"
                                        title="<?php echo e(__('Delete')); ?>">
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
    document.querySelectorAll('.mark-read-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            const item = this.closest('.notification-item');
            
            fetch('<?php echo e(route("public.account.notifications.read", ":id")); ?>'.replace(':id', notificationId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.message || 'Error marking notification as read');
                    return;
                }
                item.classList.remove('unread');
                item.style.background = '#fff';
                item.style.borderLeft = 'none';
                item.setAttribute('data-read', 'true');
                this.remove();
                
                // Update badge counts
                updateBadgeCounts();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error marking notification as read');
            });
        });
    });

    // Delete notification
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            const notificationId = this.getAttribute('data-id');
            const item = this.closest('.notification-item');
            
            if (!confirm('<?php echo e(__('Are you sure you want to delete this notification?')); ?>')) {
                return;
            }
            
            fetch('<?php echo e(route("public.account.notifications.delete", ":id")); ?>'.replace(':id', notificationId), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.message || 'Error deleting notification');
                    return;
                }
                item.style.transition = 'opacity 0.3s';
                item.style.opacity = '0';
                setTimeout(function() {
                    item.remove();
                    updateBadgeCounts();
                }, 300);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting notification');
            });
        });
    });

    // Update badge counts
    function updateBadgeCounts() {
        const items = document.querySelectorAll('.notification-item');
        const unreadItems = document.querySelectorAll('.notification-item.unread');
        const readItems = document.querySelectorAll('.notification-item:not(.unread)');
        
        document.querySelector('[data-filter="all"] .badge').textContent = items.length;
        document.querySelector('[data-filter="unread"] .badge').textContent = unreadItems.length;
        document.querySelector('[data-filter="read"] .badge').textContent = readItems.length;
    }
});
</script>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/teachersRecuiters/platform/themes/jobzilla/views/notifications.blade.php ENDPATH**/ ?>